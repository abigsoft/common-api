<?php

namespace app\tasks;

use app\common\model\SystemLogModel;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\facade\Db;
use think\facade\Log;

class Com extends command
{
    protected function configure()
    {
        $this->setName('com')->setDescription('Run Public Task');
    }

    protected function execute(Input $input, Output $output)
    {
        //查询定时任务表task_list
        $tasks = Db::name('task')->where('status', 1)->where('next_active', '<', date('Y-m-d H:i:s'))->select();
        foreach ($tasks as $task) {
            //定义开始时间
            $start_time = microtime(true);
            //初始次数上限
            $active_limit = 0;
            //初始化执行状态
            $active_status = false;
            //初始化错误信息
            $error_msg = '';
            //更改状态，避免任务进入下次循环
            Db::name('task')->where('id', $task['id'])->update(['status' => 2]);
            //如果执行事务
            if ($task['is_trans']) {
                while ($active_status == false && $active_limit <= $task['active_limit']) {
                    Db::startTrans();
                    try {
                        //开始执行任务
                        //如果方法为PHP类
                        if ($task['task_type'] == 1) {
                            call_user_func_array(['app\tasks\\' . $task['task'], $task['task_fun']], []);
                        } //如果方法为存储过程
                        else {
                            Db::query("call " . $task['task']);
                        }
                        $active_status = true;
                        Db::commit();
                    } catch (\Exception $e) {
                        $error_msg = $e->getMessage();
                        Log::error('定时任务异常:【' . $task['id'] . '】' . $e->getMessage());
                        $active_limit++;
                        $active_status = false;

                        SystemLogModel::create([
                            'file'=>$e->getFile(),
                            'line'=>$e->getLine(),
                            'code'=>$e->getCode(),
                            'msg'=>$e->getMessage(),
                            'create_time'=>formatDate(),
                            'other'=>$task['id'],
                        ]);

                        Db::rollback();
                    }
                }
            } else {
                //如果不执行事务
                while ($active_status == false && $active_limit <= $task['active_limit']) {
                    try {
                        //开始执行任务
                        //如果方法为PHP类
                        if ($task['task_type'] == 1) {
                            call_user_func_array(['app\tasks\\' . $task['task'], $task['task_fun']], []);
                        } //如果方法为存储过程
                        else {
                            Db::query("call " . $task['task']);
                        }
                        $active_status = true;
                    } catch (\Exception $e) {
                        $error_msg = $e->getMessage();
                        $active_limit++;
                        $active_status = false;
                        Log::error('定时任务异常:【' . $task['id'] . '】' . $e->getMessage());
                    }
                }
            }
            //计算下次执行时间
            switch ($task['clock_type']) {
                case 0://时间间隔
                    $parsed = date_parse($task['clock_time']);
                    $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
                    $next_active = date('Y-m-d H:i:s', time() + $seconds);
                    break;
                case 1://N月N日N时
                    if (!($task['clock_month'] && $task['clock_day'] && $task['clock_time'])) {
                        Db::name('task')->where('id', $task['id'])->update(['status' => 0]);
                        $next_active = date('Y-m-d H:i:s');
                        break;
                    }
                    $next_active = date('Y-' . $task['clock_month'] . '-' . $task['clock_day'] . ' ' . $task['clock_time'], strtotime('+1 year'));
                    break;
                case 2://每月N日N时
                    if (!($task['clock_day'] && $task['clock_time'])) {
                        Db::name('task')->where('id', $task['id'])->update(['status' => 0]);
                        $next_active = date('Y-m-d H:i:s');
                        break;
                    }
                    $next_active = date('Y-m-' . $task['clock_day'] . ' ' . $task['clock_time'], strtotime('+1 month'));
                    break;
                case 3://每日N时
                    $next_active = date('Y-m-d ' . $task['clock_time'], time() + 86400);
                    break;
                default://缺省
                    Db::name('task')->where('id', $task['id'])->update(['status' => 0]);
                    $next_active = date('Y-m-d H:i:s');
                    break;
            }
            //更新信息
            Db::name('task')->where('id', $task['id'])->update([
                'status' => 1,
                'last_elapsed' => (microtime(true) - $start_time) * 1000,
                'error_msg' => $error_msg,
                'error_count' => $active_status ? Db::raw('error_count') : Db::raw('error_count+1'),
                'next_active' => $next_active,
                'active_count' => Db::raw('active_count+1'),
                'last_active' => date('Y-m-d H:i:s')
            ]);
        }
    }
}