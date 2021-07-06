<?php
namespace app\admin\controller;

use app\admin\model\Wuser as WuserModel;

class Wuser extends Base
{
	public function index(){
		$model = new WuserModel();
		$list = $model->getList($this->getData());
		$this->assign([
			'title' => '会员管理',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'data' => $list,                     // 数据
			'count' => count($list),						//统计
		]);
		return view('/wuser/list');
	}
	
}