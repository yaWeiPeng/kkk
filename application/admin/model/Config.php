<?php
namespace app\admin\model;

use app\common\model\Config as ConfigModel;

class Config extends ConfigModel
{
	
	//添加
	public function doadd($name , $config , $key){
		$data = ['name'=>$name,'config'=>$config,'key'=>$key,'update_time'=>time()];
		if($this->save($data)){
			return DatajsonSuccess('保存成功');
		}else{
			return DatajsonError('保存失败');
		}
		
	}
	
	//更新
	public function doupdate($id , $config , $key){
		if($this->update(['id' => $id, 'config' => $config,'key'=>$key,'update_time'=>time()])){
			return DatajsonSuccess('保存成功',$id,$config);
		}else{
			return DatajsonError('保存失败');
		}
		
	}
}