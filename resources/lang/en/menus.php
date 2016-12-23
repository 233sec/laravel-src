<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => '权限管理',

            'roles' => [
                'all' => '所有角色',
                'create' => '创建角色',
                'edit' => '修改角色',
                'management' => '角色管理',
                'main' => '角色',
            ],

            'users' => [
                'all' => '所有用户',
                'change-password' => '修改密码',
                'create' => '创建用户',
                'deactivated' => '禁用用户',
                'deleted' => '删除用户',
                'edit' => '修改用户',
                'management' => '用户管理',
                'main' => '用户',
            ],
        ],
        'vul' => [
            'title' => '漏洞管理',
            'vuls' => [
                'list' => '漏洞审核',
                'create' => '漏洞添加',
                'edit' => '修改漏洞',
                'management' => '漏洞管理',
                'main' => '漏洞',
            ],
        ],
        'exchange' => [
            'title' => '兑换中心',
            'log' => '兑换记录',
            'goods' => [
                'list' => '商品列表',
                'create' => '添加商品',
            ]
        ],
        'article' => [
            'title' => '文章管理',
            'articles' => [
                'create'=>'文章添加',
                'list'=>'文章列表',
                'edit'=>'文章编辑'
            ],
            'notices' => [
                'create'=>'公告添加',
                'list'=>'公告列表',
                'edit'=>'公告编辑'
            ]
        ],
        'log-viewer' => [
            'main' => '日志查看',
            'dashboard' => 'Dashboard',
            'logs' => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => '控制台',
            'general' => '通用',
        ],
    ],

    'language-picker' => [
        'language' => '语言',
        /**
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar' => '阿拉伯语',
            'da' => 'Danish',
            'de' => '德语',
            'en' => '英语',
            'es' => '西班牙语',
            'fr' => '法语',
            'it' => '意大利语',
            'pt-BR' => 'Brazilian Portuguese',
            'sv' => '瑞士语',
            'th' => '泰语',
        ],
    ],
];
