<?php

namespace app\user\service;

use app\common\model\ApiLogModel;
use app\common\model\ApiModel;
use app\common\model\ProjectApiModel;
use app\common\service\BaseService;

class LogService extends BaseService
{
    private static function write($api_id, $member_id, $project_id, $ip, $request, $result, $message, $status)
    {
        ApiModel::where('id', $api_id)->inc('now_count')->update();
        ApiLogModel::create([
            'api_id' => $api_id,
            'member_id' => $member_id,
            'project_id' => $project_id,
            'ip' => $ip,
            'request' => is_string($request) ? $request : json_encode($request),
            'result' => is_string($result) ? $result : json_encode($result),
            'message' => $message,
            'status' => $status
        ]);
    }

    public static function success($api_id, $member_id, $project_id, $ip, $request, $result, $message)
    {
        ProjectApiModel::where('api_id', $api_id)->where('project_id', $project_id)
            ->where('member_id', $member_id)
            ->inc('today_count')
            ->update();
        self::write($api_id, $member_id, $project_id, $ip, $request, $result, $message, 1);
    }

    public static function error($api_id, $member_id, $project_id, $ip, $request, $result, $message)
    {
        self::write($api_id, $member_id, $project_id, $ip, $request, $result, $message, 0);
    }

    public static function ban($api_id, $member_id, $project_id, $ip, $request, $message)
    {
        self::write($api_id, $member_id, $project_id, $ip, $request, [], $message, -1);
    }
}