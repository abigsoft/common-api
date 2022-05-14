<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 自定义配置
// +----------------------------------------------------------------------
return [
	'max_dump_data'		=> 50000,  				//excel最大导出数据量
	'upload_dir'		=> './uploads',			//文件上传根目录
	'upload_subdir'		=> 'Ym',				//文件上传二级目录 标准的日期格式

	'error_log_code'	=> 500,					//写入日志的状态码

	'password_secret'	=> 'bugcms',			//密码加密秘钥

	'successCode'		=> 200,				//成功返回码
	'errorCode'			=> 201,				//错误返回码
	'jwtExpireCode'		=> 888,				//jwt过期
	'jwtErrorCode'		=> 887,				//jwt无效

	//阿里云短信配置
	'ali_sms_accessKeyId'		=> 'LTAI4Fjisdd3ALfdXRxLB',				//阿里云短信 keyId	
	'ali_sms_accessKeySecret'	=> 'Wy5isYqtT0eYoePK6m2QjZ8Dc',	//阿里云短信 keysecret
	'ali_sms_signname'			=> 'vueadmin',							//签名
	'ali_sms_tempCode'			=> 'SMS_19762314',						//短信模板 Code
	
	//oss开启状态 以及配置指定oss
	'oss_status'			=> false,			//true启用  false 不启用
	'oss_upload_type'		=> 'server',		//client 客户端直传  server 服务端传
	'oss_default_type'		=> 'ali',			//oss使用类别 则使用ali的oss  qny 则使用七牛云oss
	
	//阿里云oss配置
	'ali_oss_accessKeyId'		=> 'LTAI4FjisdtALfdXRxLB',						//阿里云短信 keyId	
	'ali_oss_accessKeySecret'	=> 'Wy5isYVqtT0g7eZLYoePK6m2QjZ8Dc',		//阿里云短信 keysecret
	'ali_oss_endpoint'			=> 'http://i.whpjs.vip',	//建议填写自己绑定的域名
	'ali_oss_bucket'			=> 'vueadmin',							//阿里bucket
	
	//七牛云oss配置
	'qny_oss_accessKey' 	=> 'bm1sR9bx0F5KYq2RtAhZMJ8zOxb-HCGYx5pJU',  //access_key
	'qny_oss_secretKey' 	=> 'YrRaySbqu7M1PIzZHOguJMT0ObUdb7GBPRiYa7Lq',     //secret_key
	'qny_oss_bucket'	  	=> 'vueadmin',							//bucket
	'qny_oss_domain'	  	=> 'http://images.whpjs.vip', 		//

	//api上传配置
	'api_upload_domain'	=> '',						//如果做本地存储 请解析一个域名到/public/upload目录  也可以不解析
	'api_upload_ext'	=> 'jpg,png,gif,mp4',			//api允许上传文件
	'api_upload_max'	=> 200 * 1024 * 1024,			//默认2M

];
