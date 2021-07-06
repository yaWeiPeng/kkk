<?php
namespace app\admin\model;

use app\common\model\Column as ColumnModel;

class Column extends ColumnModel
{
	public function getAll(){
		return $this->select();
	}
	
	public function getCount(){
		return $this->count();
	}
	
}