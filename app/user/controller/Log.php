<?php

namespace app\user\controller;

use app\common\model\ApiLogModel;
use app\common\model\ApiModel;
use app\common\model\ProjectModel;

class Log extends Base
{
    function index(){
        if (!$this->request->isAjax()){
            $this->assign([
                'api_list'=>ApiModel::where('status',1)->select(),
                'project_list'=>ProjectModel::where('member_id',$this->member_id)->select(),
            ]);
            return view('index');
        }else{
            $limit  = $this->request->post('limit', 20, 'intval');
            $offset = $this->request->post('offset', 0, 'intval');
            $page   = floor($offset / $limit) +1 ;

            $where = [];
            $where['a.ip|a.request|a.result|a.message'] = $this->request->param('keywords', '');

            $where['a.status'] = $this->request->param('status','');

            $where['a.api_id'] = $this->request->param('api_id','');
            $where['a.member_id'] = $this->member_id;
            $where['a.project_id'] = $this->request->param('project_id','');

            $create_time_start = $this->request->param('create_time_start');
            $create_time_end = $this->request->param('create_time_end');
            $where['a.create_time'] = ['between time',[$create_time_start,$create_time_end]];

            $order  = $this->request->post('order', '');	//排序字段 bootstrap-table 传入
            $sort  = $this->request->post('sort', '');		//排序方式 desc 或 asc

            $order = ($sort && $order) ? $sort.' '.$order : 'a.id desc';

            $res = ApiLogModel::alias('a')->where(formatWhere($where))
                ->join('project c','a.project_id = c.id')
                ->where('c.delete_time',null)
                ->where('c.member_id',$this->member_id)
                ->join('api d','a.api_id = d.id')
                ->where('d.delete_time',null)
                ->where('d.status',1)
                ->field('a.*,d.title api_title,c.title project_title')
                ->order($order)
                ->paginate(['list_rows' => $limit, 'page' => $page])
                ->toArray();
            return json(['rows' => $res['data'], 'total' => $res['total']]);
        }
    }
}