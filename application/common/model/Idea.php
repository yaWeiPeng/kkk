<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Idea extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_idea';
	protected $pk = 'id';
	
	//获取器修改状态
	public function getStateAttr($value){
		$state = [0=>'未读',1=>'已读'];
		return $state[$value];
	}	
	
	//一对一用户信息关联
	public function wuser()
    {
        return $this->hasOne('Wuser','id','uid');
    }
	
}