<?php
namespace app\api\model;

use app\common\model\Article as ArticleModel;

class Article extends ArticleModel
{
	
	//获取单个
	public function getOne($id = 0){
		$list = $this->where('id',$id)
					->where('state',1)
					->field('id,title,state,tid,pic')
					->find();
		return $list;
	}
	
}