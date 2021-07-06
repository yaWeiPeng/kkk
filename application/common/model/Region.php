<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Region extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_region';
	protected $pk = 'id';

}