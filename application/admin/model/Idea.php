<?php
namespace app\admin\model;

use app\common\model\Idea as IdeaModel;

class Idea extends IdeaModel
{
	
	//获取列表
	public function getList($search=[]){
		$state = isset($search['state'])?$search['state']:'';
		if($state == 2){
			$state = 0;
		}
		return $this->with('wuser')
					->where('state','like','%'.$state.'%')
					->order('id', 'desc')
					->paginate(30);
	}
	
	//获取单个
	public function getOne($id = 0){
		//修改状态
		$this->doupdate(['id'=>$id,'state'=>1]);
		return $this->where('id',$id)
					->field('content')
					->find();
	}
	
	public function doadd($data){
		if($this->save($data)){
			return DatajsonSuccess('保存成功');
		}else{
			return DatajsonError('保存失败');
		}
		
	}
	
	//更新
	public function doupdate($data){
		if($this->update($data)){
			return DatajsonSuccess(1,'修改成功');
		}else{
			return DatajsonError('修改失败');
		}
		
	}
	
}