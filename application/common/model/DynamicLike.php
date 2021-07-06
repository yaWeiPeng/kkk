<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class DynamicLike extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_dynamic_like';
	protected $pk = 'id';
	
	//获取器修改状态
	public function getStateAttr($value){
		$state = [0=>'未点赞',1=>'已点赞'];
		return ['state'=>$value,'text'=>$state[$value]];
	}
	
}