<?php
namespace app\common\model;

use app\common\model\Base;

class Column extends Base
{
	//option树形显示
	protected $treeStr = '';
	
	//数组显示
	protected $listsArr = [];
	
	//显示
	public function getStatusAttr($value){
		$status = [0=>'隐藏',1=>'显示'];
		return ['status'=>$value,'text'=>$status[$value]];
	}
	
	public function getAll(){
		return $this->select();
	}
	
	public function getCount(){
		return $this->count();
	}
	
	// $type 类型,$pid 上级id,$where 参数
	public function category($type = 'tree',$pid = 0,$where=[]){
		$category = $this->where('pid',$pid)->where($where)->select()->toArray();
		if($type == 'option'){
			$category = $this->where('pid',0)->where($where)->select()->toArray();
		}
		if(empty($category)){
			return false;
		}
		
		foreach($category as $k=>$v){
			if($v['id'] == $pid){
				$select = 'selected';
			}else{
				$select = '';
			}
			$this->treeStr .= "<option value='{$v['id']}' {$select}>{$v['column_name']}</option>";
			$category[$k]['son'] = $this->son($v['id'],$pid,'',$where);
		}
		if($type == 'list'){			//列表结构
			$category = $this->lists($category);
		}else if($type == 'option'){	//下拉结构
			$category = $this->treeStr;
		}else if($type == 'tree'){		//树形结构
			$category = $category;
		}
		return $category;
	}
	
	public function son($id='',$pid='',$level=2,$where=[]){
		$son = $this->where('pid',$id)->where($where)->select()->toArray();
		if($son){
			$str = '';
			for($i=1;$i<=$level;$i++){
				$str .= '-';
			}
			foreach($son as $k=>$v){
				if($v['id'] == $pid){
					$select = 'selected';
				}else{
					$select = '';
				}
				$this->treeStr .= "<option value='{$v['id']}' {$select}>|{$str}{$v['column_name']}</option>";
				$son[$k]['son'] = $this->son($v['id'],$pid,$level+1,$where=[]);
			}
		}
		return $son;
	}
	
	public function lists($lists){
		foreach ($lists as $v){
			$arr = ['id'=>$v['id'],'pid'=>$v['pid'],'column_name'=>$v['column_name'],'url'=>$v['url'],'status'=>$v['status'],'orders'=>$v['orders'],'create_time'=>$v['create_time'],'son'=>0];
			$this->listsArr[]=$arr;
			if(!empty($v['son'])){
				$this->listsArr[count($this->listsArr)-1]['son'] = 1;
				$this->lists($v['son']);
			}
		}
		return $this->listsArr;
	}
	
}