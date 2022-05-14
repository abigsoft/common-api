<?php

namespace app\admin\controller\member;

use app\admin\controller\Base;
use app\admin\validate\MemberValidate;
use app\common\model\MemberModel;
use app\exception\ParamException;
use think\exception\ValidateException;

class Index extends Base
{
    function index()
    {
        if (!$this->request->isAjax()) {
            return view('index');
        } else {
            $limit = $this->request->post('limit');
            $offset = $this->request->post('offset');
            $page = floor($offset / $limit) + 1;

            $where['account'] = ['like', $this->request->param('keywords', '')];
            $where['status'] = $this->request->param('status', '');

            $order = $this->request->post('order');    //排序字段 bootstrap-table 传入
            $sort = $this->request->post('sort');        //排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort . ' ' . $order : 'id desc';

            $res = MemberModel::where(formatWhere($where))
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
        MemberModel::update($data);
        return $this->ajaxReturn($this->successCode, '操作成功');
    }

    function update()
    {
        $id = $this->request->get('id', 0);
        if (!$this->request->isPost()) {
            $this->view->assign('id', $id);
            $info = MemberModel::find($id) ?: new MemberModel();
            $this->view->assign('info', $info);
            return view('update');
        } else {
            $data = $this->request->only([
                'account' => '',
                'password' => '',
                'status' => 0,
            ], 'param', null);
            if ($id) {
                try {
                    unset($data['account']);
                    if ($data['password']) {
                        validate(MemberValidate::class)->scene('password')->check($data);
                        $data['password'] = buildPass($data['password']);
                    } else {
                        unset($data['password']);
                    }
                    MemberModel::where('id', $id)->update($data);
                } catch (ValidateException $e) {
                    throw new ParamException($e->getError());
                } catch (\Exception $e) {
                    throw new ParamException($e->getMessage());
                }
            } else {
                try {
                    validate(MemberValidate::class)->append('account', '')->scene('create')->check($data);
                    $data['password'] = buildPass($data['password']);
                    MemberModel::create($data);
                } catch (ValidateException $e) {
                    throw new ParamException($e->getError());
                } catch (\Exception $e) {
                    throw new ParamException($e->getMessage());
                }
            }
            return $this->ajaxReturn($this->successCode, '提交成功');
        }
    }

    function delete()
    {
        $idx = $this->request->post('id');
        if (!$idx) $this->error('参数错误');
        MemberModel::destroy(['id' => explode(',', $idx)]);
        return $this->ajaxReturn($this->successCode, '操作成功');
    }
}