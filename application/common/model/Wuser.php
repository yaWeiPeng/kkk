<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Wuser extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_wuser';
	protected $pk = 'id';
	
	//获取器修改性别
	public function getGenderAttr($value){
		$sex = [0=>'未知',1=>'男',2=>'女'];
		return $sex[$value];
	}	
	
}