<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Cookie;

class Base extends Controller
{
    
	protected $redis;
	public function initialize(){
		
		//redis
		//$this->redis = new \Redis();
        //$this->redis->connect("127.0.0.1",6379); 
        //$this->redis->auth('keweipeng');
		//调用库
		//$this->redis->select(1);
		//方法
        //$this->redis->lpush('list2',99);
		$this->is_login();
	}
	
	
	//登录信息
	public function is_login(){
		if(Cookie::has('user')){
			$this->assign([
				'user'=>Cookie::get('user'),
			]);
		}
	}
	
	//获取登录信息
	public function user_info(){
		if(Cookie::has('user')){
			return ['user'=>Cookie::get('user')];
		}else{
			return '暂未登录';
		}
	}
}
