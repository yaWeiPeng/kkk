<?php
namespace app\common\model;

use app\common\model\Base;

class Field extends Base
{
	
	//获取器类型
	public function getTypeAttr($value){
		$state = ['varchar'=>'输入框','radio'=>'单选','checkbox'=>'多选','img'=>'图片'];
		return ['type'=>$value,'text'=>$state[$value]];
	}

	//caption 表关联
	public function cid(){
		return $this->hasOne('Caption','id','caption_id');
	}
}