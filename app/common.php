<?php

use app\common\model\ConfigModel;
use think\facade\Db;

error_reporting(0);

function remove_xss($string): string
{

    $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);
    $parm1 = array('vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound');
    $parm2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
    $parm = array_merge($parm1, $parm2);
    for ($i = 0; $i < sizeof($parm); $i++) {
        $pattern = '/';
        for ($j = 0; $j < strlen($parm[$i]); $j++) {
            if ($j > 0) {
                $pattern .= '(';
                $pattern .= '(&#[x|X]0([9][a][b]);?)?';
                $pattern .= '|(&#0([9][10][13]);?)?';
                $pattern .= ')?';
            }
            $pattern .= $parm[$i][$j];
        }
        $pattern .= '/i';
        $string = preg_replace($pattern, '', $string);
    }
    $string = trim($string);
    return $string;
}

function formatDate($timestamp = false, $str = 'Y-m-d H:i:s')
{
    if (!$timestamp) {
        $timestamp = time();
    }
    return date($str, $timestamp);
}

/**
 * ????????????
 * @param int $length ??????
 * @param string $type ??????
 * @param int $convert ??????????????? 1?????? 0??????
 * @return string
 */
function random($length = 10, $type = 'letter', $convert = 0)
{
    $config = array(
        'number' => '1234567890',
        'letter' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'string' => 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
        'all' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
    );

    if (!isset($config[$type])) $type = 'letter';
    $string = $config[$type];

    $code = '';
    $strlen = strlen($string) - 1;
    for ($i = 0; $i < $length; $i++) {
        $code .= $string[mt_rand(0, $strlen)];
    }
    if (!empty($convert)) {
        $code = ($convert > 0) ? strtoupper($code) : strtolower($code);
    }
    return $code;
}

/*
 * ?????????????????????
 * @param char(2) $type
 */
function doOrderSn($type)
{
    return date('YmdHis') . $type . substr(microtime(), 2, 3) . sprintf('%02d', rand(0, 99));
}


function deldir($dir)
{
//??????????????????????????????
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != "..") {
            $fullpath = $dir . "/" . $file;
            if (!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                deldir($fullpath);
            }
        }
    }

    closedir($dh);
    //????????????????????????
    if (rmdir($dir)) {
        return true;
    } else {
        return false;
    }
}

/**
 * ??????????????????
 * @param array $data ??????????????????
 * @return string       ??????
 */
function data_auth_sign($data)
{
    //??????????????????
    if (!is_array($data)) {
        $data = (array)$data;
    }
    ksort($data); //??????
    $code = http_build_query($data); //url???????????????query?????????
    $sign = sha1($code); //????????????
    return $sign;
}

/*???????????????*/
function formartList($fieldConfig, $list)
{
    $cat = new \org\Category($fieldConfig);
    $ret = $cat->getTree($list);
    return $ret;
}

//???????????????????????????
function upload_replace($str)
{
    $farr = ["/php|php3|php4|php5|phtml|pht|/is"];
    $str = preg_replace($farr, '', $str);
    return $str;
}

//??????????????????
function search_in($str)
{
    $farr = ["/^select[\s]+|insert[\s]+|and[\s]+|or[\s]+|create[\s]+|update[\s]+|delete[\s]+|alter[\s]+|count[\s]+|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i"];
    $str = preg_replace($farr, '', html_in($str));
    return trim($str);
}


//?????????????????????????????????
function getTimeFormat($val)
{
    $default_time_format = explode('|', $val['default_value']);
    $time_format = $default_time_format[0];
    if (!$time_format || $val['default_value'] == 'null') {
        $time_format = 'Y-m-d H:i:s';
    }
    return $time_format;
}

/**
 * ?????????????????????
 * @access protected
 * @param array $data ??????
 * @return array
 */
function filterEmptyArray($data = [])
{
    foreach ($data as $k => $v) {
        if (!$v && $v !== 0)
            unset($data[$k]);
    }
    return $data;
}

/**
 * tp???????????????????????????????????????????????????????????????????????????
 * @param array $data ??????????????????
 * @return array
 */
function formatWhere(array $data): array
{
    $where = [];
    foreach ($data as $k => $v) {
        if(is_string($v) && $v != ''){
            $where[] = [$k, '=', $v];
        }
        if(is_array($v)){
            if(count($v) == 1){
                $where[] = [$k, '=', $v[0]];
                continue;
            }
            $type = strtolower($v[0]);
            $value = $v[1];
            if(is_string($value) && $value == ''){
                continue;
            }
            switch ($type){
                case "like":
                    $where[] = [$k, 'like', '%' . str_replace(' ','%',$value) . '%'];
                    break;
                case 'exp':
                    $v[1] = Db::raw($value);
                    break;
                case 'between':
                    if(is_string($value) && stripos($value,'-') !== false){
                        $value = explode('-',$value);
                    }
                    $where[] = [$k, 'between', $value];
                    break;
                case 'between time':
                    if(is_string($value) && stripos($value,'-') !== false){
                        $value = explode('-',$value);
                    }
                    if(!$value[0] && !$value[1]){
                        break;
                    }
                    if($value[0] == null){
                        $value[0] = date('Y-m-d H:i:s',0);
                    }
                    if($value[1] == null){
                        $value[1] = date('Y-m-d H:i:s');
                    }
                    $where[] = [$k, 'between time', $value];
                    break;
                case 'find in set':
                    $where[] = [$k, 'find in set', $value];
                    break;
                default:
                    $where[] = [$k, $type, $value];
                    break;
            }

        }
    }
    return $where;
}


function getUploadServerUrl($upload_config_id = '')
{
    $app_name = app('http')->getName();
    if (config('my.oss_status') && config('my.oss_upload_type') == 'client') {
        switch (config('my.oss_default_type')) {
            case 'qny';
                $server_url = 'http://up-z0.qiniup.com?&' . url($app_name . '/callback/getOssToken') . '&' . config('my.qny_oss_domain');
                break;
            case 'ali':
                $server_url = getAliEndPoint(config('my.ali_oss_endpoint')).'?&'.url($app_name.'/Base/getOssToken');
                break;
            default:
                $server_url = url($app_name . "/common/uploads", ['upload_config_id' => $upload_config_id]);
        }
    } else {
        $server_url = url($app_name . "/common/uploads", ['upload_config_id' => $upload_config_id]);
    }
    return $server_url;
}

function getAliEndPoint($str){
    if(strpos(config('my.ali_oss_endpoint'),'aliyuncs.com') !== false){
        if(strpos($str,'https') !== false){
            $point = 'https://'.config('my.ali_oss_bucket').'.'.substr($str,8);
        }else{
            $point = 'http://'.config('my.ali_oss_bucket').'.'.substr($str,7);
        }
    }else{
        $point = config('my.ali_oss_endpoint');
    }
    return $point;
}

//??????excel????????????
function getTag($key3, $no = 100)
{
    $data = [];
    $key = ord("A");//A--65
    $key2 = ord("@");//@--64
    for ($n = 1; $n <= $no; $n++) {
        if ($key > ord("Z")) {
            $key2 += 1;
            $key = ord("A");
            $data[$n] = chr($key2) . chr($key);//??????26????????????????????????
        } else {
            if ($key2 >= ord("A")) {
                $data[$n] = chr($key2) . chr($key);//??????26????????????????????????
            } else {
                $data[$n] = chr($key);
            }
        }
        $key += 1;
    }
    return $data[$key3];
}

function killword($str, $start = 0, $length = 1, $charset = "utf-8", $suffix = true)
{
    if (function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif (function_exists('iconv_substr')) {
        $slice = iconv_substr($str, $start, $length, $charset);
    } else {
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice . '...' : $slice;
}

function kill_html($str, $length = 0)
{
    if (is_array($str)) {
        foreach ($str as $k => $v) $data[$k] = kill_html($v, $length);
        return $data;
    }

    if (!empty($length)) {
        $estr = htmlspecialchars(preg_replace('/(&[a-zA-Z]{2,5};)|(\s)/', '', strip_tags(str_replace('[CHPAGE]', '', $str))));
        if ($length < 0) return $estr;
        return killword($estr, 0, $length);
    }
    return htmlspecialchars(trim(strip_tags($str)));
}

function httpRequest($url, $method = 'GET', $postData = null, $headers = array()): array
{
    $method = strtoupper($method);
    $ci = curl_init();
    /* Curl settings */
    curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ci, CURLOPT_HTTPHEADER, array('Client_Ip: ' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255)));//?????????????????????????????????90%??????
    curl_setopt($ci, CURLOPT_HTTPHEADER, array('X-Forwarded-For: ' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255)));//?????????????????????????????????90%??????
    curl_setopt($ci, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0");
    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60); /* ???????????????????????????????????????????????????0?????????????????? */
    curl_setopt($ci, CURLOPT_TIMEOUT, 7); /* ??????cURL??????????????????????????? */
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
    if ($method == 'POST') {
        curl_setopt($ci, CURLOPT_POST, true);
        if (!empty($postData)) {
            $tmpdatastr = is_array($postData) ? http_build_query($postData) : $postData;
            curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
        }
    } else {
        curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); /* //?????????????????? */
    }
    $ssl = preg_match('/^https:\/\//i', $url) ? TRUE : FALSE;
    curl_setopt($ci, CURLOPT_URL, $url);
    if ($ssl) {
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); // https?????? ??????????????????hosts
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, FALSE); // ?????????????????????SSL????????????????????????
    }
    curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ci, CURLOPT_MAXREDIRS, 2);/*???????????????HTTP???????????????????????????????????????CURLOPT_FOLLOWLOCATION???????????????*/
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ci, CURLINFO_HEADER_OUT, true);
    $response = curl_exec($ci);
    $request_info = curl_getinfo($ci);
    $http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
    curl_close($ci);
    return [
        'code' => $http_code,
        'data' => $response,
        'header' => $request_info,
    ];
}

function buildConfig()
{
    $config_data = cache('config_data');
    if (!$config_data) {
        $list = ConfigModel::select()->column('data', 'name');
        cache('config_data', $list);
        $config_data = $list;
    }
    config($config_data, 'sys');
}

function decimal($str, $format = 2): string
{
    return number_format($str, $format, ".", "");
}

function sysConfig($key)
{
    return ConfigModel::where('name', $key)->value('data');
}

function buildPass($password): string
{
    return md5($password . config('my.password_secret'));
}

//html????????????
function html_out($str): string
{
    $str = htmlspecialchars_decode($str);
    return stripslashes($str);
}

function getDomain(): string
{
    return "https://" . $_SERVER['HTTP_HOST'];
}
