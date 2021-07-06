<?php
namespace app\admin\controller;

use app\admin\model\Image as ImageModel;
use app\admin\model\ImageCategory as ImageCategoryModel;

class Image extends Base
{
//	public function getindex(){
//		$model = new ImageModel;
//		$list = $model->getList($this->getData());
//		$this->assign([
//			'title' => '图片管理',                     // 页面标题
//			'get' => $this->getData(),                     // 搜索关键字
//			'cate' => (new ImageCategoryModel)->getList(),   		//获取全部分类
//			'data' => $list,                     // 数据
//			'count' => count($list),                     // 统计
//		]);
//		return view('/image/list');
//	}

    public function getindex(){
        $this->assign([
            'data' => $this->searchData(),
            'search' => $this->searchKeys(),
        ]);
        return view('/image');
    }

    public function postorders(){
        $data = input('data');
        model('image')->where('id',$data['id'])->update(['orders'=>$data['value']]);
        return DatajsonSuccess('修改成功');
    }
	
	public function imagesUploads(){
		$dirname = '/Image/';
		$file = $_FILES['pic'];
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
		
		//存数据库
		$image_data = ['size'=>$file['size'],'name'=>$filename,'path'=>$path,'cid'=>$this->postData()['id']];
		
		return (new ImageModel)->doadd($image_data);
	}
	
	//避免重复文件名
	public function p_uploads($dir,$exe){
		$save_path = $dir.rand(10,99).time().'.'.end($exe);
		if(file_exists($save_path)){
			$this->p_uploads($dir,$exe);exit;
		}
		return $save_path;
	}
	
	//删除
	public function del(){
		return (new ImageModel)->del($this->postData());
	}
	
	public function edit($id = ''){
		$model = new ImageModel;
		$data = $this->postData('data');
		if($id == 'add'){
			
		}else if($id == 'doadd'){
			if(isset($data['id'])){
			//改
			
			}else{
			//增
				$data = $model->doadd($data);
				return $data;
			}
		}else if($id == 'del'){
			//删
			if(empty($_POST['id'])){
				return Datejson(0,'未选中任何需要删除的内容');
			}
			$NovelContentModel = new NovelContentModel;
			if($model->destroy($_POST['id']) && $NovelContentModel->destroy(['novel_id'=>$_POST['id']])){
				return DatajsonSuccess('删除成功');
			}else{
				return DatajsonError('删除失败');
			}
		}else{
			//查
			$list = $model->getOne($id);
			return DatajsonSuccess('删除成功','',$list);
			$this->assign('list',$list);
		}
		return view('/music/edit');
	}
	
	public function imageCate(){
		return (new ImageModel)->cate($this->postData()['id']);
	}
	
	
}