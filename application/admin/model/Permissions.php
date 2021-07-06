<?php
namespace app\admin\model;

use app\common\model\Permissions as PermissionsModel;

class Permissions extends PermissionsModel
{
	//获取列表
	public function getList($search=[]){
		$name = isset($search['name'])?$search['name']:'';
		return $this->field('id,name,orders')
					->where('name','like','%'.$name.'%')
					->paginate(30);
	}
	
	//获取单个
	public function getOne($id = 0){
		$oneList = $this->where('id',$id)
					->field('id,name,orders,visitId,quanxian')
					->find();
		$oneList['visitId'] = explode('|',$oneList['visitId']);
		$oneList['quanxian'] = explode(',',$oneList['quanxian']);
		return $oneList;
	}
	
	//添加
	public function doadd($data){
		//$validate = validate('PermissionsVal');
		//if(!$validate->scene('add')->check($data)){
        //    return DatajsonError($validate->getError());
        //}
		$data['visitId'] = implode("|",$data['visitId']);
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
					'name'=>$data['name'],
					'level'=>$data['level'],
					'visitId'=>implode("|",$data['visitId']),
				];
		//$validate = validate('PermissionsVal');
		//if(!$validate->scene('update')->check($params)){
        //    return DatajsonError($validate->getError());
        //}
		if($this->update($params)){
			return DatajsonSuccess('修改成功');
		}else{
			return DatajsonError('修改失败');
		}
		
	}
}