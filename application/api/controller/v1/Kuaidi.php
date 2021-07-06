<?php
namespace app\api\controller\v1;

use app\api\model\Logistics as LogisticsModel;
use app\common\library\ExpressBird\Courier;

class Kuaidi extends Base
{
	
	//物流公司列表
	public function alist(){
		$LogisticsModel = new LogisticsModel;
		//类型
		$data = $LogisticsModel->getList();
		return DatajsonSuccess('success','',$data);
	}
	
	//小程序查询物流
	public function swuliu(){
		$this->islogin();
		$courier_select = new Courier;
		return $courier_select->getData($_POST);
	}
	
}


