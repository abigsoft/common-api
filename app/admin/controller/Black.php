<?php

namespace app\admin\controller;

use app\admin\validate\BlackValidate;
use app\common\model\BlackModel;
use app\exception\ParamException;
use think\exception\ValidateException;

class Black extends Base
{
    function index(){
        if (!$this->request->isAjax()) {
            return view('index');
        } else {
            $limit = $this->request->post('limit');
            $offset = $this->request->post('offset');
            $page = floor($offset / $limit) + 1;

            $where['ip|desc'] = ['like',$this->request->param('keywords','')];
            $where['status'] = $this->request->param('status','');

            $order = $this->request->post('order');    //排序字段 bootstrap-table 传入
            $sort = $this->request->post('sort');        //排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort . ' ' . $order : 'id desc';

            $res = BlackModel::where(formatWhere($where))
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
        BlackModel::update($data);
        return $this->ajaxReturn($this->successCode,'操作成功');
    }

    function update(){
        $id = $this->request->get('id',0);
        if (!$this->request->isPost()) {
            $this->view->assign('id', $id);
            $info = BlackModel::find($id) ?: new BlackModel();
            $this->view->assign('info', $info);
            return view('update');
        } else {
            $data = $this->request->only([
                'ip'=>'',
                'deadline'=>'',
                'status'=>'',
                'desc'=>'',
            ], 'param', null);
            if($id){
                try {
                    unset($data['ip']);
                    validate(BlackValidate::class)->scene('update')->check($data);
                    BlackModel::where('id',$id)->update($data);
                } catch (ValidateException $e) {
                    throw new ParamException($e->getMessage());
                }
            }else{
                try {
                    validate(BlackValidate::class)->scene('create')->check($data);
                    BlackModel::create($data);
                }catch (ValidateException $e) {
                    throw new ParamException($e->getMessage());
                }
            }
            return $this->ajaxReturn($this->successCode,'提交成功');
        }
    }

    function delete(){
        $idx =  $this->request->post('id');
        if(!$idx) $this->error('参数错误');
        BlackModel::destroy(['id'=>explode(',',$idx)]);
        return $this->ajaxReturn($this->successCode,'操作成功');
    }
}