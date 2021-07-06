<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Visit extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_visit';
	protected $pk = 'id';
	
	//分类关联
	public function cate(){
		return $this->belongsTo('VisitCategory','cid','id');
	}

}