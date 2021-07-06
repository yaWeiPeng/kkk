<?php
namespace app\admin\controller;

use app\admin\model\Novel as NovelModel;
//use app\admin\model\NovelCategory as NovelCategoryModel;
use app\admin\model\NovelContent as NovelContentModel;
use app\admin\model\NovelUrl as NovelUrlModel;

use app\admin\extra\novelapi;

class Novel extends Base
{
	
	public function getindex(){
		$this->assign([
			'data' => $this->searchData(),
			'search' => $this->searchKeys(),
		]);
		return view('/novel');
	}
	
	public function getedit(){
		if(input('id')){
			$data = model('user')->where('id',input('id'))->find();
			$category = model('novelcategory')->category('option',$data['pid']);
			$this->assign([
				'data' => $data,
			]);
		}else{
			$category = model('novelcategory')->category('option');
		}
		$this->assign([
			'category'=>$category,
			'url' => model('novelurl')->select(),
		]);
		return view('/novel_edit');
	}
	
	public function postdoedit(){
		$data = input('data');
		$url = model('novelurl')->where('id',$data['tagerurl'])->value('url');
		$tageturl = $url . $data['dirurl'];
		dump($tageturl);
		//$model = new NovelModel;
		//$data = $model->doadd($data);
		
		$novel = novelapi::pushnovel($url, $data['dirurl']);
		if($novel){
			return DatajsonSuccess('获取成功');
		}else{
			return DatajsonSuccess('获取失败');
		}
		if(isset($data['id'])){
			return (new UserModel)->doupdate($data);
		}else{
			return (new UserModel)->doadd($data);
		}
	}
	
	public function postorders(){
		$data = input('data');
		model('novel')->where('id',$data['id'])->update(['orders'=>$data['value']]);
		return DatajsonSuccess('修改成功');
	}
	
	public function postdel(){
		$id = input('id');
		if(empty($id)){
			return DatajsonError('未选中任何需要删除的内容');
		}
		$res = model('novel')->destroy($id);
		if($res){
			return DatajsonSuccess('删除成功');
		}else{
			return DatajsonError('删除失败');
		}
	}
	
	public function getUpdateNovel(){
	    $id = input('id');
	    $res = model('novel')->where('id',$id)->find();
	    if($res['novel_state']['state']==1){
            //$url = curl_link($res['target_url'].$res['last_url']);       //抓取地址
            echo $res['target_url'].$res['last_url'];exit;
            dd($res['target_url'].$res['last_url']);
            //匹配章
            $page = '/var prevpage="(.*?)"\s+var nextpage="(.*?)"/';
            preg_match_all($page, $url, $newpage);
            //下一章
            $nexpage = $newpage[2][0];
            $d = explode('/',$nexpage);
            dd($d);
            if($d[2] != ''){
                $v['last_url'] = $nexpage;
//                $this->laqu($v);
            }else{
                $msg = '一共'.$i++.'部小说更新了';
            }
            dd($res);
            ob_end_clean();
            ob_implicit_flush(1);
            for($i=0;$i<=5;$i++){
                echo str_repeat("<div></div>", 4096).'试测试测试测试测试测<br />';
                sleep(1);
            }
        }else{
	        echo '已经完结';
        }
	}
	
	public function index(){
		$model = new NovelModel;
		$cate = new NovelCategoryModel;
		$list = $model->getList($this->getData());
		$this->assign([
			'title' => '小说列表',                     // 页面标题
			'get' => $this->getData(),                     // 搜索关键字
			'cate' => $cate->getList([],'tree'),   		//获取全部分类
			'data' => $list,                     // 数据
			'count' => count($list),                     // 统计
		]);
		return view('/novel/list');
	}
	
	
	public function edit($id = ''){
		$model = new NovelModel;
		$data = $this->postData('data');
		if($id == 'add'){
		//增
			$NovelUrlModel = new NovelUrlModel;
			$list = $NovelUrlModel->getList($this->getData());
			$this->assign([
				'data' => $list,                     // 数据
			]);
			return view('/novel/url');
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
		}
	}
	
	//小说状态
	public function state(){
		$model = new NovelModel;
		return $model->state($_POST['id']);
	}
	
	//小说修改分类
	public function cate(){
		return (new NovelModel)->category($_POST);
	}
	
	//获取小说
	public function novel_edit($id = ''){
		$data = $this->postData('data');
		$NovelUrlModel = new NovelUrlModel;
		if($id == 'add'){
		//增
		}else if($id == 'doadd'){
			//增
			if(empty($data['cid'])){
				return DatajsonError('选择一个分类');
			}
			$NovelModel = new NovelModel;
			$NovelContentModel = new NovelContentModel;
			//目标url
			$target_url = ($NovelUrlModel->getOne($data['url_id']))['url'];
			//添加小说
			$novel = $NovelModel->doadd($target_url,$data['url']);
			if($novel){
				$res = $NovelContentModel->doadd(['url'=>$target_url,'nid'=>$novel['id'],'one'=>$novel['content']]);
				if($res){
					return DatajsonSuccess('成功获取');
				}else{
					return DatajsonError('失败');
				}
			}else{
				return DatajsonError('小说有问题');
			}
		}else{
			//查
			$list = $NovelUrlModel->getOne($id);
			$this->assign('list',$list);
		}
		$model = new NovelCategoryModel;
		$cate = $model->getList([],'tree');
		$this->assign([
			'category' => $cate,                     // 数据
		]);
		return view('/novel/novel_edit');
	}
	
}