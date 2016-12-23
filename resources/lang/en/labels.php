<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => '所有',
        'yes' => 'Yes',
        'no' => 'No',
        'custom' => '自定义',
        'actions' => '操作',
        'buttons' => [
            'save' => '保存',
            'update' => '更新',
        ],
        'hide' => '隐藏',
        'none' => 'None',
        'show' => '显示',
        'toggle_navigation' => '折叠',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => '创建角色',
                'edit' => '编辑角色',
                'management' => '角色管理',

                'table' => [
                    'number_of_users' => '用户数',
                    'permissions' => '权限',
                    'role' => '角色',
                    'sort' => '排序',
                    'total' => '权限总量',
                ],
            ],

            'users' => [
                'active' => '已激活用户',
                'all_permissions' => '所有权限',
                'change_password' => '修改密码',
                'change_password_for' => '给 :user 修改密码',
                'create' => '创建用户',
                'deactivated' => '禁用用户',
                'deleted' => '已删除用户',
                'edit' => '编辑用户',
                'management' => '用户管理',
                'no_permissions' => '没有权限',
                'no_roles' => '没有可设置的角色',
                'permissions' => '权限',

                'table' => [
                    'confirmed' => '已确认',
                    'created' => '已创建',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => '最后更新',
                    'name' => '名',
                    'no_deactivated' => '没有已禁用用户',
                    'no_deleted' => '没有已删除用户',
                    'roles' => '角色',
                    'total' => '总角色',
                ],
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title' => '登陆',
            'login_button' => '登陆',
            'login_with' => '由 :social_media 登陆',
            'register_box_title' => '注册',
            'register_button' => '注册',
            'remember_me' => '记住',
        ],

        'passwords' => [
            'forgot_password' => '忘记密码?',
            'reset_password_box_title' => '重置密码',
            'reset_password_button' => '重置密码',
            'send_password_reset_link_button' => '发送重置密码连接',
        ],

        'macros' => [
            'country' => [
                'alpha' => '国别码',
                'alpha2' => '国别码 2',
                'alpha3' => '国别码 3',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Macro Examples',

            'state' => [
                'mexico' => 'Mexico State List',
                'us' => [
                    'us' => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed' => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => '时区',
        ],

        'user' => [
            'passwords' => [
                'change' => '修改密码',
            ],

            'profile' => [
                'avatar' => '头像',
                'created_at' => '创建于',
                'edit_information' => '修改信息',
                'email' => 'E-mail',
                'last_updated' => '上次更新',
                'name' => '名字',
                'update_information' => '更新信息',
            ],
        ],

    ],
];
