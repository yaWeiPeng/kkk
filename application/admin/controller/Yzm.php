<?php
namespace app\admin\controller;

use app\admin\model\Config as ConfigModel;

class Yzm extends Base
{
	public $name = '手机短信配置';
	public $key = 'sms';
	
	//接口配置
	public function config(){
		$model = new ConfigModel;
		$find = $model->getOne($this->key);
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$config = json_encode($_POST);
			if(empty($find)){
				$data = model('ConfigModel')->doadd($this->name , $config , $this->key);
			}else{
				$data = model('ConfigModel')->doupdate($find['id'] , $config , $this->key);
			}
			return $data;
		}
		if(!empty($find)){
			$config = json_decode($find['config']);
			$this->assign('config',$config->data);
		}
		return view('yzm/config');
	}
	
}