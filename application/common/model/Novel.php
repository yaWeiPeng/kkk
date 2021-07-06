<?php
namespace app\common\model;

use app\common\model\Base;

class Novel extends Base
{
	//获取器修改状态
	public function getStateAttr($value){
		$state = [0=>'隐藏',1=>'显示'];
		return ['state'=>$value,'text'=>$state[$value]];
	}
	
	//获取器修改小说状态
	public function getNovelStateAttr($value){
		$state = [0=>'完结',1=>'连载中'];
		return ['state'=>$value,'text'=>$state[$value]];
	}
	
	//小说分类关联
	public function cate(){
		return $this->belongsTo('NovelCategory','cid','id')->field('name');
	}
	
}