<?php
namespace app\admin\model;

use app\common\model\Region as RegionModel;

class Region extends RegionModel
{
	
	//获取列表 		all 列表 ，tree 树形
	public function getList($search=[] , $type='all'){
		$pid = isset($search['pid'])?$search['pid']:0;
		if($type == 'all'){
			$list = $this->where('pid',$pid)->select()->toArray();
		}else if($type == 'tree'){
		}
		return $list;
	}
	
}