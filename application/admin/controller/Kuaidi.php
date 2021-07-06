<?php
namespace app\admin\controller;

use app\api\controller\v1\Kuaidi as apikuaidi;
use app\admin\model\Config as ConfigModel;
use app\admin\model\Logistics as LogisticsModel;
use app\admin\model\LogisticsList as LogisticsListModel;
use app\common\library\ExpressBird\Courier;

class Kuaidi extends Base
{
	
	public $name = '快递鸟配置';
	public $key = 'courier';
	
	//接口配置
	public function config(){
		$model = new ConfigModel;
		$find = $model->getOne($this->key);
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$config = json_encode($_POST);
			if(empty($find)){
				$data = $model->doadd($this->name , $config , $this->key);
			}else{
				$data = $model->doupdate($find['id'] , $config , $this->key);
			}
			return $data;
		}
		$config = json_decode($find['config']);
		$this->assign('config',$config->data);
		return view('kuaidi/config');
	}
	
	//支持查询的物流公司
	public function logistics(){
		$model = new LogisticsModel;
		$list = $model->getList($this->getData());
		$this->assign([
			'title' => '物流服务',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'data' => $list,                     // 数据
			'count' => count($list),                     // 统计
		]);
		return view('kuaidi/logistics');
	}
	
	//编辑物流
	public function edit($id = ''){
		$data = isset($_POST['data'])?$_POST['data']:'';
		$model = new LogisticsModel;
		if($id == 'add'){
		//增
		}else if($id == 'doadd'){
			if(isset($data['id'])){
			//改
				return $model->doupdate($data);
			}else{
			//增
				return $model->doadd($data);
			}
		}else if($id == 'del'){
			//删
			if(empty($_POST['id'])){
				return DatajsonError('未选中任何需要删除的内容');
			}
			$data = $model->destroy($_POST['id']);
			if($data){
				return DatajsonSuccess('删除成功');
			}else{
				return DatajsonError('删除失败');
			}
		}else{
			//查
			$list = $model->getOne($id);
			$this->assign('list',$list);
		}
		return view('/kuaidi/edit');
	}
	
	//修改状态
	public function state(){
		$model = new LogisticsModel;
		return $model->state($_POST['id']);
	}
	
	//用户查询记录
	public function clist(){
		$model = new LogisticsListModel;
		$list = $model->getList($this->getData());
		$this->assign([
			'title' => '查询记录',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'data' => $list,                     // 数据
			'count' => count($list),                     // 统计
			'logo' => (new LogisticsModel)->select(),   //服务商
		]);
		return view('kuaidi/list');
	}
	
	//用户查询记录详细
	public function clist_detailed($id = ''){
		$model = new LogisticsListModel;
		$list = $model->getOne($id);
		$courier_select = new Courier;
		$data = $courier_select->getData($list ,$save = false);		
		$json = json_decode($data,true);
		$this->assign('data',$json);
		return view('kuaidi/list_detailed');
	}
	
	//物流文档下载
	public function f(){
		$path = $_SERVER['DOCUMENT_ROOT'].'/static/files/2019快递鸟接口支持快递公司编码.xlsx';
		$name = '2019快递鸟接口支持快递公司编码.xlsx';
		if(!file_exists($path)){//判断文件是否存在
			echo "文件不存在"; //如果不存在
			exit(); //直接退出
		}
		//$path=iconv("utf-8","gb2312",$path);
		$file=fopen($path,"r");
		header("Content-Type: application/octet-stream");

		header("Accept-Ranges: bytes");
		
		header("Content-Length: ".filesize($path));

		header("Content-Disposition: attachment; filename=".$name);

		echo fread($file,filesize($path));

		fclose($file);
	}
	
}