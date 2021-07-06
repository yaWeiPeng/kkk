<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_article';
	protected $pk = 'id';

	//获取器修改状态
	public function getStateAttr($value){
		$state = [0=>'隐藏',1=>'显示'];
		return ['state'=>$value,'text'=>$state[$value]];
	}
	
	//修改图片
	public function getPicAttr($value){
		if($value != ''){
			$pic = explode(',',$value);
			array_shift($pic);
			return $pic;
		}else{
			return $value;
		}
	}

	//文章类型关联
	public function type(){
		return $this->hasOne('ArticleType','id','tid');
	}
}