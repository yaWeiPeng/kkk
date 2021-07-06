<?php
namespace app\api\controller\v1;

use think\Controller;
use app\common\wechatlogin\WXBizDataCrypt;
use app\api\model\Wuser as WuserModel;

class Login extends Controller
{
	public function index(){
		//gender  性别 0：未知、1：男、2：女
		$appid = 'wxd01bd7ab37537c33';
		$secret = '95046bc05dc8de32377323f2049c4bcc';
		$js_code = $_GET['code'];
		$grant_type = 'authorization_code';
		$url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$secret.'&js_code='.$js_code.'&grant_type='.$grant_type;
		$data = json_decode(curl_link($url));
		//openid
		$openid = $data->openid;
		//
		$session_key = $data->session_key;
		//签名
		$signature = $_GET['signature'];
		//加密
		$signature2 = sha1( $_GET['rawData'].$session_key);
		if($signature != $signature2){
			return DatajsonError('数据签名失败！');
		}
		//
		$iv = $_GET['iv'];
		//
		$encryptedData = $_GET['encryptedData'];
		
		$pc = new WXBizDataCrypt($appid, $session_key);
		$errCode = $pc->decryptData($encryptedData, $iv, $data1 );
		
		$model = new WuserModel;
		$res = $model->user($data1);

		return $res;
	}
}


