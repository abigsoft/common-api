<?php

namespace app\admin\controller;

use app\common\model\MemberModel;
use app\common\model\PayOrderModel;

class Order extends Base
{
    function index()
    {
        if (!$this->request->isAjax()) {
            $this->assign('member_list', MemberModel::where('status', 1)->column('id,account'));
            return view('index');
        } else {
            $limit = $this->request->post('limit');
            $offset = $this->request->post('offset');
            $page = floor($offset / $limit) + 1;

            $where = [];
            $where['a.member_id'] = $this->request->param('member_id');
            $where['a.order_sn|a.title'] = ['like', $this->request->param('keywords')];
            $where['a.status'] = $this->request->param('status');

            $create_time_start = $this->request->param('create_time_start');
            $create_time_end = $this->request->param('create_time_end');

            $where['a.create_time'] = ['between time',[$create_time_start,$create_time_end]];

            $order = $this->request->post('order');    //排序字段 bootstrap-table 传入
            $sort = $this->request->post('sort');        //排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort . ' ' . $order : 'a.id desc';

            $res = PayOrderModel::alias('a')->where(formatWhere($where))
                ->join('member b', 'a.member_id = b.id', 'left')
                ->where('b.delete_time', null)
                ->field("a.*,b.account member_account")
                ->order($order)
                ->paginate(['list_rows' => $limit, 'page' => $page])
                ->toArray();
            return json(['rows' => $res['data'], 'total' => $res['total']]);
        }
    }
}