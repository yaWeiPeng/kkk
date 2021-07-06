<?php
namespace app\admin\model;

use app\common\model\NovelUrl as NovelUrlModel;

class NovelUrl extends NovelUrlModel
{
	//获取列表
	public function getList($search=[]){
		$url = isset($search['url'])?$search['url']:'';
		return $this->where('url','like','%'.$url.'%')
					->paginate(30);
	}
	
	//获取单个
	public function getOne($id = 0){
		$list = $this->where('id',$id)
					->find();
		return $list;
	}
}