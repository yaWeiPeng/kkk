<?php
namespace app\common\model;

use think\Model;

class LogisticsList extends Model
{
	
	protected $table = 'k_logistics_list';
	protected $pk = 'id';

	
	//一对一用户关联
	public function wuser()
    {
        return $this->hasOne('Wuser','id','uid');
    }
	
	//一对一快递关联
	public function logistics()
    {
        return $this->hasOne('Logistics','logo','logo');
    }
	
	//获取单个
	public function getOne($LogisticCode = 0){
		$list = $this->where('LogisticCode',$LogisticCode)
					->find();
		return $list;
	}
	
}