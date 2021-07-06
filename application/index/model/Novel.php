<?php
namespace app\index\model;

use app\common\model\Novel as NovelModel;

class Novel extends NovelModel
{
	//获取列表
	public function getList($search=[]){
		return $this->where('state',1)
					->order('id desc')
					->paginate(30);
	}
	
	//获取单个
	public function getOne($id = 0){
		$list = $this->where('id',$id)
					->find();
		return $list;
	}
	
}