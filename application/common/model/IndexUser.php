<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class IndexUser extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_index_user';
	protected $pk = 'id';
	
	
}