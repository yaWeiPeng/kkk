<?php

namespace app\common\validate;

use think\Validate;

class AllVal extends Validate
{
	protected $regex = [ 	
							'model' => '[A-Za-z]{2,15}',
							'field' => '[A-Za-z]{2,15}(_){0,}[A-Za-z]{0,}',
						];
	
    protected $scene=[
        'add'=>['title','state','tid'],
        'type'=>['name','state'],
		'TableAdd'=>['model','name'],
		'FieldAdd'=>['field','type'],
    ];
    protected $rule=[
        'title' => 'require',
		'state' => 'require',
		'tid' => 'require',
		'model' => 'require|unique:caption|regex:model',
		'name' => 'require',
		'type' => 'require',
		'field' => 'require|unique:field|regex:field',
    ];
    protected $message = [
        'title.require' => '不能为空',
        'state.require' => '不能为空',
        'tid.require' => '不能为空',
        'name.require' => '不能为空',
		'model.require' => '不能为空',
		'model.unique' => '有相同存在',
		'model.regex' => '2-15位且是字母,区分大小写',
		'type.require' => '不能为空',
		'field.require' => '不能为空',
		'field.unique' => '有相同存在',
		'field.regex' => '2-15位且是字母,区分大小写',
    ];
}