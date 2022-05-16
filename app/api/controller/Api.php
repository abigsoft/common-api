<?php

namespace app\api\controller;

use app\BaseController;
use app\common\model\ApiConfigModel;
use app\common\model\ApiModel;
use app\common\model\ApiRequestModel;
use app\common\model\BlackModel;
use app\common\model\MemberModel;
use app\common\model\ProjectApiModel;
use app\common\model\ProjectModel;
use app\exception\BaseException;
use app\exception\ParamException;
use app\exception\SystemException;
use app\user\service\LogService;
use think\App;
use think\View;

class Api extends BaseController
{
    protected $successCode;
    protected $errorCode;
    protected $_data;
    protected $api_id;
    protected $member_id;
    protected $project_id;
    protected $ip;

    public function __construct(App $app, View $view)
    {
        parent::__construct($app, $view);
        buildConfig();

        $this->successCode = config('my.successCode');
        $this->errorCode = config('my.errorCode');

        $controller = strtolower($this->request->controller());
        $action = strtolower($this->request->action());
        event('DoLog');

        $ip = $this->request->ip();
        $this->ip = $ip;

        $black_ip = BlackModel::where('ip', $ip)->where('status', 1)
            ->where('deadline', '>', formatDate())
            ->field('id,deadline')
            ->find();
        if ($black_ip) {
            throw new SystemException('您的IP已被加入黑名单，截止时间 : ' . $black_ip['deadline']);
        }

        if (!$this->request->isJson()) {
            $this->_data = $this->request->param();
        } else {
            $this->_data = json_decode(file_get_contents('php://input'), true);
        }
    }

    function index($apitype)
    {
        $apitype = strtolower($apitype);
        //判断接口信息  开始
        $api_info = ApiModel::where('ext', $apitype)
            ->field('id,ext,type,title,status')
            ->find();
        if (!$api_info) {
            throw new ParamException('接口不存在');
        }
        if ($api_info['status'] != 1) {
            throw new ParamException('接口已被关闭，请联系站长');
        }
        $this->api_id = $api_info['id'];
        //查询项目信息  开始
        $sign = $this->request->param('sign', '');
        if (!$sign) {
            throw new ParamException('签名无效');
        }
        $info = ProjectApiModel::alias('a')
            ->join('project b', 'a.project_id = b.id')
            ->where('b.delete_time', null)
            ->where('a.api_id', $this->api_id)
            ->where('b.sign', $sign)
            ->field('b.id project_id,b.member_id,b.status project_status,a.limit_date,a.day_limit_count,a.today_count,a.status api_status')
            ->find();
        if (!$info) {
            throw new ParamException('项目接口未配置');
        }
        $this->member_id = $info['member_id'];
        $this->project_id = $info['project_id'];
        if ($info['project_status'] != 1) {
            LogService::ban($this->api_id, $this->member_id, $this->project_id, $this->ip, $this->_data, '项目已关闭');
            throw new ParamException('项目已关闭');
        }
        if ($info['api_status'] != 1) {
            LogService::ban($this->api_id, $this->member_id, $this->project_id, $this->ip, $this->_data, '项目接口已关闭');
            throw new ParamException('项目接口已关闭');
        }
        if ($info['day_limit_count'] <= $info['today_count']) {
            LogService::ban($this->api_id, $this->member_id, $this->project_id, $this->ip, $this->_data, '今日调用次数已达上限');
            throw new ParamException('今日调用次数已达上限');
        }
        if ($info['limit_date'] < formatDate()) {
            LogService::ban($this->api_id, $this->member_id, $this->project_id, $this->ip, $this->_data, '接口已到期，请及时续费');
            throw new ParamException('接口已到期，请及时续费');
        }
        //查询用户信息  开始
        $member_info = MemberModel::where('id', $info['member_id'])
            ->field('id,status')
            ->find();
        if (!$member_info) {
            LogService::ban($this->api_id, $this->member_id, $this->project_id, $this->ip, $this->_data, '用户不存在');
            throw new ParamException('用户不存在');
        }
        if ($member_info['status'] != 1) {
            LogService::ban($this->api_id, $this->member_id, $this->project_id, $this->ip, $this->_data, '用户已被禁用');
            throw new ParamException('用户已被禁用');
        }
        $function = '\\app\\api\\service\\' . $apitype . '\\ApiService';
        //取配置参数
        $config_array = [];
        $config_array_data = ApiConfigModel::where('type', 'a')
            ->where('api_id', $this->api_id)
            ->where('status', 1)
            ->order('sort asc')
            ->column('name,data');
        foreach ($config_array_data as $k => $v) {
            $config_array[$v['name']][] = $v['data'];
        }

        $config = [
            'array' => $config_array,
            'object' => ApiConfigModel::where('type', 'o')
                ->where('api_id', $this->api_id)
                ->where('status', 1)
                ->order('sort asc')
                ->column('data', 'name'),
        ];

        //取对应参数,将接口中的请求参数取出并过滤，并赋予对应的默认值
        $request_field = ApiRequestModel::where('api_id', $this->api_id)->column('default', 'field');
        switch (strtolower($api_info['type'])) {
            case 'post':
                $request = $this->request->only($request_field, 'post');
                break;
            case 'get':
                $request = $this->request->only($request_field, 'get');
                break;
            default:
                $request = $this->request->only($request_field);
                break;
        }
        $request_field = ApiRequestModel::where('api_id', $this->api_id)->column('default,desc,is_must,type', 'field');
        foreach ($request_field as $k=>$v){
            switch ($v['type']){
                case 'Integer':
                    $request[$k] = intval($request[$k]);
                    break;
                case 'Number':
                    $request[$k] = floatval($request[$k]);
                    break;
                default:
                    $request[$k] = is_string($request[$k]) ? $request[$k] : '';
                    break;
            }
            if($v['is_must'] == 1 && $request[$k] == ''){
                throw new ParamException($v['desc'] . '参数不能为空');
            }
        }

        try {
            $result = call_user_func_array($function . '::index', [$api_info, $request, $config]);
            if ($result['status'] == $this->successCode) {
                LogService::success($this->api_id, $this->member_id, $this->project_id, $this->ip, $request, $result, $result['msg']);
            } else {
                LogService::error($this->api_id, $this->member_id, $this->project_id, $this->ip, $request, $result, $result['msg']);
            }
            return json($result);
        } catch (\Exception $e) {
            LogService::ban($this->api_id, $this->member_id, $this->project_id, $this->ip, $request, $e->getMessage());
            throw new ParamException($e->getMessage());
        }
    }

}