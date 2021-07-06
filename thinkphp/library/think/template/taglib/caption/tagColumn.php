<?php

namespace think\template\taglib\caption;

use think\Db;
use think\facade\Session;

class tagColumn
{
    public function getColumn($type,$pid,$field,$status=''){
		//dump($status);
		$tagcolumn = new \app\common\model\Column();
		$user = Session::get('userInfo');
		$quanxian = [];
		//if($user['permissions_id']!=5){
			//$quanxian = explode(',',$user['permissions']['quanxian']);
		//}
		if($type == 'top'){
			$taglist = $tagcolumn->where("pid",0)->where("status",$status)->field("'.$field.'")->select()->toArray();
		}elseif($type == 'son'){
			$taglist = $this->category($pid,$quanxian,$status);
		}
		return $taglist;
    }
	
	// $type 类型,$pid 上级id,$where 参数
	public function category($pid = 0,$quanxian,$status=''){
		//dump($quanxian);
		$tagcolumn = new \app\common\model\Column();
		$where = [];
		$where[] = ['pid','=',$pid];
		if($status != ''){
			$where[] = ['status','=',$status];
		}
		//foreach($quanxian as $v){
			//$q = $tagcolumn->where('id',$v)->value('pid');
			//if($q == $pid){
				//$where[] = ['id','=',$v];
				//$where[] = $v;
			//}
		//}
		//dump($where);
		//dump($quanxian);
		//if(empty($where))return false;
		
		$category = $tagcolumn->where($where)->select()->toArray();
		//dump($tagcolumn->where($where)->fetchSql()->select());
		//$category = $tagcolumn->get('')->toArray();
		//dump($category);
		//if(empty($category))return false;
		foreach($category as $k=>$v){
			//if(in_array($v['id'],$quanxian)){
				$category[$k]['son'] = $this->son($v['id'],$quanxian,$status);
			//}
		}
		return $category;
	}
	
	public function son($id='',$quanxian,$status='1'){
		$tagcolumn = new \app\common\model\Column();
		$son = $tagcolumn->where('pid',$id)->where("status",$status)->select()->toArray();
		if($son){
			foreach($son as $k=>$v){
				//if(in_array($v['id'],$quanxian)){
					$son[$k]['son'] = $this->son($v['id'],$quanxian);
				//}else{
				//	unset($son[$k]);
				//}
			}
		}
		return $son;
	}
}