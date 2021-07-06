<?php
namespace app\api\model;

use app\common\model\Wuser as WuserModel;

class Wuser extends WuserModel
{
	
	//微信登录
	public function user($res){
		$res = json_decode($res,true);
		$d1 = $this->where('openId',$res['openId'])->find();
		$data['avatarUrl'] = isset($res['avatarUrl'])?$res['avatarUrl']:'';
		$data['openId'] = isset($res['openId'])?$res['openId']:'';
		$data['nickName'] = isset($res['nickName'])?$res['nickName']:'';
		$data['gender'] = isset($res['gender'])?$res['gender']:'';
		$data['avatarUrl'] = isset($res['avatarUrl'])?$res['avatarUrl']:'';
		if(empty($d1)){
			if($this->save($data)){
				return DatajsonSuccess('登录成功','',$data);
			}else{
				return DatajsonError('登录失败');
			}
		}else{
			$data['id'] = $d1['id'];
			if($this->update($data)){
				return DatajsonSuccess('数据更新成功','',$data);
			}else{
				return DatajsonError('数据更新失败');
			}
		}
		
	}
	
}