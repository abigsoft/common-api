<?php

namespace app\admin\controller;
use think\facade\Db;

class Index extends Base
{

    //框架主体
    public function index()
    {
        $this->assign([
            'menus'=>config('menu'),
        ]);
        return view('index');
    }

    //后台首页框架内容
    public function main()
    {
        $version = Db::query('SELECT VERSION() AS ver');
        $config = [
            'url' => $_SERVER['HTTP_HOST'],
            'document_root' => $_SERVER['DOCUMENT_ROOT'],
            'server_os' => PHP_OS,
            'server_port' => $_SERVER['SERVER_PORT'],
            'server_soft' => $_SERVER['SERVER_SOFTWARE'],
            'php_version' => PHP_VERSION,
            'mysql_version' => $version[0]['ver'],
            'max_upload_size' => ini_get('upload_max_filesize')
        ];
        $this->assign('config', $config);

        return view('main');
    }

    //清除缓存 出去session缓存
    public function clear(){
        $dir = app()->getRootPath().'/runtime/cache';
        try{
            deldir($dir);
        }catch(\Exception $e){
            return json(['status'=>'01','msg'=>$e->getMessage()]);
        }
        return json(['status'=>'00','msg'=>'删除成功']);
    }

}
