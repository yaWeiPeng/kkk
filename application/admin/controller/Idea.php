<?php
namespace app\admin\controller;

use app\admin\model\Idea as IdeaModel;

class Idea extends Base
{
	
	//列表
	public function index(){
		$model = new IdeaModel;
		$list = $model->getList($this->getData());		
		$this->assign([
			'title' => '意见反馈',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'data' => $list,                     // 数据
			'count' => count($list),						//统计
		]);
		return view('/wuser/idea');
	}
	
	
	public function edit($id = ''){
		$model = new IdeaModel;
		$data = $this->postData('data');
		if($id == 'doadd'){
			if(isset($data['id'])){
			//回复(未写)
				
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
		}else{
			//查
			$list = $model->getOne($id);
			$this->assign('list',$list);
		}
		return view('/wuser/idea_edit');
	}
	
	
	
}