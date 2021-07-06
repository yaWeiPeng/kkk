<?php

namespace app\common\validate;

use think\Validate;

class ArticleVal extends Validate
{
    protected $scene=[
        'add'=>['title','state','tid'],
        'type'=>['name','state'],
    ];
    protected $rule=[
        'title' => 'require',
		'state' => 'require',
		'tid' => 'require',
		'name' => 'require',
    ];
    protected $message = [
        'title.require' => '标题不能为空',
        'state.require' => '状态不能为空',
        'tid.require' => '类型不能为空',
        'name.require' => '名字不能为空',
    ];
}