<?php

namespace app\user\service;

use app\common\service\BaseService;

class LoginService extends BaseService
{
    public static function login($type){
        //-------构造请求参数列表
        $keysArr = array(
            "act" => "login",
            "appid" => config('sys.login_appid'),
            "appkey" => config('sys.login_appkey'),
            "type" => $type,
            "redirect_uri" => getDomain()."/user/callback/login",
            "state"=>0,
        );
        $login_url = config('sys.login_url').'connect.php?'.http_build_query($keysArr);

        $response = httpRequest($login_url);
        $arr = json_decode($response['data'],true);
        return $arr;
    }

    public static function bind($type){
        //-------构造请求参数列表
        $keysArr = array(
            "act" => "login",
            "appid" => config('sys.login_appid'),
            "appkey" => config('sys.login_appkey'),
            "type" => $type,
            "redirect_uri" => getDomain()."/user/callback/bind",
        );
        $login_url = config('sys.login_url').'connect.php?'.http_build_query($keysArr);

        $response = httpRequest($login_url);
        $arr = json_decode($response['data'],true);
        return $arr;
    }

    //登录成功返回网站
    public static function callback($code){
        //-------请求参数列表
        $keysArr = array(
            "act" => "callback",
            "appid" => config('sys.login_appid'),
            "appkey" => config('sys.login_appkey'),
            "code" => $code
        );

        //------构造请求access_token的url
        $token_url = config('sys.login_url').'connect.php?'.http_build_query($keysArr);
        $response = httpRequest($token_url);

        $arr = json_decode($response['data'],true);
        return $arr;
    }

    //查询用户信息
    public static function query($type, $social_uid){
        //-------请求参数列表
        $keysArr = array(
            "act" => "query",
            "appid" => config('sys.login_appid'),
            "appkey" => config('sys.login_appkey'),
            "type" => $type,
            "social_uid" => $social_uid
        );

        //------构造请求access_token的url
        $token_url = config('sys.login_url').'connect.php?'.http_build_query($keysArr);
        $response = httpRequest($token_url);

        $arr = json_decode($response['data'],true);
        return $arr;
    }
}