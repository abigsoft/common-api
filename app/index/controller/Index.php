<?php

namespace app\index\controller;

use app\common\model\ApiModel;
use app\common\model\ApiRequestModel;
use app\common\model\ApiResultModel;

class Index extends Base
{
    function index()
    {
        $data = ApiModel::where('status', 1)->order('sort asc')
            ->field('id,title,desc,sort,price,now_count')
            ->select()
            ->toArray();
        $this->assign('data', $data);
        return $this->fetch('index');
    }

    function doc($id)
    {

        $api_id = $id;
        $api_info = ApiModel::where('id', $api_id)->find();
        if (!$api_info) {
            $this->error('数据不存在');
        }
        $request = ApiRequestModel::where('api_id', $api_id)
            ->where('status', 1)
            ->order('sort asc')
            ->select();
        $result = ApiResultModel::where('api_id', $api_id)
            ->where('status', 1)
            ->order('sort asc')
            ->select();
        $this->assign([
            'api_info' => $api_info,
            'request' => $request,
            'result' => $result,
        ]);
        $data = ApiModel::where('status', 1)->order('sort asc')
            ->field('id,title,desc,sort,price,now_count')
            ->select()
            ->toArray();
        $this->assign('list', $data);
        return $this->fetch('doc');
    }
}