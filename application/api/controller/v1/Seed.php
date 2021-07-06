<?php
namespace app\api\controller\v1;

use think\Controller;
use app\common\yzm;

class Seed extends Controller
{
	//读取短信配置
	public function __construct(){
		$config = model('ConfigModel')->where('name','手机短信配置')->field('config')->find();
		$data = json_decode($config['config'],true);
		$this->AccountSid = $data['data']['AccountSid'];
		$this->AuthToken = $data['data']['AuthToken'];
		$this->templateid = $data['data']['templateid'];
		$this->param = $data['data']['param'];
	}
	
	public $AccountSid;
	public $AuthToken;
	public $templateid;
	public $param;
	
	//手机短信验证码发送
	public function message(){
		$message = new yzm();
		return Datejson(1,'success','https://lilymin.com',$message->message($this->AccountSid));
	}
}


