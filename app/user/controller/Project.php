<?php

namespace app\user\controller;

use app\common\model\ProjectModel;
use app\exception\ParamException;

class Project extends Base
{
    function index()
    {
        if (!$this->request->isAjax()) {
            return view('index');
        } else {
            $limit = $this->request->post('limit');
            $offset = $this->request->post('offset');
            $page = floor($offset / $limit) + 1;

            $where['member_id'] = $this->member_id;
            $where['title|sign|desc'] = ['like', $this->request->param('keywords', '')];
            $where['status'] = $this->request->param('status', '');

            $order = $this->request->post('order');    //排序字段 bootstrap-table 传入
            $sort = $this->request->post('sort');        //排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort . ' ' . $order : 'id desc';

            $res = ProjectModel::where(formatWhere($where))
                ->order($order)
                ->paginate(['list_rows' => $limit, 'page' => $page])
                ->toArray();
            return json(['rows' => $res['data'], 'total' => $res['total']]);
        }
    }

    function status(): \think\response\Json
    {
        $postField = 'id,status';
        $data = $this->request->only(explode(',', $postField), 'param', null);
        if (!$data['id'])
            $this->error('参数错误');
        ProjectModel::where('id', $data['id'])->where('member_id', $this->member_id)
            ->update(['status' => $data['status']]);
        return $this->ajaxReturn($this->successCode, '操作成功');
    }

    function update()
    {
        $id = $this->request->get('id', 0);
        if (!$this->request->isPost()) {
            $this->view->assign('id', $id);
            $info = ProjectModel::where('id', $id)->where('member_id', $this->member_id)->find() ?: new ProjectModel();
            $this->view->assign('info', $info);
            return view('update');
        } else {
            $data = $this->request->only([
                'title' => '',
                'desc' => '',
                'status' => 0,
            ], 'param', null);
            try {
                if ($id) {
                    ProjectModel::where('id', $id)->where('member_id', $this->member_id)->update($data);
                } else {
                    $data['sign'] = random(16,'all',0);
                    $data['member_id'] = $this->member_id;
                    ProjectModel::create($data);
                }
            } catch (\Exception $e) {
                throw new ParamException('签名有重复');
            }

            return $this->ajaxReturn($this->successCode, '提交成功');
        }
    }

    function delete()
    {
        $idx = $this->request->post('id');
        if (!$idx) $this->error('参数错误');
        ProjectModel::destroy(['id' => explode(',', $idx), 'member_id' => $this->member_id]);
        return $this->ajaxReturn($this->successCode, '操作成功');
    }

    function sign()
    {
        $id = $this->request->param('id', 0);
        ProjectModel::where('id', $id)->where('member_id', $this->member_id)->update([
            'sign' => random(16, 'all', 0)
        ]);
        return $this->ajaxReturn($this->successCode, '操作成功');
    }
}