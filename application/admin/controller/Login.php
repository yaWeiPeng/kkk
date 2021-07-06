<?php
namespace app\admin\controller;

use app\admin\model\User as UserModel;
use think\facade\Session;

class Login extends Base
{
	
	//登录
	public function getlogin(){
		return view('admin/login');
	}
	
	//登录操作
	public function postlogin(){
		$model = new UserModel;
		$id = $model->login(input('post.data'));
		if($id){
			$info = $this->isuser($id)->toArray();
			//保存用户信息
			$this->keep_userinfo($info);
			//$data['jwt'] = token($id);    //这个是返回token，网页端不适用
			return DatajsonSuccess('登录成功','/admin');
		}else{
			return DatajsonError('登录名或者密码错误，重新填写');
		}
	}
	
	public function postoutlogin(){
		Session::delete('userInfo'); 
		return DatajsonSuccess('退出成功','/login/login');
	}
	
	//保存用户信息
	private function keep_userinfo($info){
		
		$info['login_time'] = date('Y-m-d H:i:s',time());
		Session::set('userInfo',$info);		
	}
    
	//获取登录账号信息
	private function isuser($id = 0){
		return (new UserModel)->account_info($id);
	}

}