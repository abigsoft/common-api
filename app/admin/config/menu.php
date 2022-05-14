<?php
return [
    [
        'icon'=>'fa fa-clone',
        'title'=>'系统管理',
        'url'=>'###',
        'sub'=>[
            [
                'icon'=>'fa fa-clone',
                'title'=>'系统设置',
                'url'=>'/admin/config/index',
            ],
            [
                'icon'=>'fa fa-clone',
                'title'=>'定时任务',
                'url'=>'/admin/task/index',
            ],
        ]
    ],
    [
        'icon'=>'fa fa-clone',
        'title'=>'接口管理',
        'url'=>'###',
        'sub'=>[
            [
                'icon'=>'fa fa-clone',
                'title'=>'接口列表',
                'url'=>'/admin/api.index/index',
            ],
            [
                'icon'=>'fa fa-clone',
                'title'=>'黑名单',
                'url'=>'/admin/black/index',
            ],
        ]
    ],
    [
        'icon'=>'fa fa-clone',
        'title'=>'用户管理',
        'url'=>'###',
        'sub'=>[
            [
                'icon'=>'fa fa-clone',
                'title'=>'用户列表',
                'url'=>'/admin/member.index/index',
            ],
            [
                'icon'=>'fa fa-clone',
                'title'=>'项目列表',
                'url'=>'/admin/member.project.index/index',
            ],
            [
                'icon'=>'fa fa-clone',
                'title'=>'订单管理',
                'url'=>'/admin/order/index',
            ],
        ]
    ],
    [
        'icon'=>'fa fa-clone',
        'title'=>'日志管理',
        'url'=>'###',
        'sub'=>[
            [
                'icon'=>'fa fa-clone',
                'title'=>'接口日志',
                'url'=>'/admin/log/api',
            ],
            [
                'icon'=>'fa fa-clone',
                'title'=>'访问日志',
                'url'=>'/admin/log/index',
            ],
        ]
    ]
];
