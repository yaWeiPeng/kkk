<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Dynamic extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	protected $table = 'k_dynamic';
	protected $pk = 'id';
	
	//获取器修改状态
	public function getStateAttr($value){
		$state = [0=>'隐藏',1=>'显示'];
		return ['state'=>$value,'text'=>$state[$value]];
	}
	
	//修改图片
	public function getPicAttr($value){
		if($value != ''){
			$pic = explode(',',$value);
			return $pic;
		}else{
			return $value;
		}
	}
	
	//用户关联
	public function user(){
		return $this->belongsTo('Wuser','uid','id')->bind(['name'=>'nickName','avatarUrl'=>'avatarUrl']);
	}
	
	//点赞关联
	public function dynamiclike(){
		if($this->belongsTo('DynamicLike','id','dynamic_id')->bind(['dianzanstate'=>'state']) != null){
			return $this->belongsTo('DynamicLike','id','dynamic_id')->bind(['dianzanstate'=>'state']);
		}
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