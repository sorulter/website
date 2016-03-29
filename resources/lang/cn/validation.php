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

    'accepted' => ':attribute没有被确认.',
    'active_url' => ':attribute是无效的URL.',
    'after' => ':attribute必须是:date之后的日期.',
    'alpha' => ':attribute只能是字母.',
    'alpha_dash' => ':attribute中只能使用字母、数字、连字符、下划线.',
    'alpha_num' => ':attribute只能使用字母和数字.',
    'array' => ':attribute必须是数组.',
    'before' => 'The :attribute必须是:date之前的日期.',
    'between' => [
        'numeric' => ':attribute必须介于:min到:max之间.',
        'file' => ':attribute必须介于:min到:max KB之间.',
        'string' => ':attribute必须介于:min到:max字之间.',
        'array' => ':attribute必须介于:min到:max 之间.',
    ],
    'boolean' => ':attribute字段值只能是 true 或者 false.',
    'confirmed' => ':attribute和确认字段不一致.',
    'date' => ':attribute不是正确的日期',
    'date_format' => ':attribute不是:format这种格式.',
    'different' => ':attribute和:other必须不同.',
    'digits' => ':attribute必须是:digits位.',
    'digits_between' => ':attribute必须介于:min到:max之间.',
    'email' => ':attribute不是有效的邮件地址.',
    'exists' => '选择的:attribute无效.',
    'filled' => ':attribute字段必须.',
    'image' => ':attribute必须是图片文件.',
    'in' => '选择的:attribute不正确.',
    'integer' => ':attribute必须是整数.',
    'ip' => ':attribute不是正确的IP地址.',
    'json' => ':attribute不是合法的 JSON 字符串.',
    'min' => [
        'string' => ':attribute 至少应该包含 :min 字符.',
    ],
    'unique' => ':attribute已被占用.',
    'black' => '请使用其它邮件地址.',

    'required' => '请填写:attribute.',
    'captcha' => '验证码错误',
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
        'email' => [
            'unique_mail' => '邮箱已注册.请尝试 <a href="/login">登录</a>',
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
        'email' => '邮箱',
        'password' => '密码',
        'captcha' => '验证码',
    ],

];
