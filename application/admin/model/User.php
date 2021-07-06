<?php
namespace app\admin\model;

use app\common\model\User as UserModel;

class User extends UserModel
{
	//登录
	public function login($data){
		$data['password'] = caption_hash($data['password']);
		$account = $this->where('username',$data['username'])->find();
		if(!empty($account)){
			if($data['password'] == $account['password']){
				return $account['id'];
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	//获取列表
	public function getList($search=[]){
		$username = isset($search['username'])?$search['username']:'';
		return $this->with('permissions')
					->where('username','like','%'.$username.'%')
					->paginate(30);
	}
	
	//获取单个
	public function getOne($id = 0){
		return $this->where('id',$id)
					->field('id,username,tel,permissions_id')
					->find();
	}
	
	//添加
	public function doadd($data){
		$validate = validate('UserVal');
		if(!$validate->scene('add')->check($data)){
            return DatajsonError($validate->getError());
        }
		unset($data['repass']);
		$data['password'] = caption_hash($data['password']);
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
					'permissions_id'=>isset($data['permissions_id'])?$data['permissions_id']:'',
					'password'=>isset($data['password'])?$data['password']:'',
					'repass'=>isset($data['repass'])?$data['repass']:'',
				];
		if(!empty($params['password']) || !empty($params['repass'])){
			$validate = validate('UserVal');
			if(!$validate->scene('update')->check($params)){
				return DatajsonError($validate->getError());
			}
			unset($params['repass']);
			$params['password'] = md5($params['password']);
		}else{
			unset($params['password']);
			unset($params['repass']);
		}
		if($this->update($params)){
			return DatajsonSuccess('修改成功');
		}else{
			return DatajsonError('修改失败');
		}
		
	}
	
	//获取账户信息
	public function account_info($id){
		return $this
			->with(['permissions'])
			->where('id',$id)
			->field('username,permissions_id')
			->find();
	}
}