<?php

namespace app\admin\controller;

use app\admin\service\TaskService;
use app\common\model\TaskModel;

class Task extends Base
{
    /*首页数据列表*/
    function index(){
        if (!$this->request->isAjax()){
            return view('index');
        }else{
            $limit  = $this->request->post('limit');
            $offset = $this->request->post('offset');
            $page   = floor($offset / $limit) +1 ;

            $where = [];
            $where['clock_type'] = $this->request->param('clock_type');
            $where['title'] = ['like',$this->request->param('title')];
            $where['is_trans'] = $this->request->param('is_trans');
            $where['status'] = $this->request->param('status');
            $where['task_type'] = $this->request->param('task_type');

            $order  = $this->request->post('order');	//排序字段 bootstrap-table 传入
            $sort  = $this->request->post('sort');		//排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort.' '.$order : 'id desc';

            $res = TaskModel::where(formatWhere($where))
                ->field("id,clock_type,clock_month,clock_day,clock_time,title,concat(task,'/',task_fun) task,active_count,last_active,next_active,last_elapsed,status,task_type")
                ->order($order)
                ->paginate(['list_rows'=>$limit,'page'=>$page])
                ->toArray();
            return json(['rows'=>$res['data'],'total'=>$res['total']]);
        }
    }

    /*修改排序开关按钮操作*/
    function updateExt(){
        $postField = 'id,status';
        $data = $this->request->only(explode(',',$postField),'param',null);
        if(!$data['id'])
            $this->error('参数错误');
        TaskModel::update($data);
        return $this->ajaxReturn($this->successCode,'操作成功');
    }

    /*修改*/
    function update(){
        if (!$this->request->isPost()){
            $id = $this->request->get('id');
            $this->view->assign('id',$id);
            $info = TaskModel::find($id) ? : new TaskModel();
            $this->view->assign('info',$info);
            return view('update');
        }else{
            $postField = 'id,clock_month,clock_day,clock_time,clock_type,title,task,task_fun,is_trans,next_active,active_limit,status,details,task_type';
            $data = $this->request->only(explode(',',$postField),'param',null);
            $data['next_active'] = formatDate(strtotime($data['next_active']));
            if(!$data['id']){
                $res = TaskModel::create($data);
            }else{
                $res = TaskModel::update($data);
            }
            return $this->ajaxReturn($this->successCode,'修改成功');
        }
    }

    /*删除*/
    function delete(){
        $idx =  $this->request->post('id');
        if(!$idx) $this->error('参数错误');
        TaskModel::destroy(['id'=>explode(',',$idx)],true);
        return $this->ajaxReturn($this->successCode,'操作成功');
    }
}