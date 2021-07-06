<?php
namespace app\index\model;

use think\facade\Cache;
use think\facade\Cookie;
use app\common\model\IndexUser as IndexUserModel;

class IndexUser extends IndexUserModel
{
	
	//注册
	public function reg($data){
		$validate = validate('IndexUserVal');
		if(!$validate->scene('add')->check($data)){
           return DatajsonError($validate->getError());
        }
		$data['password'] = caption_hash($data['password']);
		$key = $data['phone'];
		$value = Cache::get($key);
		if(Cache::has("$key") && $value['yzm'] == $data['code']){
			if($this->allowField(true)->save($data)){
				return DatajsonSuccess('注册成功');
			}
		}
		return DatajsonError('验证码错误');
	}
	
	//登录
	public function login($data){
		$userinfo = $this->where('phone',$data['phone'])->find();
		if($data['phone'] != $userinfo['phone'] || caption_hash($data['password']) != $userinfo['password']){
			return DatajsonError('账号或者密码错误','',$data);
		}else{
			$info = ['id'=>$userinfo['id'],'phone'=>$data['phone']];
			Cookie::set('user',$info);
			return DatajsonSuccess('登录成功');
		}
	}
	
}