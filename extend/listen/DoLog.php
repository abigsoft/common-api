<?php

//操作日志写入数据库

namespace listen;

use app\common\model\LogModel;

class DoLog
{
    public function handle($event){
        $data['app'] = app('http')->getName();
        $data['url'] = killword(request()->url(),0,250);
        $data['ip'] = request()->ip();
        $data['ua'] = request()->server('HTTP_USER_AGENT');
        $data['param'] = json_encode(request()->except(['s', '_pjax']));
        LogModel::create($data);
    }
}