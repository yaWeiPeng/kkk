<?php
namespace app\common\library\ExpressBird;

use app\common\model\Config as ConfigModel;
use app\common\model\Logistics as LogisticsModel;
use app\common\model\LogisticsList as LogisticsListModel;

class Courier{
	
	//名称
	public $name = '快递鸟配置';
	//关键字
	public $key = 'courier';
	//会员id
	public $EBusinessID;
	//秘钥
	public $Appkey;
	//请求地址
	public $ReqURL;
	
	//读取物流配置
	public function __construct(){
		$model = new ConfigModel;
		$config = $model->getOne($this->key);
		$data = json_decode($config['config'],true);
		$this->EBusinessID = $data['data']['EBusinessID'];
		$this->Appkey = $data['data']['Appkey'];
		$this->ReqURL = $data['data']['ReqURL'];
	}
	
	public function getData($data , $save = true){
		//物流状态：2-在途中,3-签收,4-问题件
		if($data['logo'] == '' || $data['LogisticCode'] == ''){
			return DatajsonError('缺少必要参数');
		}
		$OrderCode = $data['OrderCode'];
		$ShipperCode = $data['logo'];
		$LogisticCode = $data['LogisticCode'];
		$uid = isset($data['uid'])?$data['uid']:'';
		
		$logisticResult = $this->orderTracesSubByJson($OrderCode , $ShipperCode , $LogisticCode);
		
		//快递路径
		$info = json_decode($logisticResult,true);
		
		$LogisticsList = new LogisticsListModel;
		//查询成功
		if($info['Success'] && $save == true){
			$list = $LogisticsList->getOne($LogisticCode);
			$res = ['uid' => $uid , 'logo' => $ShipperCode , 'OrderCode' => $OrderCode , 'LogisticCode' => $LogisticCode];
			if(empty($list)){
				$LogisticsList->save($res);
			}else{
				$res['id'] = $list['id'];
				$LogisticsList->update($res);
			}
		}
		
		if($info['State'] == 2){
			$info['State'] = '在途中';
		}else if($info['State'] == 3){
			$info['State'] = '签收';
		}else if($info['State'] == 4){
			$info['State'] = '问题件';
		}else if($info['State'] == 0){
			$info['State'] = '信息不符';
		}
		
		$Shippername = (new LogisticsModel)->where('logo',$info['ShipperCode'])->field('name')->find();
		$info['ShipperCode'] = $Shippername['name'];
		$logisticResult = json_encode($info);
		return $logisticResult;
	}
	
	 
	/**
	 * Json方式  物流信息订阅
	 */
	function orderTracesSubByJson($OrderCode , $ShipperCode , $LogisticCode){
		$requestData="{'OrderCode': '".$OrderCode."',".
				   "'ShipperCode':'".$ShipperCode."',".
				   "'LogisticCode':'".$LogisticCode."'}";
		
		$datas = array(
			'EBusinessID' => $this->EBusinessID,
			'RequestType' => '1002',
			'RequestData' => urlencode($requestData) ,
			'DataType' => '2',
		);
		$datas['DataSign'] = $this->encrypt($requestData, $this->Appkey);
		$result=$this->sendPost($this->ReqURL, $datas);	
		
		//根据公司业务处理返回的信息......
		
		return $result;
	}

	/**
	 *  post提交数据 
	 * @param  string $url 请求Url
	 * @param  array $datas 提交的数据 
	 * @return url响应返回的html
	 */
	function sendPost($url, $datas) {
		$temps = array();	
		foreach ($datas as $key => $value) {
			$temps[] = sprintf('%s=%s', $key, $value);		
		}	
		$post_data = implode('&', $temps);
		$url_info = parse_url($url);
		if(empty($url_info['port']))
		{
			$url_info['port']=80;	
		}
		$httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
		$httpheader.= "Host:" . $url_info['host'] . "\r\n";
		$httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
		$httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
		$httpheader.= "Connection:close\r\n\r\n";
		$httpheader.= $post_data;
		$fd = fsockopen($url_info['host'], $url_info['port']);
		fwrite($fd, $httpheader);
		$gets = "";
		$headerFlag = true;
		while (!feof($fd)) {
			if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
				break;
			}
		}
		while (!feof($fd)) {
			$gets.= fread($fd, 128);
		}
		fclose($fd);  
		
		return $gets;
	}

	/**
	 * 电商Sign签名生成
	 * @param data 内容   
	 * @param appkey Appkey
	 * @return DataSign签名
	 */
	function encrypt($data, $appkey) {
		return urlencode(base64_encode(md5($data.$appkey)));
	}
}