<?php
namespace app\api\model;

use app\common\model\Dynamic as DynamicModel;

class Dynamic extends DynamicModel
{
	//获取列表
	public function getList(){
		return $this->with(['dynamiclike','user'])
					->where('state','1')
					->order('create_time', 'desc')
					->select();
	}
	
	//添加
	public function doadd($data){
		$pic = substr($data['pic'], 1);
		$params = [	
					'uid'=>isset($data['uid'])?isset($data['uid']):'0',   //发布人
					'content'=>isset($data['content'])?$data['content']:'',
					'state'=>isset($data['state'])?$data['state']:'1',
					'dianzan'=>isset($data['dianzan'])?$data['dianzan']:'',
					'pinglun'=>isset($data['pinglun'])?$data['pinglun']:'',
					'pic'=>isset($pic)?$pic:'',
				];
		if(empty($params['pic']) && empty($params['content'])){
			return DatajsonError('添加图片或者一些文字吧，太难了');
		}
		if($this->save($params)){
			return DatajsonSuccess('发布动态成功','',$params);
		}else{
			return DatajsonError('发布动态失败');
		}
		
	}
	
	//更新
	public function doupdate($data){
		if(!empty($data['delpic'])){
			//foreach($data['delpic'] as $v){
				delfiles($data['delpic']);
			//}
		}
		$pic = substr($data['pic'], 1);
		$params = [	
					'id'=>$data['id'],
					'content'=>isset($data['content'])?$data['content']:'',
					'state'=>isset($data['state'])?$data['state']:'1',
					'dianzan'=>isset($data['dianzan'])?$data['dianzan']:'',
					'pinglun'=>isset($data['pinglun'])?$data['pinglun']:'',
					'pic'=>isset($pic)?$pic:'',
				];
		if(empty($params['pic']) && empty($params['content'])){
			return DatajsonError('添加图片或者一些文字吧，太难了');
		}
		if($this->update($params)){
			return DatajsonSuccess('修改成功');
		}else{
			return DatajsonError('修改失败');
		}
		
	}
	
}