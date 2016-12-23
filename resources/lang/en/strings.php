<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm' => '您确定要永久删除此用户吗？引用此用户ID的应用程序中的任何地方都很可能是错误。继续自行承担风险。这不能被撤消。',
                'if_confirmed_off' => '（如果确认已关闭）',
                'restore_user_confirm' => '将此用户恢复到其原始状态？',
            ],
        ],

        'dashboard' => [
            'title' => '管理后台',
            'welcome' => '欢迎',
        ],

        'general' => [
            'dashboard_name' => '控制台',
            'all_rights_reserved' => '233SEC TEAM 版权所有。',
            'are_you_sure' => '你确定？',
            'boilerplate_link' => '由 PHP7 + Laravel 5 驱动',
            'continue' => '继续',
            'member_since' => '会员自',
            'minutes' => ' 分钟',
            'search_placeholder' => '搜索...',
            'timeout' => '出于安全考虑，您已自动退出登录，因为您很久没活跃',

            'see_all' => [
                'messages' => '查看所有邮件',
                'notifications' => '查看全部',
                'tasks' => '查看所有任务',
            ],

            'status' => [
                'online' => '在线',
                'offline' => '离线',
            ],

            'you_have' => [
                'messages' => '{0}您没有消息| {1}您有1个消息| [2，Inf]您有 :number messages',
                'notifications' => '{0}您没有通知| {1}您有1个通知| [2，Inf]您有 :number notifications',
                'tasks' => '{0}你没有任务| {1}你有1个任务| [2，Inf]你有 :number tasks',
            ],
        ],
    ],

    'emails' => [
        'auth' => [
            'password_reset_subject' => '您的密码重置链接',
            'reset_password' => '点击这里重置密码',
        ],
    ],

    'frontend' => [
        'email' => [
            'confirm_account' => '点击此处确认您的帐户 :',
        ],

        'test' => '测试',

        'tests' => [
            'based_on' => [
                'permission' => '基于权限',
                'role' => '基于角色',
            ],

            'js_injected_from_controller' => '从控制器注入Javascript',

            'using_blade_extensions' => '使用刀片式扩展',

            'using_access_helper' => [
                'array_permissions' => '使用访问助手与用户必须拥有所有权限的数组的权限名称或ID',
                'array_permissions_not' => '使用访问助手与用户不必拥有的权限名称或ID的数组',
                'array_roles' => '使用访问助手与角色名称或ID的数组，用户必须拥有所有。',
                'array_roles_not' => '使用访问助手与角色名称或ID \数组，用户不必拥有所有。',
                'permission_id' => 'Using Access Helper with Permission ID',
                'permission_name' => '使用访问助手与权限名称',
                'role_id' => 'Using Access Helper with Role ID',
                'role_name' => '使用访问助手与角色名称',
            ],

            'view_console_it_works' => 'View控制台，你应该看到它的工作！这是来自FrontendController @ index',
            'you_can_see_because' => '你可以看到这个，因为你有角色 :role ！',
            'you_can_see_because_permission' => '你可以看到这是因为你有权限 :permission ！',
        ],

        'user' => [
            'profile_updated' => '个人资料已成功更新。',
            'password_updated' => '密码已成功更新。',
        ],

        'welcome_to' => '欢迎来到 :space',
    ],
];
