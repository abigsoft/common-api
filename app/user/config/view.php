<?php
// +----------------------------------------------------------------------
// | 模板设置
// +----------------------------------------------------------------------

return [
	'view_path'		=> app_path('view'),
    'tpl_replace_string' => [
        '__LAY__' => '/static/layui',
        '__STATIC__' => '/static/admin',
        '__JS__' => '/static/admin/js',
        '__CSS__' => '/static/admin/css',
        '__IMG__' => '/static/admin/img',
        '__FONT__' => '/static/admin/font',
    ]
];
