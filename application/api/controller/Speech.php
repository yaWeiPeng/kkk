<?php
namespace app\api\controller;

use think\Controller;
use app\common\model\Config as ConfigModel;
use app\common\library\Speech\AipSpeech;

class Speech extends Controller
{
	//名称
	public $name = '百度语音合成';
	//关键字
	public $key = 'speech';
	public $APP_ID;
	public $API_KEY;
	public $SECRET_KEY;
	public $spd;
	public $pit;
	public $vol;
	public $per;
	
	//读取配置
	public function __construct(){
		$model = new ConfigModel;
		$config = $model->getOne($this->key);
		$data = json_decode($config['config'],true);
		$this->APP_ID = $data['data']['APP_ID'];
		$this->API_KEY = $data['data']['API_KEY'];
		$this->SECRET_KEY = $data['data']['SECRET_KEY'];
		$this->spd = $data['data']['spd'];
		$this->pit = $data['data']['pit'];
		$this->vol = $data['data']['vol'];
		$this->per = $data['data']['per'];
	}
	
	//获取语音 
	//data =>中文字符串
	public function getSpeech(){
		$client = new AipSpeech($this->APP_ID, $this->API_KEY, $this->SECRET_KEY);
		$result = $client->synthesis($_GET['data'], 'zh', 1, array(
			'spd' => $this->spd,
			'pit' => $this->pit,
			'vol' => $this->vol,
			'per' => $this->per,
		));
		if(!is_array($result)){
			
			$dir = iconv("UTF-8", "GBK", $_SERVER['DOCUMENT_ROOT'].'/Speech/');
			if (!file_exists($dir)){
				mkdir ($dir,0777,true);
			}
			$path = $this->p_uploads($dir);
			//var_dump($path);exit;
			file_put_contents($path['save_path'], $result);
			return DatajsonSuccess('获取语音成功','','/Speech/'.$path['visit']);
			//echo $result."<br>";
			//echo '<audio src="'.$result.'" controls="controls" loop="loop"></audio>';
		}
	}
	
	//避免重复文件名
	public function p_uploads($dir){
		$filename = rand(10,99).time().'.mp3';
		$save_path = $dir.$filename;
		if(file_exists($save_path)){
			$this->p_uploads($dir);
		}
		return ['save_path'=>$save_path,'visit'=>$filename];
	}
	
}


