<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'captcha'              => '人机识别校验失败，请刷新重试。',
    'accepted'             => '必须接受 :attribute 。',
    'active_url'           => ':attribute 不是有效的网址。',
    'after'                => ':attribute 必须是日期之后的日期。',
    'alpha'                => ':attribute 只能包含字母。',
    'alpha_dash'           => ':attribute 只能包含字母，数字和破折号。',
    'alpha_num'            => ':attribute 只能包含字母和数字。',
    'array'                => ':attribute 必须是数组。',
    'before'               => ':attribute 必须是之前的日期 :date 。',
    'between'              => [
        'numeric' => ':attribute 必须介于 :min 和 :max 之间。',
        'file'    => ':attribute 必须介于 :min 和 :max 字节之间。',
        'string'  => ':attribute 必须介于 :min 和 :max 字符之间。',
        'array'   => ':attribute 必须介于 :min 和 :max 项之间。',
    ],
    'boolean'              => ':attribute 字段必须为true或false！',
    'confirmed'            => ':attribute 确认不匹配！',
    'date'                 => ':attribute 不是有效的日期！',
    'date_format'          => ':attribute 与格式 :format 不匹配！',
    'different'            => ':attribute 和 :other 必须不同！',
    'digits'               => ':attribute 必须为 :number 数字！',
    'digits_between'       => ':attribute 必须介于 :min 和 :max 数字之间！',
    'dimensions'           => ':attribute 的图片尺寸无效！',
    'distinct'             => ':attribute 字段具有重复值！',
    'email'                => ':attribute 必须是有效的电子邮件地址！',
    'exists'               => 'selected:attribute 无效！',
    'file'                 => ':attribute 必须是一个文件。',
    'filled'               => ':attribute 字段必填！',
    'image'                => ':attribute 必须是图像！',
    'in'                   => 'selected:attribute 无效！',
    'in_array'             => ':attribute 字段不存在于 :other中！',
    'integer'              => ':attribute 必须是整数！',
    'ip'                   => ':attribute 必须是有效的IP地址！',
    'json'                 => ':attribute 必须是有效的JSON字符串！',
    'max'                  => [
        'numeric' => ':attribute 不能大于 :max 。',
        'file'    => ':attribute 不能大于 :max 千字节。',
        'string'  => ':attribute 不能大于 :max 个字符。',
        'array'   => ':attribute 不能超过 :max 项。',
    ],
    'mimes'                => ':attribute 必须是类型 :value 的文件。',
    'min'                  => [
        'numeric' => ':attribute 必须至少为 :min 。',
        'file'    => ':attribute 必须至少为 :min 千字节。',
        'string'  => ':attribute 必须至少为 :min 个字符。',
        'array'   => ':attribute 必须至少包含 :min 项。',
    ],
    'not_in'               => 'selected:attribute 无效。',
    'numeric'              => ':attribute 必须是数字。',
    'present'              => ':attribute 字段必须存在。',
    'regex'                => ':attribute 格式无效。',
    'required'             => ':attribute 字段必填！',
    'required_if'          => '当 :other是 :value 时，需要:attribute 字段。',
    'required_unless'      => ':attribute 字段必填，除非 :other是in :values 。',
    'required_with'        => '当 :值存在时，需要:attribute 字段。',
    'required_with_all'    => '当 :值存在时，需要:attribute 字段。',
    'required_without'     => '当 :值不存在时，需要:attribute 字段。',
    'required_without_all' => '当没有 :值存在时，需要:attribute 字段。',
    'same'                 => ':attribute 和 :其他必须匹配。',
    'size'                 => [
        'numeric' => ':attribute 必须是 :size。',
        'file'    => ':attribute 必须为 :size kilobytes。',
        'string'  => ':attribute 必须为 :size个字符。',
        'array'   => ':attribute 必须包含 :size项。',
    ],
    'string'               => ':attribute 必须是字符串。',
    'timezone'             => ':attribute 必须是有效的区域。',
    'unique'               => '已经采用 :attribute 。',
    'url'                  => ':attribute 格式无效。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => '自定义消息',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' => '关联角色',
                    'dependencies' => '依赖',
                    'display_name' => '显示名称',
                    'group' => '组',
                    'group_sort' => '组排序',

                    'groups' => [
                        'name' => '组名称',
                    ],

                    'name' => '名称',
                    'system' => '系统？',
                ],

                'roles' => [
                    'associated_permissions' => '相关权限',
                    'name' => '名称',
                    'sort' => '分类',
                ],

                'users' => [
                    'active' => '活性',
                    'associated_roles' => '关联角色',
                    'confirmed' => '确认',
                    'email' => '电子邮件地址',
                    'name' => '名称',
                    'other_permissions' => '其他权限',
                    'password' => '密码',
                    'password_confirmation' => '确认密码',
                    'send_confirmation_email' => '发送确认电子邮件',
                ],
            ],
        ],

        'frontend' => [
            'email' => '电子邮件地址',
            'name' => '名称',
            'password' => '密码',
            'password_confirmation' => '确认密码',
            'old_password' => '旧密码',
            'new_password' => '新密码',
            'new_password_confirmation' => '新密码确认',
        ],
    ],

];
