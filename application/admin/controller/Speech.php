<?php
namespace app\admin\controller;

use app\admin\model\Config as ConfigModel;

class Speech extends Base
{
	public $name = '百度语音合成';
	public $key = 'speech';
	
	//接口配置
	public function config(){
		$model = new ConfigModel;
		$find = $model->getOne($this->key);
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$config = json_encode($_POST);
			if(empty($find)){
				$data = (new ConfigModel)->doadd($this->name , $config , $this->key);
			}else{
				$data = (new ConfigModel)->doupdate($find['id'] , $config , $this->key);
			}
			return $data;
		}
		if(!empty($find)){
			$config = json_decode($find['config']);
			$this->assign('config',$config->data);
		}
		$this->assign([
			'title' => '百度语音合成配置',                     // 页面标题
		]);
		return view('speech/config');
	}
	
}