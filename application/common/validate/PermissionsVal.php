<?php

namespace app\common\validate;

use think\Validate;

class PermissionsVal extends Validate
{
    protected $scene=[
        'add'=>['name','level'],
        'update'=>['name','level'],
    ];
    protected $rule=[
        'level' => 'require|number|length:1,2|unique:permissions',
        'name' => 'require|length:1,2|unique:permissions',
    ];
    protected $message = [
        'level.require' => '等级不符合规范',
        'level.number' => '等级不符合规范',
        'level.length' => '等级不符合规范',
        'level.unique' => '等级重复了',
        'name.require' => '权限名1-10位',
        'name.length' => '权限名1-10位',
        'name.unique' => '权限名重复',
    ];
}