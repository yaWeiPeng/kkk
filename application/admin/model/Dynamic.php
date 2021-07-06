<?php
namespace app\admin\model;

use app\common\model\Dynamic as DynamicModel;

class Dynamic extends DynamicModel
{
	//获取列表
	public function getList($search=[]){
		$start = isset($search['start'])?$search['start']:'';
		$end = isset($search['end'])?$search['end']:'';
		$filter = [];
		if($start === '' && $end != ''){
			$filter[] = ['create_time','<',strtotime($end)];
		}else if($start != '' && $end === ''){
			$filter[] = ['create_time','>',strtotime($start)];
		}else if($start != '' && $end != ''){
			$filter[] = ['create_time','between',[strtotime($start),strtotime($end)]];
		}
		return $this->with('user')
					->where($filter)
					->paginate(30);
	}
	
	//获取单个
	public function getOne($id = 0){
		$list = $this->with('user')
					->where('id',$id)
					->field('id,uid,content,state,dianzan,pinglun,pic')
					->find();
		return $list;
	}
	
	//修改状态
	public function state($id){
		$data = $this->getOne($id);
		if($this->where('id',$id)->update(['state'=>$data['state']['state']==1?0:1])){
			return DatajsonSuccess('修改成功');			
		}else{
			return DatajsonError('修改失败','',$data);			
		}
	}
	
}