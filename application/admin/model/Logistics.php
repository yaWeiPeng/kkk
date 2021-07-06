<?php
namespace app\admin\model;

use app\common\model\Logistics as LogisticsModel;

class Logistics extends LogisticsModel
{
	//获取列表
	public function getList($search=[]){
		$name = isset($search['name'])?$search['name']:'';
		return $this->where('name','like','%'.$name.'%')
					->order('id asc')
					->paginate(30);
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
		if($this->where('id',$id)->update(['state'=>$data['state']['state']==1?0:1])){
			return DatajsonSuccess('修改成功');			
		}else{
			return DatajsonError('修改失败','',$data);			
		}
	}
	
	//添加
	public function doadd($data){
		$validate = validate('KuaidiVal');
		if(!$validate->scene('add')->check($data)){
            return DatajsonError($validate->getError());
        }
		if($this->allowField(true)->save($data)){
			return DatajsonSuccess('保存成功');
		}else{
			return DatajsonError('保存失败');
		}
		
	}
	
	//更新
	public function doupdate($data){
		$params = [	
					'id'=>$data['id'],
					'name'=>isset($data['name'])?$data['name']:'',
					'logo'=>isset($data['logo'])?$data['logo']:'',
					'state'=>isset($data['state'])?$data['state']:'',
				];
		if($this->allowField(true)->update($params)){
			return DatajsonSuccess('修改成功');
		}else{
			return DatajsonError('修改失败');
		}
		
	}
	
	
}