<?php
namespace app\admin\model;

use app\common\model\LogisticsList as LogisticsListModel;

class LogisticsList extends LogisticsListModel
{
	
	//获取列表
	public function getList($search=[]){
		$logo = isset($search['logo'])?$search['logo']:'';
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
		return $this->Where($filter)
					->where('logo','like','%'.$logo.'%')
					->order('id asc')
					->paginate(30);
	}
	
	//单条数据
	public function getOne($id = 0){
		return $this->where('id',$id)->find();
	}
	
}