<?php
namespace app\admin\model;

use app\common\model\Wuser as WuserModel;

class Wuser extends WuserModel
{
	
	//获取列表
	public function getList($search=[]){
		$gender = isset($search['gender'])?$search['gender']:'';
		if($gender == 3){
			$gender = 0;
		}
		return $this->where('gender','like','%'.$gender.'%')
					->paginate(10);
	}
	
}