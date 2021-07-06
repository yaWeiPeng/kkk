<?php
namespace app\common\model;

use think\Model;

class Logistics extends Model
{
	
	protected $table = 'k_logistics';
	protected $pk = 'id';

	
	//获取器修改状态
	public function getStateAttr($value){
		$state = [0=>'隐藏',1=>'显示'];
		return ['state'=>$value,'text'=>$state[$value]];
	}
}