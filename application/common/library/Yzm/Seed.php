<?php
namespace app\common\library\Yzm;

use app\common\library\Yzm\Ucpaas;
use app\common\model\Config as ConfigModel;
use think\facade\Cache;

class Seed{
	
	//名称
	public $name = '手机短信配置';
	//关键字
	public $key = 'sms';
	//
	public $AccountSid;
	//
	public $AuthToken;
	//
	public $appid;
	//
	public $templateid;
	//
	public $param;
	
	//读取短信配置
	public function __construct(){
		$model = new ConfigModel;
		$config = $model->getOne($this->key);
		$data = json_decode($config['config'],true);
		$this->AccountSid = $data['data']['AccountSid'];
		$this->AuthToken = $data['data']['AuthToken'];
		$this->appid = $data['data']['appid'];
		$this->templateid = $data['data']['templateid'];
		$this->param = $data['data']['param'];
	}
	
	//发送短信
	public function message($phone){
		//初始化必填
		//填写在开发者控制台首页上的Account Sid
		$options['accountsid'] = $this->AccountSid;
		//填写在开发者控制台首页上的Auth Token
		$options['token'] = $this->AuthToken;

		//初始化 $options必填
		$ucpass = new Ucpaas($options);
		$appid = $this->appid;    //应用的ID，可在开发者控制台内的短信产品下查看
		$templateid = $this->templateid;    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
		
		$num = explode(',',$this->param);
		$param = rand($num[0],$num[1]); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
		$data = ['yzm'=>$param,'time'=>time()];
		//Session::set($phone['phone'],$data);
		Cache::set($phone['phone'],$data,120);
		$mobile = $phone['phone'];
		$uid = "";

		//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

		echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);   
	}
}