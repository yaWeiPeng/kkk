<?php
namespace app\admin\controller;

use app\admin\model\ImageCategory as ImageCategoryModel;

class ImageCategory extends Base
{
	public function edit($id = ''){
		$model = new ImageCategoryModel;
		$data = $this->postData('data');
		if($id == 'add'){
		//增
		}else if($id == 'doadd'){
			if(isset($data['id'])){
			//改
				return $model->doupdate($data);
			}else{
			//增
				$data = $model->doadd($data);
				return $data;
			}
		}else if($id == 'del'){
			//删
			if(empty($_POST['id'])){
				return Datejson(0,'未选中任何需要删除的内容');
			}
			return $model->del($_POST['id']);
		}else{
			//查
			$list = $model->getOne($id);
			$this->assign('list',$list);
		}
		return view('/image/cate_add');
	}
	
	//更新分类
	public function update($id = ''){
		//查
		$model = new NovelCategoryModel;
		$list = $model->getOne($id);
		//树形分类
		$category = $model->getList($this->getData(),'tree');
		$this->assign([
			'category' => $category,                     // 分类
			'list' => $list,                     // 修改的id
		]);
		return view('/novelcategory/edit');
	}
}