<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
error_reporting(E_ERROR | E_PARSE );

use think\Request;
use \Firebase\JWT\JWT;
use think\Db;


//api格式
function Datejson($code , $msg , $url = '' , $data=[]){
	return json_encode(['code'=>$code,'msg'=>$msg,'url'=>$url,'data'=>$data]);
}

//api格式成功
function DatajsonSuccess($msg='success' , $url = '' , $data=[]){
	return json_encode(['code'=>1,'msg'=>$msg,'url'=>$url,'data'=>$data]);
}

//api格式失败
function DatajsonError($msg='error' , $url = '' , $data=[]){
	return json_encode(['code'=>0,'msg'=>$msg,'url'=>$url,'data'=>$data]);
}

//加密方式
function caption_hash($password){
	return md5($password);
}

//生成token
function token($id){
	$key = "keweipeng";
	$token = array(
		"iss" => "http://lilymin.com",
		"iat" => time(),
		"exp" => time()+3600,
		"jti" => $id,
	);
	$jwt = JWT::encode($token, $key);
	return $jwt;
}
//解析token
function jietoken($token){
	$key = "keweipeng";
	$decoded = JWT::decode($token, $key, array('HS256'));
	return $decoded;
}

//上传图片 （直接调用 ） $file 文件名字 $dirname 存储路径
function uploads($file,$dirname){
	$exe = explode('.', $file['name']);
	$dir = iconv("UTF-8", "GBK", $_SERVER['DOCUMENT_ROOT'].$dirname);
	if (!file_exists($dir)){
		mkdir ($dir,0777,true);
	}
	$filename = rand(10,99).time().'.'.end($exe);
	$save_path = $dir.$filename;
	if(file_exists($save_path)){
		$save_path = p_uploads($dir,end($exe));
	}
	$res = move_uploaded_file($file["tmp_name"],$save_path);//将临时地址移动到指定地址 
	$path = $dirname.$filename;
	return $path;
}
//避免重复文件名
function p_uploads($dir,$exe){
	$save_path = $dir.rand(10,99).time().'.'.end($exe);
	if(file_exists($save_path)){
		uploads($dir,$exe);exit;
	}
	return $save_path;
}
//删除文件
function delfiles($data){
	$i = 0;
	$j = 0;
	$msg = '';
	$code = '';
	if(is_array($data)){
		foreach($data as $v){
			$path = $_SERVER['DOCUMENT_ROOT'].$v;
			if(file_exists($path) && $v!=''){
				unlink($path);
				++$i;
				$msg = $i.'删除成功'.$j.'文件不存在';
			}else{
				++$j;
				$msg = $i.'删除成功'.$j.'文件不存在';
			}
		}
		return DatajsonSuccess($msg);
	}else{
		$path = $_SERVER['DOCUMENT_ROOT'].$data;
		if(file_exists($path)){
			unlink($path);
			return DatajsonSuccess('删除成功');
		}else{
			return DatajsonError('文件不存在');
		}
	}
}

//curl
function curl_link($url){
	$curl = curl_init(); // 启动一个CURL会话
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION,1);
	$res = curl_exec($curl); //返回api的json对象
	curl_close($curl);
	return $res;
}

//全局设置
function globSet($name = ''){
	if($name){
		return Db::name('set')->where(['name'=>$name])->value('value');
	}else{
		$list = Db::name('set')->select();
		foreach($list as $v){
			$set[$v['name']] =$v['value'];
		}
		return $set;
	}
}
