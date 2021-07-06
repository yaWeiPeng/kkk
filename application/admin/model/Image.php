<?php
namespace app\admin\model;

use app\common\model\Image as ImageModel;

class Image extends ImageModel
{
	//获取列表
	public function getList(){
		return $this->select();
	}
	
	//获取单个
	public function getOne($cid = 0){
		$list = $this->where('cid',$cid)
					->find();
		return $list;
	}
	
	//添加
	public function doadd($data){
		if($data['cid'] == '-1'){
			$data['cid'] = 0;
		}
		if($this->save($data)){
			return DatajsonSuccess('上传成功');
		}else{
			return DatajsonError('上传失败');
		}
	}
	
	//更新
	public function doupdate($data){
		$params = [	
					'id'=>$data['id'],
					'name'=>isset($data['name'])?$data['name']:'',
				];
		if($this->update($params)){
			return DatajsonSuccess('修改成功');
		}else{
			return DatajsonError('修改失败');
		}
	}
	
	//查询分类下的图片
	public function cate($id){
		if($id == '-1'){
			$data = $this->select();
		}else{
			$data = $this->where('cid',$id)->select();
		}
		return DatajsonSuccess('获取成功','',$data);
	}
	
	//删除
	public function del($data){
		if(empty($data['id'])){
			return Datejson(0,'未选中任何需要删除的内容');
		}
		if($this->destroy($data['id'])){
			return DatajsonSuccess('删除成功');
		}else{
			return DatajsonError('删除失败');
		}
	}
}