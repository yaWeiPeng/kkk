<?php
namespace app\admin\model;

use app\common\model\ImageCategory as ImageCategoryModel;

class ImageCategory extends ImageCategoryModel
{
	//获取列表
	public function getList(){
		return $this->select();
	}
	
	//获取单个
	public function getOne($id = 0){
		$list = $this->where('id',$id)
					->find();
		return $list;
	}
	
	//添加
	public function doadd($data){
		if($this->save($data)){
			return DatajsonSuccess('保存成功');
		}else{
			return DatajsonError('保存失败');
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
	
	//删除
	public function del($id){
		if(empty($id)){
			return Datejson(0,'未选中任何需要删除的内容');
		}
		if(is_array($id)){
			$ids = '';
			foreach($id as $v){
				if(!empty($this->isSon($v))){
					$ids .= $v.',';
				}
			}
			return DatajsonError('删除失败,以下id有子类无法删除'.$ids);
		}else{
			if(!empty($this->isSon($id))){
				return DatajsonError('删除失败,有子类无法删除');
			}
		}
		if($this->destroy($id)){
			return DatajsonSuccess('删除成功');
		}else{
			return DatajsonError('删除失败');
		}
	}
}