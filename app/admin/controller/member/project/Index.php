<?php

namespace app\admin\controller\member\project;

use app\admin\controller\Base;
use app\common\model\MemberModel;
use app\common\model\ProjectModel;
use app\exception\ParamException;

class Index extends Base
{
    function index(){
        if (!$this->request->isAjax()) {
            $this->assign('member_list', MemberModel::where('status', 1)->column('id,account'));
            return view('index');
        } else {
            $limit = $this->request->post('limit');
            $offset = $this->request->post('offset');
            $page = floor($offset / $limit) + 1;

            $where['a.member_id'] = $this->request->param('member_id','');
            $where['a.title|a.sign|a.desc'] = ['like',$this->request->param('keywords','')];
            $where['a.status'] = $this->request->param('status','');

            $order = $this->request->post('order');    //排序字段 bootstrap-table 传入
            $sort = $this->request->post('sort');        //排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort . ' ' . $order : 'id desc';

            $res = ProjectModel::alias('a')->where(formatWhere($where))
                ->join('member b','a.member_id = b.id')
                ->where('b.delete_time',null)
                ->field('a.*,b.account member_account')
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
        ProjectModel::update($data);
        return $this->ajaxReturn($this->successCode,'操作成功');
    }

    function update(){
        $id = $this->request->get('id',0);
        if (!$this->request->isPost()) {
            $this->view->assign('id', $id);
            $info = ProjectModel::find($id) ?: new ProjectModel();
            $this->view->assign('info', $info);
            $this->assign('member_list', MemberModel::where('status', 1)->column('id,account'));
            return view('update');
        } else {
            $data = $this->request->only([
                'member_id'=>'',
                'title'=>'',
                'sign'=>'',
                'desc'=>'',
                'status'=>0,
            ], 'param', null);
            try {
                if($id){
                    unset($data['member_id']);
                    ProjectModel::where('id',$id)->update($data);
                }else{
                    ProjectModel::create($data);
                }
            }catch (\Exception $e){
                throw new ParamException('签名有重复');
            }

            return $this->ajaxReturn($this->successCode,'提交成功');
        }
    }

    function delete(){
        $idx =  $this->request->post('id');
        if(!$idx) $this->error('参数错误');
        ProjectModel::destroy(['id'=>explode(',',$idx)]);
        return $this->ajaxReturn($this->successCode,'操作成功');
    }
}