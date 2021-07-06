<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class NovelHistory extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_novel_history';
	protected $pk = 'id';
	
	//小说关联
	public function novel()
    {
        return $this->belongsTo('Novel','nid','id')->bind(['novel_title'=>'title']);
    }
	
	//章节关联
	public function chapter()
    {
        return $this->belongsTo('NovelContent','cid','id')->bind(['chapter_title'=>'title']);
    }
	
}