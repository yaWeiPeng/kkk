<?php
namespace app\index\controller;

use app\common\library\Yzm\Seed;
use app\index\model\IndexUser as IndexUserModel;
use think\facade\Session;
use think\facade\Cookie;

class Login extends Base
{
	
	public function login(){
		$this->assign('title','手机登录');
		return view('/login');
	}
	
	public function reg(){
		$this->assign('title','短信注册');
		return view('/reg');
	}

	//发送短信
	public function seed(){
		$sms = new Seed();
		return $sms->message($_POST);
	}
	
	//注册
	public function do_reg(){
		return (new IndexUserModel)->reg($_POST);
	}
	
	//登录
	public function do_login(){
		return (new IndexUserModel)->login($_POST);
	}
	
	//退出
	public function do_exit(){
		Cookie::delete('user');
		return DatajsonSuccess('退出成功');
	}
}
