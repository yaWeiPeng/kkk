<?php

namespace app\common\validate;

use think\Validate;

class UserVal extends Validate
{
    protected $scene=[
        'add'=>['tel','username','password','repass'],
        'update'=>['password','repass'],
    ];
    protected $rule=[
        'tel' => 'require|number|length:11|unique:user',
        'username' => 'require|length:3,10|unique:user',
        'password' => 'require|length:6,12',
        'repass' => 'require|confirm:password',
    ];
    protected $message = [
        'tel.require' => '手机号码不符合规范',
        'tel.number' => '手机号码不符合规范',
        'tel.length' => '手机号码不符合规范',
        'tel.unique' => '手机号码已被注册',
        'username.require' => '用户名3-10位',
        'username.length' => '用户名3-10位',
        'username.unique' => '用户名重复',
        'password.require' => '密码不能为空',
        'password.length' => '密码6-12位',
        'repass.require' => '请重复密码',
        'repass.confirm' => '两次密码不一致',
    ];
}