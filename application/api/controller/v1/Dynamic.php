<?php
namespace app\api\controller\v1;

use think\Db;
use app\api\model\Dynamic as DynamicModel;
use app\api\model\DynamicLike as DynamicLikeModel;

class Dynamic extends Base
{
	public function alist(){
		$model = new DynamicModel;
		$data = $model->getList();
		return DatajsonSuccess('success','https://lilymin.com',$data);
	}
	
	public function edit($id = ''){
		if($id == 'doadd'){
			if($_FILES){
				$data = uploads($_FILES['pic'],'/static/images/dynamic/'.$_POST['uid'].'/');
				return Datejson(1,'success','',$data);
			}
			$data = model('DynamicModel')->doadd($this->res);
			return $data;
		}else if($id == 'del'){
			if(empty($_POST['id'])){
				return Datejson(0,'未选中任何需要删除的内容');
			}
			//删
			//$data = model('PermissionsModel')->where($_POST)->select();
			//foreach($data as $id=>$level){
			//	if($level['level'] == 1){
			//		$d1[] = $level;
			//		unset($data[$id]);
			//	}
			//}
			$data = model('PermissionsModel')->destroy($_POST['id']);
			if($data){
				return Datejson(1,'删除成功');
			}else{
				return Datejson(0,'删除失败');
			}
		}else{
			//查
			$list = model('PermissionsModel')->field('id,name,level')->find(['id'=>$id]);
			$this->assign('list',$list);
		}
	}
	
	public function dianzan(){
		$this->islogin();
		$model = new DynamicModel;
		//$DynamicLikeModel = new DynamicLikeModel;
		if($_POST['state'] == 1){
			$model->where('id',$_POST['dynamic_id'])->setInc('dianzan');
			$state = 1;
		}else{
			$model->where('id',$_POST['dynamic_id'])->setDec('dianzan');
			$state = 0;
		}
		$data = DynamicLikeModel::where('dynamic_id',$_POST['dynamic_id'])->find();
		$save_data = ['dynamic_id'=>$_POST['dynamic_id'],'uid'=>$_POST['uid'],'state'=>$state];
		if($data){
			$save_data['id'] = $data['id'];
			DynamicLikeModel::update($save_data);
		}else{
			DynamicLikeModel::save($save_data);
		}
		return DatajsonSuccess('success','',$save_data);
	}
	public function pinglun(){
		
	}
	
}


