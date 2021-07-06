<?php
namespace app\admin\model;

use app\common\model\ArticleType as ArticleTypeModel;

class ArticleType extends ArticleTypeModel
{
	
	//获取列表
	public function getList($search=[]){
		$name = isset($search['name'])?$search['name']:'';
		$state = isset($search['state'])?$search['state']:'';
		return $this->where('name','like','%'.$name.'%')
					->where('state','like','%'.$state.'%')
					->paginate(30);
	}
	
	//获取单个
	public function getOne($id = 0){
		return $this->where('id',$id)
					->field('id,name,state')
					->find();
	}
	
	//保存
	public function doadd($data){
		$validate = validate('ArticleVal');
		if(!$validate->scene('type')->check($data)){
           return DatajsonError($validate->getError());
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
					'state'=>isset($data['state'])?$data['state']:'',
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
			$params = ['state'=>0];
		}else{
			$params = ['state'=>1];
		}
		if($this->where('id',$id)->update($params)){
			return DatajsonSuccess('修改成功');			
		}else{
			return DatajsonError('修改失败','',$data);			
		}
	}
	
	
}