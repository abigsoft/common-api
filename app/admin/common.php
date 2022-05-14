<?php
// +----------------------------------------------------------------------
// | 应用公共文件
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 
// +----------------------------------------------------------------------


use think\helper\Str;

error_reporting(0);


//多级控制器 获取控制其名称
function getControllerName($controller_name){
	if($controller_name && strpos($controller_name,'/') > 0){
		$controller_name = explode('/',$controller_name)[1];
	}
	return $controller_name;
}

//多级控制器 获取use名称
function getUseName($controller_name){
	if($controller_name && strpos($controller_name,'/') > 0){
		$controller_name = str_replace('/','\\',$controller_name);
	}
	return $controller_name;
}

//多级控制器 获取db命名空间
function getDbName($controller_name){
	if($controller_name && strpos($controller_name,'/') > 0){
		$controller_name = '\\'.explode('/',$controller_name)[0];
	}else{
		$controller_name = '';
	}
	return $controller_name;
}


//多级控制器获取视图名称
function getViewName($controller_name){
	if($controller_name && strpos($controller_name,'/') > 0){
		$arr = explode('/',$controller_name);
		$controller_name = ucfirst($arr[0]).'/'.Str::snake($arr[1]);
	}else{
		$controller_name = Str::snake($controller_name);
	}
	return $controller_name;
}

//多级控制器获取url名称
function getUrlName($controller_name){
	if($controller_name && strpos($controller_name,'/') > 0){
		$controller_name = str_replace('/','.',$controller_name);
	}
	return $controller_name;
}

function getClassUrl($class){
	if(empty($class['jumpurl'])){
		$url_type = config('url_type') ? config('url_type') : 1;
		if($url_type == 1){
			$url =  url('index/About/index',['class_id'=>$class['class_id']]);
		}else{
			if($class['filepath'] == '/'){
				$url = '/'.$class['filename'];
			}else{
				$url =  $class['filepath'].'/'.$class['filename'];
			}	
		}		
	}else{
		$url =$class['jumpurl'];
	}
	return $url;
}

function getListUrl($newslist){
	if(!empty($newslist['jumpurl'])){
		$url =  $newslist['jumpurl'];
	}else{
		$url_type = config('base.url_type') ? config('base.url_type') : 1;
		if($url_type == 1){
			$url =  url('index/View/index',['content_id'=>$newslist['content_id']]);
		}else{
			$info = db('content')->alias('a')->join('catagory b','a.class_id=b.class_id')->where(['a.content_id'=>$newslist['content_id']])->field('a.content_id,b.filepath')->find();
			$url = $info['filepath'].'/'.$info['content_id'].'.html';
		}
		
	}
	return $url;
}

//返回图片缩略后 或水印后不覆盖情况下的图片路径
function getSpic($newslist){
	if($newslist){
		$targetimages = pathinfo($newslist['pic']);
		$newpath = $targetimages['dirname'].'/'.'s_'.$targetimages['basename'];
		return $newpath;
	}
}

/*写入
* @param  string  $type 1 为生成控制器
*/

function filePutContents($content,$filepath){

    ob_start();
    echo $content;
    $_cache=ob_get_contents();
    ob_end_clean();

    if($_cache){
        $File = new \think\template\driver\File();
        $File->write($filepath, $_cache);
    }
}


