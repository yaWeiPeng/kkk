<?php
namespace app\common\model;

use app\common\model\Base;

class Caption extends Base
{
	
	//获取器类型
	public function getTypeAttr($value){
		$state = [0=>'非系统模型',1=>'系统模型'];
		$color = [0=>'black',1=>'red'];
		return ['type'=>$value,'text'=>$state[$value],'color'=>$color[$value]];
	}

	//field 表关联
	public function fid(){
		return $this->hasMany('field','caption_id','id');
	}
	

}