<?php
namespace app\admin\controller;

use app\admin\model\Region as RegionModel;

class Region extends Base
{
	//城市列表
	public function list(){
		$model = new RegionModel();
		$list = $model->getList($this->getData() , 'all');
		if(\Request::instance()->isAjax()){
			return DatajsonSuccess('获取成功','',$list);
		}
		//echo '<pre>';var_dump($list);exit;
		$this->assign([
			'title' => '城市级联',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'data' => $list,                     // 数据
			'count' => count($list),						//统计
		]);
		return view('/region/region');
	}
	
}