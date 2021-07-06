<?php
namespace app\index\model;

use app\common\model\NovelContent as NovelContentModel;

class NovelContent extends NovelContentModel
{
	//获取列表
	public function getList($id = 0 ,$page = false){
		if($page){
			$list = $this->where('novel_id',$id)
						->order('id','asc')
						->field('id,content,title,novel_id')
						->paginate(20);
		}else{
			$list = $this->where('novel_id',$id)
						->order('id','asc')
						->field('id,content,title,novel_id')
						->select();
		}
		return $list;
	}
	
}