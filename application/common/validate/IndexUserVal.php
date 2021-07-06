<?php

namespace app\common\validate;

use think\Validate;

class IndexUserVal extends Validate
{
    protected $scene=[
        'add'=>['phone','password','re_password'],
    ];
    protected $rule=[
        'phone' => 'require|number|length:11|unique:index_user',
        'password' => 'require|length:6,12',
        're_password' => 'require|confirm:password',
    ];
    protected $message = [
        'phone.require' => '手机号码不符合规范',
        'phone.number' => '手机号码不符合规范',
        'phone.length' => '手机号码不符合规范',
        'phone.unique' => '手机号码已被注册',
        'password.require' => '密码不能为空',
        'password.length' => '密码6-12位',
        're_password.require' => '请重复密码',
        're_password.confirm' => '两次密码不一致',
    ];
}