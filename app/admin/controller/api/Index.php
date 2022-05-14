<?php

namespace app\admin\controller\api;

use app\admin\controller\Base;
use app\common\model\ApiModel;
use app\common\model\ApiResultModel;
use app\common\model\MemberModel;
use app\common\service\BaseService;

class Index extends Base
{
    function index(){
        if (!$this->request->isAjax()) {
            return view('index');
        } else {
            $limit = $this->request->post('limit');
            $offset = $this->request->post('offset');
            $page = floor($offset / $limit) + 1;

            $where['title|desc'] = ['like', $this->request->param('keywords', '')];
            $where['status'] = $this->request->param('status', '');

            $order = $this->request->post('order');    //排序字段 bootstrap-table 传入
            $sort = $this->request->post('sort');        //排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort . ' ' . $order : 'sort desc';

            $res = ApiModel::where(formatWhere($where))
                ->order($order)
                ->paginate(['list_rows' => $limit, 'page' => $page])
                ->toArray();
            return json(['rows' => $res['data'], 'total' => $res['total']]);
        }
    }

    function status(): \think\response\Json
    {
        $postField = 'id,status';
        $data = $this->request->only(explode(',',$postField),'param',null);
        if(!$data['id'])
            $this->error('参数错误');
        ApiModel::update($data);
        return $this->ajaxReturn($this->successCode,'操作成功');
    }

    function update(){
        $id = $this->request->get('id',0);
        if (!$this->request->isPost()) {
            $this->view->assign('id', $id);
            $info = ApiModel::find($id) ?: new ApiModel();
            if(!$id){
                $info['result_success_demo'] = json_encode(['status'=>$this->successCode,'msg'=>'SUCCESS','data'=>[]],JSON_PRETTY_PRINT);
                $info['result_error_demo'] = json_encode(['status'=>$this->errorCode,'msg'=>'ERROR','data'=>[]],JSON_PRETTY_PRINT);
            }
            $this->view->assign('info', $info);
            return view('update');
        } else {
            $data = $this->request->only([
                'title'=>'',
                'type'=>'GET',
                'sort'=>'',
                'desc'=>'',
                'ext'=>'',
                'result_success_demo'=>'',
                'result_error_demo'=>'',
                'price'=>0,
                'default_day_limit'=>0,
                'status'=>0,
            ], 'param', null);
            $data['ext'] = strtolower($data['ext']);
            if($id){
                ApiModel::where('id',$id)->update($data);
            }else{
                $res = ApiModel::create($data);
                $id = $res->id;
                ApiResultModel::create([
                    'api_id'=>$id,
                    'sort' => 1,
                    'field' => 'status',
                    'demo' => $this->successCode,
                    'desc' => '返回状态值,200为成功',
                    'status'=>1,
                ]);
                ApiResultModel::create([
                    'api_id'=>$id,
                    'sort' => 2,
                    'field' => 'msg',
                    'demo' => 'SUCCESS',
                    'desc' => '返回信息',
                    'status'=>1,
                ]);
                ApiResultModel::create([
                    'api_id'=>$id,
                    'sort' => 3,
                    'field' => 'data',
                    'demo' => '{}',
                    'desc' => '返回数据',
                    'status'=>1,
                ]);
            }
            if(!$data['sort']){
                ApiModel::where('id', $id)->update([
                    'sort'=>$id
                ]);
            }
            return $this->ajaxReturn($this->successCode,'提交成功');
        }
    }

    function arrow(): \think\response\Json
    {
        $postField = 'id,sort,type';
        $data = $this->request->only(explode(',',$postField),'post',null);
        if(empty($data['sort'])){
            $this->error('操作失败，当前数据没有排序号');
        }
        if($data['type'] == 1){//上
            $info = ApiModel::where('sort','<',$data['sort'])->order('sort desc')->find();
        }else{
            $info = ApiModel::where('sort','>',$data['sort'])->order('sort desc')->find();
        }
        if(empty($info['sort'])){
            $this->error('操作失败，目标位置没有排序号');
        }
        if($info){
            try{
                ApiModel::where('id',$data['id'])->update(['sort'=>$info['sort']]);
                ApiModel::where('id',$info['id'])->update(['sort'=>$data['sort']]);
            }catch(\Exception $e){
                throw new \think\exception\ValidateException ($e->getMessage());
            }
        }else{
            $this->error('目标位置没有数据');
        }
        return $this->ajaxReturn($this->successCode,'操作成功');
    }

    function delete(){
        $idx = $this->request->post('id');
        if (!$idx) $this->error('参数错误');
        ApiModel::destroy(['id' => explode(',', $idx)]);
        return $this->ajaxReturn($this->successCode, '操作成功');
    }

    function build(){
        $idx = $this->request->post('id');
        if (!$idx) $this->error('参数错误');
        $ids = explode(',', $idx);
        if(count($ids) > 1){
            $this->error('请选择一项进行生成');
        }
        $id = $ids[0];
        $info = ApiModel::where('id',$id)->find();
        if(!$info){
            $this->error('接口不存在');
        }
        if(!$info['ext']){
            $this->error('插件信息不能为空');
        }

        //代码为
        $str = "<?php\n";
        $str .= "namespace app\\api\service\\" . $info['ext'] . ";\n";
        $str .= "use app\\common\\service\\BaseService;\n";
        $str .= "use app\\exception\\ParamException;\n";
        $str .= "\n";
        $str .= "class ApiService extends BaseService\n";
        $str .= "{\n";
        $str .= "    public static function index(\$api_info, \$request, \$config){\n";
        $str .= "        //执行成功 return self::ajaxSuccess('这里是数据','这里是消息');\n";
        $str .= "        return self::ajaxSuccess('这里是数据','这里是消息');\n";
        $str .= "        //执行失败 return self::ajaxError('这里是消息','这里是数据');\n";
        $str .= "        //异常数据 throw new ParamException('这里是消息');\n";
        $str .= "    }\n";
        $str .= "}\n";

        //目录为app/api/service/ + ext + /ApiService.php
        try{
            $rootPath = app()->getRootPath();
            $filepath = $rootPath.'/app/api/service/'.$info['ext'].'/ApiService.php';
            filePutContents($str,$filepath);
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }
        return $this->ajaxReturn($this->successCode,'生成成功');
    }
}