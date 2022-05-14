<?php

namespace app\user\controller;

use app\common\model\PayOrderModel;

class Order extends Base
{
    function index()
    {
        if (!$this->request->isAjax()) {
            return view('index');
        } else {
            $limit = $this->request->post('limit');
            $offset = $this->request->post('offset');
            $page = floor($offset / $limit) + 1;

            $where = [];
            $where['member_id'] = $this->member_id;
            $where['order_sn|title'] = ['like', $this->request->param('keywords')];
            $where['status'] = $this->request->param('status');

            $create_time_start = $this->request->param('create_time_start');
            $create_time_end = $this->request->param('create_time_end');

            $where['create_time'] = ['between time',[$create_time_start,$create_time_end]];

            $order = $this->request->post('order');    //排序字段 bootstrap-table 传入
            $sort = $this->request->post('sort');        //排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort . ' ' . $order : 'id desc';

            $res = PayOrderModel::where(formatWhere($where))
                ->order($order)
                ->paginate(['list_rows' => $limit, 'page' => $page])
                ->toArray();
            return json(['rows' => $res['data'], 'total' => $res['total']]);
        }
    }
}