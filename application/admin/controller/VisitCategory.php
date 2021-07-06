<?php
namespace app\admin\controller;

use app\admin\model\VisitCategory as VisitCategoryModel;

class VisitCategory extends Base
{
	public function list(){
		$model = new VisitCategoryModel;
		$list = $model->getList($this->getData());
		$this->assign([
			'title' => '访问分类',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'data' => $list,                     // 数据
			'count' => count($list),                     // 统计
		]);
		return view('/visitcategory/list');
	}
	
	
	public function edit($id = ''){
		$model = new VisitCategoryModel;
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
		return view('/visitcategory/edit');
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
	
	//小说分类状态
	public function state(){
		$model = new NovelCategoryModel;
		return $model->state($_POST['id']);
	}
	
	
}