<?php

namespace app\admin\controller\member\project;

use app\admin\controller\Base;
use app\common\model\ApiModel;
use app\common\model\MemberModel;
use app\common\model\ProjectApiModel;
use app\common\model\ProjectModel;

class Api extends Base
{

    function index(){
        if (!$this->request->isAjax()) {
            $this->assign('api_list', ApiModel::column('id,title'));
            return view('index');
        } else {
            $limit = $this->request->post('limit');
            $offset = $this->request->post('offset');
            $page = floor($offset / $limit) + 1;

            $where['a.project_id'] = $this->request->param('project_id',0);

            $where['a.api_id'] = $this->request->param('api_id','');
            $where['a.desc'] = ['like',$this->request->param('keywords','')];
            $where['a.status'] = $this->request->param('status','');

            $order = $this->request->post('order');    //排序字段 bootstrap-table 传入
            $sort = $this->request->post('sort');        //排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort . ' ' . $order : 'id desc';

            $res = ProjectApiModel::alias('a')->where(formatWhere($where))
                ->join('api b','a.api_id = b.id')
                ->where('b.delete_time',null)
                ->field('a.*,b.title api_title')
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
        ProjectApiModel::update($data);
        return $this->ajaxReturn($this->successCode,'操作成功');
    }

    function update(){
        $id = $this->request->get('id',0);
        if (!$this->request->isPost()) {
            $this->view->assign('id', $id);
            $info = ProjectApiModel::find($id) ?: new ProjectApiModel();
            $this->view->assign('info', $info);
            return view('update');
        } else {
            $data = $this->request->only([
                'desc'=>'',
                'limit_date'=>formatDate(),
                'day_limit_count'=>0,
                'status'=>0,
            ], 'param', null);
            ProjectApiModel::where('id',$id)->update($data);
            return $this->ajaxReturn($this->successCode,'提交成功');
        }
    }

    function delete(){
        $idx =  $this->request->post('id');
        if(!$idx) $this->error('参数错误');
        ProjectApiModel::destroy(['id'=>explode(',',$idx)]);
        return $this->ajaxReturn($this->successCode,'操作成功');
    }
}