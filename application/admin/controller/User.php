<?php
namespace app\admin\controller;

use app\admin\model\User as UserModel;
use app\admin\model\Permissions as PermissionsModel;

class User extends Base
{
	//用户列表
	public function getindex(){
		$this->assign([
			'data' => $this->searchData('permissions'),
			'search' => $this->searchKeys(),
		]);
		return view('/user');
	}
	
	public function getedit(){
		if(input('id')){
			$data = model('user')->where('id',input('id'))->find();
			$this->assign([
				'data' => $data,
			]);
		}
		$this->assign([
			'permissions' => model('permissions')->select(),  
			]);
		return view("/user_edit");
	}
	
	public function postdoedit(){
		$data = input('data');
		if(isset($data['id'])){
			return (new UserModel)->doupdate($data);
		}else{
			return (new UserModel)->doadd($data);
		}
	}
	
	public function postorders(){
		$data = input('data');
		model('user')->where('id',$data['id'])->update(['orders'=>$data['value']]);
		return DatajsonSuccess('修改成功');
	}
	
	public function postdel(){
		$id = input('id');
		if(empty($id)){
			return DatajsonError('未选中任何需要删除的内容');
		}
		$res = model('user')->destroy($id);
		if($res){
			return DatajsonSuccess('删除成功');
		}else{
			return DatajsonError('删除失败');
		}
	}
}