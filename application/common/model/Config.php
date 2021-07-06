<?php
namespace app\common\model;

use think\Model;

class Config extends Model
{
	
	protected $table = 'k_config';
	protected $pk = 'id';
	
	
	//单条数据
	public function getOne($key){
		return $this->where('key',$key)->find();
	}

}