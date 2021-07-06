<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class VisitCategory extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_visit_category';
	protected $pk = 'id';
	
	//关联
	public function son(){
		return $this->hasMany('Visit','cid','id');
	}

}