<?php
namespace app\admin\model;

use app\common\model\Novelcategory as NovelCategoryModel;

class Novelcategory extends NovelCategoryModel
{
	//获取列表 无限分类  type:all全部 tree树形
	public function getList($search=[],$type = 'all'){
		if($type == 'tree'){
			//第一次顶级
			$list = $this->where('pid',0)->select();
			foreach($list as $k=>$v){
				$list[$k]['next'] = $this->cate($v['id']);
			}
		}else if($type == 'all'){
			$list = $this->select();
			//查子类
			foreach($list as $k=>$v){
				$son = $this->where('pid',$v['id'])->select()->toArray();
				if($son){
					$list[$k]['son'] = 1;
				}else{
					$list[$k]['son'] = 0;
				}
			}
		}
		return $list;
	}
	
	//获取分类下级
	public function cate($pid ,$level=2){
		$list = $this->where('pid',$pid)->select()->toArray();
		$str = '';
		for($num = 1;$num<$level;$num++){
			$str .= '---';
		}
		if(!empty($list)){
			foreach($list as $k=>$v){
				$list[$k]['name'] = trim($str.'|'.$v['name']);
				$list[$k]['next'] = $this->cate($v['id'] , $level + 1);
			}
		}
		return $list;
	}
	
	//获取单个
	public function getOne($id = 0){
		$list = $this->where('id',$id)
					->find();
		return $list;
	}
	
	//修改状态
	public function state($id){
		$data = $this->getOne($id);
		$params = [
					'id'=>$id,
					'state'=>$data['state']['state']==1?0:1,
				];
		if($this->update($params)){
			return DatajsonSuccess('修改成功');			
		}else{
			return DatajsonError('修改失败','',$data);			
		}
	}
	
	//添加
	public function doadd($data){
		if($this->save($data)){
			return DatajsonSuccess('保存成功');
		}else{
			return DatajsonError('保存失败');
		}
	}
	
	//判断是否有子类
	public function isSon($id){
		$pid = ($this->getOne($id))['pid'];
		$son = $this->where('pid',$id)->select()->toArray();
		return $son;
	}
	
	//更新
	public function doupdate($data){
		//判断是否有子类，有子类不允许修改分类
		if(!empty($this->isSon($data['id'])) && $pid != $data['pid']){
			return DatajsonError('该分类下有子类，不能更换父类');
		}
		$params = [	
					'id'=>$data['id'],
					'pid'=>isset($data['pid'])?$data['pid']:'',
					'state'=>isset($data['state'])?$data['state']:'',
					'name'=>isset($data['name'])?$data['name']:'',
				];
		if($this->update($params)){
			return DatajsonSuccess('修改成功');
		}else{
			return DatajsonError('修改失败');
		}
	}
	
	//删除
	public function del($id){
		if(empty($id)){
			return Datejson(0,'未选中任何需要删除的内容');
		}
		if(is_array($id)){
			$ids = '';
			foreach($id as $v){
				if(!empty($this->isSon($v))){
					$ids .= $v.',';
				}
			}
			return DatajsonError('删除失败,以下id有子类无法删除'.$ids);
		}else{
			if(!empty($this->isSon($id))){
				return DatajsonError('删除失败,有子类无法删除');
			}
		}
		if($this->destroy($id)){
			return DatajsonSuccess('删除成功');
		}else{
			return DatajsonError('删除失败');
		}
	}
}