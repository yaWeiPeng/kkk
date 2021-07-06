<?php
namespace app\admin\model;

use app\common\model\Novel as NovelModel;
use app\admin\model\NovelCategory as NovelCategoryModel;

class Novel extends NovelModel
{
	//获取列表
	public function getList($search=[]){
		$title = isset($search['title'])?$search['title']:'';
		$start = isset($search['start'])?$search['start']:'';
		$end = isset($search['end'])?$search['end']:'';
		$filter = [];
		if($start === '' && $end != ''){
			$filter[] = ['update_time','<',strtotime($end)];
		}else if($start != '' && $end === ''){
			$filter[] = ['update_time','>',strtotime($start)];
		}else if($start != '' && $end != ''){
			$filter[] = ['update_time','between',[strtotime($start),strtotime($end)]];
		}
		
		return $this->where($filter)
					->where('title','like','%'.$title.'%')
					->paginate(3);
	}
	
	//获取单个
	public function getOne($id = 0){
		$list = $this->where('id',$id)
					->find();
		return $list;
	}
	
	//修改状态
	public function state($id){
		$data = $this->getOne($id);
		if($this->update(['id'=>$id,'state'=>$data['state']['state']==1?0:1])){
			return DatajsonSuccess('修改成功');			
		}else{
			return DatajsonError('修改失败','',$data);			
		}
	}
	
	//修改分类
	public function category($data){
		if($this->update(['id'=>$data['id'],'cid'=>$data['cid']])){
			$catename = (new NovelCategoryModel)->getOne($data['cid']);
			return DatajsonSuccess('修改成功','',$catename['name']);			
		}else{
			return DatajsonError('修改失败','',$data);			
		}
	}
	
	//添加
	public function doadd($url , $apiurl = ''){
		if(empty($apiurl)){
			return false;
		}else{
			$res = curl_link($url.$apiurl);
			//匹配标题
			$info = '/<div id="info">\s+\n+\s+<h1>(.*?)<\/h1>\s+\n+\s+<p>(.*?)<\/p>\s+\n+\s+<p>(.*?)<\/p>/';
			preg_match_all($info, $res, $newinfo);
			//匹配第一章
			$one = '/<dd><a href="(.*?)">/';
			preg_match_all($one, $res, $content);
			//小说更新状态
			$a = explode(',',$newinfo[3][0]);
			$b = explode('：',$a[0]);
			if($b[1] == '连载中'){
				$state = 1;
			}else{
				$state = 0;
			}
			if(empty($newinfo[1][0])){
				return false;
			}else{
				$this->save(['title'=>$newinfo[1][0],'target_url'=>$url,'novel_state'=>$state]);
				$res = ['id'=>$this->id,'content'=>$content[1][0]];
				return $res;
			}
		}		
	}
	
}