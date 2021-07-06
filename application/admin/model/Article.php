<?php
namespace app\admin\model;

use app\common\model\Article as ArticleModel;

class Article extends ArticleModel
{
	//获取列表
	public function getList($search=[]){
		$title = isset($search['title'])?$search['title']:'';
		$tid = isset($search['tid'])?$search['tid']:'';
		return $this->with('type')
					->where('title','like','%'.$title.'%')
					->where('tid','like','%'.$tid.'%')
					->paginate(30);
	}
	
	//获取单个
	public function getOne($id = 0){
		$list = $this->where('id',$id)
					->field('id,title,state,tid,pic,content')
					->find();
		return $list;
	}
	
	//添加
	public function doadd($data){
		$validate = validate('ArticleVal');
		if(!$validate->scene('add')->check($data)){
           return DatajsonError($validate->getError());
        }
		if($this->save($data)){
			return DatajsonSuccess('保存成功');
		}else{
			return DatajsonError('保存失败');
		}
		
	}
	
	//更新
	public function doupdate($data){
		//删除图片
		if(isset($data['delpic'])){
			foreach($data['delpic'] as $v){
				delfiles($v);
			}
		}
		$params = [	
					'id'=>$data['id'],
					'title'=>isset($data['title'])?$data['title']:'',
					'content'=>isset($data['content'])?$data['content']:'',
					'state'=>isset($data['state'])?$data['state']:'',
					'tid'=>isset($data['tid'])?$data['tid']:'',
					'pic'=>isset($data['pic'])?$data['pic']:'',
				];
		if($this->update($params)){
			return DatajsonSuccess('修改成功');
		}else{
			return DatajsonError('修改失败');
		}
	}
	
	//修改状态
	public function state($id){
		$data = $this->getOne($id);
		if($data['state']['state'] == 1){
			$params = ['id'=>$id,'state'=>0];
		}else{
			$params = ['id'=>$id,'state'=>1];
		}
		if($this->update($params)){
			return DatajsonSuccess('修改成功');			
		}else{
			return DatajsonError('修改失败','',$data);			
		}
	}
	
}