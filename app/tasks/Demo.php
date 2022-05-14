<?php

namespace app\tasks;

use think\facade\Log;

class Demo
{
    public static function run()
    {

        Log::write("定时任务心跳检测:" . date('Y-m-d H:i:s'));
    }
}