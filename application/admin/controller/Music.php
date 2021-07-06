<?php
namespace app\admin\controller;

use app\admin\model\Music as MusicModel;
use app\admin\model\NovelCategory as NovelCategoryModel;
use app\admin\model\NovelContent as NovelContentModel;
use app\admin\model\NovelUrl as NovelUrlModel;

class Music extends Base
{
	public function index(){
		$model = new MusicModel;
		$cate = new NovelCategoryModel;
		$list = $model->getList($this->getData());
		$this->assign([
			'title' => '音乐列表',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'cate' => $cate->getList([],'tree'),   		//获取全部分类
			'data' => $list,                     // 数据
			'count' => count($list),                     // 统计
		]);
		return view('/music/list');
	}
	
	
	public function edit($id = ''){
		$model = new MusicModel;
		$data = $this->postData('data');
		if($id == 'add'){
			
		}else if($id == 'doadd'){
			if(isset($data['id'])){
			//改
			
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
			$NovelContentModel = new NovelContentModel;
			if($model->destroy($_POST['id']) && $NovelContentModel->destroy(['novel_id'=>$_POST['id']])){
				return DatajsonSuccess('删除成功');
			}else{
				return DatajsonError('删除失败');
			}
		}else{
			//查
			$list = $model->getOne($id);
			$this->assign('list',$list);
		}
		return view('/music/edit');
	}
	
	//小说状态
	public function state(){
		$model = new NovelModel;
		return $model->state($_POST['id']);
	}
	
	//小说修改分类
	public function cate(){
		return (new NovelModel)->category($_POST);
	}
	
	//获取小说
	public function novel_edit($id = ''){
		$data = $this->postData('data');
		$NovelUrlModel = new NovelUrlModel;
		if($id == 'add'){
		//增
		}else if($id == 'doadd'){
			//增
			if(empty($data['cid'])){
				return DatajsonError('选择一个分类');
			}
			$NovelModel = new NovelModel;
			$NovelContentModel = new NovelContentModel;
			//目标url
			$target_url = ($NovelUrlModel->getOne($data['url_id']))['url'];
			//添加小说
			$novel = $NovelModel->doadd($target_url,$data['url']);
			if($novel){
				$res = $NovelContentModel->doadd(['url'=>$target_url,'nid'=>$novel['id'],'one'=>$novel['content']]);
				if($res){
					return DatajsonSuccess('成功获取');
				}else{
					return DatajsonError('失败');
				}
			}else{
				return DatajsonError('小说有问题');
			}
		}else{
			//查
			$list = $NovelUrlModel->getOne($id);
			$this->assign('list',$list);
		}
		$model = new NovelCategoryModel;
		$cate = $model->getList([],'tree');
		$this->assign([
			'category' => $cate,                     // 数据
		]);
		return view('/novel/novel_edit');
	}
	
}