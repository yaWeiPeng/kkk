<?php
namespace app\admin\controller;

use app\admin\model\Dynamic as DynamicModel;

class Dynamic extends Base
{
	public function index(){
		$model = new DynamicModel;
		$list = $model->getList($this->getData());
		$this->assign([
			'title' => '动态管理',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'data' => $list,                     // 数据
			'count' => count($list),                     // 统计
		]);
		return view('/dynamic/list');
	}
	
	
	public function edit($id = ''){
		$model = new DynamicModel;
		$data = $this->postData('data');
		if($id == 'add'){
		//增
		}else if($id == 'doadd'){
			if(isset($data['id'])){
			//改
				return $model->doupdate($data);
			}else{
			//增
				return $model->doadd($data);
			}
		}else if($id == 'del'){
			if(empty($_POST['id'])){
				return DatajsonError('未选中任何需要删除的内容');
			}
			//删
			if($model->destroy($_POST['id'])){
				return DatajsonSuccess('删除成功');
			}else{
				return DatajsonError('删除失败');
			}
		}else if($id == 'files'){
			//上传图片接口
			$data = uploads($_FILES['pic'],'/static/images/dynamic/admin/');
			return DatajsonSuccess('上传成功','',$data);
		}else{
			//查
			$list = $model->getOne($id);
			$this->assign('list',$list);
		}
		return view('/dynamic/edit');
	}
	
	//状态
	public function state(){
		$model = new DynamicModel;
		return $model->state($_POST['id']);
	}
	
}