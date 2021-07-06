<?php
namespace app\api\controller;

use think\Controller;
use app\common\model\Config as ConfigModel;

class QrCode extends Controller
{
	//名称
	public $name = '二维码';
	//关键字
	public $key = 'qrcode';
	public $errorCorrectionLevel;
	public $content;		//二维码内容 $GET{'content'}
	public $matrixPointSize;	//生成图片大小 $GET{'matrixPointSize'}
	public $margin;				
	public $logo_state;
	public $logo;
	
	public function __construct(){
		$model = new ConfigModel;
		$config = $model->getOne($this->key);
		$data = json_decode($config['config'],true);
		$this->errorCorrectionLevel = isset($_GET['data']['errorCorrectionLevel'])?$_GET['data']['errorCorrectionLevel']:$data['data']['errorCorrectionLevel'];
		$this->content = isset($_GET['data']['content'])?$_GET['data']['content']:$data['data']['content'];
		$this->matrixPointSize = isset($_GET['data']['matrixPointSize'])?$_GET['data']['matrixPointSize']:$data['data']['matrixPointSize'];
		$this->margin = isset($_GET['data']['margin'])?$_GET['data']['margin']:$data['data']['margin'];
		$this->logo_state = isset($_GET['data']['logo_state'])?$_GET['data']['logo_state']:$data['data']['logo_state'];
		$this->logo = isset($_GET['data']['logo'])?$_GET['data']['logo']:$data['data']['logo'];
	}
	//获取二维码
	public function getQrCode(){
		require_once '../application/common/library/qrcode/phpqrcode.php';
		$value = $this->content;				//二维码内容	//默认为L，这个参数可传递的值分别是L(QR_ECLEVEL_L，7%)、M(QR_ECLEVEL_M，15%)、Q(QR_ECLEVEL_Q，25%)、H(QR_ECLEVEL_H，30%)，这个参数控制二维码容错率，不同的参数表示二维码可被覆盖的区域百分比，也就是被覆盖的区域还能识别；
		$errorCorrectionLevel = $this->errorCorrectionLevel;  		//容错级别 
		$matrixPointSize = $this->matrixPointSize;				//生成图片大小
		if(!is_dir("QRcode")){
            // 创建文件加
            mkdir("QRcode");
        }
		$margin = 2;
		//生成二维码图片
		$filename = 'QRcode/'.rand(1,99).time().'.png';
		if(file_exists('./'.$filename)){
			$filename = 'QRcode/'.rand(1,99).time().'.png';
		}
		\QRcode::png($value , $filename , $errorCorrectionLevel , $matrixPointSize, $margin);
		
		//logo 图片
		$Qr = $filename;
		$logo = '.'.$this->logo;
		if (file_exists($logo) && $this->logo_state == 1) {
			$QR = imagecreatefromstring(file_get_contents($Qr));   		//目标图象连接资源。
			$logo = imagecreatefromstring(file_get_contents($logo));   	//源图象连接资源。
			$QR_width = imagesx($QR);			//二维码图片宽度   
			$QR_height = imagesy($QR);			//二维码图片高度   
			$logo_width = imagesx($logo);		//logo图片宽度   
			$logo_height = imagesy($logo);		//logo图片高度   
			$logo_qr_width = $QR_width / 4;   	//组合之后logo的宽度(占二维码的1/5)
			$scale = $logo_width/$logo_qr_width;   	//logo的宽度缩放比(本身宽度/组合后的宽度)
			$logo_qr_height = $logo_height/$scale;  //组合之后logo的高度
			$from_width = ($QR_width - $logo_qr_width) / 2;   //组合之后logo左上角所在坐标点
			
			//重新组合图片并调整大小
			/*
			 *	imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中
			 */
			imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height);
			imagepng ( $QR, $filename );//带Logo二维码的文件名
		}
		return DatajsonSuccess('success','https://lilymin.com','/'.$filename);
	}
}


