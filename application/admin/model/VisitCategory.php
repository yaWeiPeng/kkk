<?php
namespace app\admin\model;

use app\common\model\VisitCategory as VisitCategoryModel;

class VisitCategory extends VisitCategoryModel
{
	//获取列表
	public function getList($search=[]){
		return $this->with('son')->select();
	}
	
	//获取单个
	public function getOne($id = 0){
		$list = $this->where('id',$id)
					->find();
		return $list;
	}
	
	//添加
	public function doadd($data){
		if(empty($data['name'])){
			return DatajsonError('保存失败');
		}
		if($this->save($data)){
			return DatajsonSuccess('保存成功');
		}else{
			return DatajsonError('保存失败');
		}
		
	}
	
	//更新
	public function doupdate($data){
		$params = [	
					'id'=>$data['id'],
					'key'=>isset($data['key'])?$data['key']:'',
					'name'=>isset($data['name'])?$data['name']:'',
				];
		if($this->update($params)){
			return DatajsonSuccess('修改成功');
		}else{
			return DatajsonError('修改失败');
		}
	}
	
	//修改状态
	public function state($id){
		$data = $this->getOne($id);
		if($data['state']['state'] == 1){
			$params = ['id'=>$id,'state'=>0];
		}else{
			$params = ['id'=>$id,'state'=>1];
		}
		if($this->update($params)){
			return DatajsonSuccess('修改成功');			
		}else{
			return DatajsonError('修改失败','',$data);			
		}
	}
	
	//删除
	public function del(){
		$this->destroy($_POST['id']);
		return DatajsonSuccess('删除成功');
	}
	
}