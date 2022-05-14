<?php

/**
 * 统一验签
 * @param $param
 * @param $secret
 * @param $sign
 * @return bool
 */
function checkSign($param, $secret, $sign): bool
{
    if (!isset($param['timestamp'])) {
        return false;
    }
    if (!$param['timestamp']) {
        $param['timestamp'] = 0;
    }
    if (abs($param['timestamp'] - time()) > 3600) {
        return false;
    }
    $sort = ksort($param);
    if (!$sort) {
        return false;
    }
    $str = "";
    foreach ($param as $k => $v) {
        $str .= $k . '=' . strval($v) . '&';
    }
    $str .= 'secret=' . $secret;
    return md5($str) == $sign;
}