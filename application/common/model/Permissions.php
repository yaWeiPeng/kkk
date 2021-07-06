<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Permissions extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_permissions';
	protected $pk = 'id';
	

}