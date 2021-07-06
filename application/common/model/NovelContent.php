<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class NovelContent extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_novel_content';
	protected $pk = 'id';

}