<?php
// +----------------------------------------------------------------------
// | 模板设置
// +----------------------------------------------------------------------

return [
	'view_path'		=> app_path('view'),
    'tpl_replace_string' => [
        '__LAY__' => '/static/layui',
        '__STATIC__' => '/static/index',
        '__JS__' => '/static/index/js',
        '__CSS__' => '/static/index/css',
        '__IMG__' => '/static/index/img',
        '__FONT__' => '/static/index/font',
    ]
];
