<?php
namespace app\admin\controller;

use app\admin\model\Article as ArticleModel;
use app\admin\model\ArticleType as ArticleTypeModel;

class Article extends Base
{
	//数据列表
	public function getindex(){
		$model = new ArticleModel;
		$ArticleTypemodel = new ArticleTypeModel;
		$list = $model->getList($this->getData());
		$type = $ArticleTypemodel->getList(['state'=>1]);
		$this->assign([
			'title' => '文章管理',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'data' => $list,                     // 数据
			'type' => $type,                     // 文章类型
			'count' => count($list),						//统计
		]);
		return view('/article/list');
	}
	
	//文章操作
	public function edit($id = ''){
		$model = new ArticleModel;
		$ArticleTypemodel = new ArticleTypeModel;
		$data = $this->postData('data');
		$type = $ArticleTypemodel->getList(['state'=>1]);
		$this->assign('type',$type);
		if($id == 'add'){
		//增
		}else if($id == 'doadd'){
			if(isset($data['id'])){
			//改
				$res = $model->doupdate($data);
				return $res;
			}else{
			//增
				$data = $model->doadd($data);
				return $data;
			}
		}else if($id == 'del'){
			if(empty($_POST['id'])){
				return DatajsonError('未选中任何需要删除的内容');
			}
			//删
			$data = $model->destroy($_POST['id']);
			if($data){
				return DatajsonSuccess('删除成功');
			}else{
				return DatajsonError('删除失败');
			}
		}else if($id == 'files'){
			//上传图片接口
			$data = uploads($_FILES['pic'],'/static/images/article/');
			return DatajsonSuccess('上传成功','',$data);
		}else{
			//查
			$list = $model->getOne($id);
			$this->assign('list',$list);
		}
		return view('/article/edit');
	}
	
	//文章状态
	public function state(){
		$model = new ArticleModel;
		return $model->state($_POST['id']);
	}
	
	//文章类型
	public function type(){
		$model = new ArticleTypeModel;
		$list = $model->getList($this->getData());		
		$this->assign([
			'title' => '文章类型',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'data' => $list,                     // 数据
			'count' => count($list),						//统计
		]);
		return view('/article/type');
	}
	
	//文章类型操作
	public function type_edit($id = ''){
		$model = new ArticleTypeModel;
		$data = $this->postData('data');
		if($id == 'add'){
		//增
		}else if($id == 'doadd'){
			if(isset($data['id'])){
			//改
				$res = $model->doupdate($data);
				return $res;
			}else{
			//增
				$res = $model->doadd($data);
				return $res;
			}
		}else if($id == 'del'){
			if(empty($_POST['id'])){
				return DatajsonError('未选中任何需要删除的内容');
			}
			//删
			$res = $model->destroy($_POST['id']);
			if($res){
				return DatajsonSuccess('删除成功');
			}else{
				return DatajsonError('删除失败');
			}
		}else{
			//查
			$list = $model->getOne($id);
			$this->assign('list',$list);
		}
		return view('/article/type_edit');
	}
	
	//文章类型状态
	public function type_state(){
		$model = new ArticleTypeModel;
		return $model->state($_POST['id']);
	}
	
}