<?php

namespace app\common\validate;

use think\Validate;

class KuaidiVal extends Validate
{
    protected $scene=[
        'add'=>['name','logo','state'],
    ];
    protected $rule=[
        'name' => 'require|unique:logistics',
        'logo' => 'require|unique:logistics',
        'state' => 'require',
    ];
    protected $message = [
        'name.require' => '不能有空',
        'name.unique' => '已经存在',
        'logo.require' => '不能有空',
		'logo.unique' => '已经存在',
        'state.require' => '不能有空',
    ];
}