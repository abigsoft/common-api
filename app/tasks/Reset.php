<?php

namespace app\tasks;

use app\common\model\ProjectApiModel;

class Reset
{
    public static function run()
    {
        ProjectApiModel::where('create_time', '<', formatDate(time(), 'Y-m-d 00:00:00'))
            ->update(['today_count' => 0]);
    }
}