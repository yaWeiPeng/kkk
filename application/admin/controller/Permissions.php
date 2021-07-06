<?php
namespace app\admin\controller;

use app\admin\model\Permissions as PermissionsModel;

class Permissions extends Base
{
	
	public function getindex(){
		$this->assign([
			'data' => $this->searchData(),
			'search' => $this->searchKeys(),
			]);
		return view('/permissions');
	}
	
	public function getedit(){
		$model = new PermissionsModel;
		$column = model('column')->category();
		if(input('id')){
			$data = $model->getOne(input('id'));
			$this->assign([
				'data' => $data,
			]);
		}
		$this->assign([
			'column' => $column,   
			]);
		return view("/permissions_edit");
	}
	
	public function postdoedit(){
		$data = input('data');
		$data['quanxian'] = implode(',',$data['quanxian']);
		if(isset($data['id'])){
			model('permissions')->allowField(true)->isUpdate(true,['id'=>$data['id']])->save($data);
			return DatajsonSuccess('修改成功','',[]);
		}else{
			model('permissions')->save($data);
			return DatajsonSuccess('保存成功','',[]);
		}
	}
	
	public function postorders(){
		$data = input('data');
		model('permissions')->where('id',$data['id'])->update(['orders'=>$data['value']]);
		return DatajsonSuccess('修改成功');
	}
	
	public function postdel(){
		$id = input('id');
		if(empty($id)){
			return DatajsonError('未选中任何需要删除的内容');
		}
		$res = model('permissions')->destroy($id);
		if($res){
			return DatajsonSuccess('删除成功');
		}else{
			return DatajsonError('删除失败');
		}
	}
	
}