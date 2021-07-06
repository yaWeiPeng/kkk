<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
	//软删除
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	//数据表
	protected $table = 'k_user';
	//主键
	protected $pk = 'id';
	
	//权限关联
	public function permissions()
    {
        return $this->hasOne('Permissions','id','permissions_id')->field('id,name,orders,visitId,quanxian');
    }
}