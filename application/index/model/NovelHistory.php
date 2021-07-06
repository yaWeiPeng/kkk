<?php
namespace app\index\model;

use app\common\model\NovelHistory as NovelHistoryModel;

class NovelHistory extends NovelHistoryModel
{
	
	//添加历史记录
	public function doadd($data){
		//查找是否存在同一小说id
		$params = [
			'uid'=>$data['uid'],  //用户id
			'nid'=>$data['novel_id'],		//小说id
		];
		$list = $this->where($params)->find();
		$params['cid'] = $data['id'];				//章节id
		if(!empty($list)){
			$params['id'] = $list['id'];
			$this->update($params);
		}else{
			$this->save($params);
		}
		
	}
	
	//查询历史记录
	public function history_lists($userInfo){
		return $this->with(['novel','chapter'])->where('uid',$userInfo['user']['id'])->select();
	}
	
}