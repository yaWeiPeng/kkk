<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Novel as NovelModel;
use app\index\model\NovelContent as NovelContentModel;
use app\index\model\NovelHistory as NovelHistoryModel;
use think\facade\Cookie;

class Index extends Base
{
	public function index(){
	/* ob_start();
		for ($i=10; $i>2; $i--)
{
    echo $i.'<br />';
    ob_flush(); //此句不能少
    flush();
    sleep(1);
}
ob_end_flush(); */
		
		/* ob_end_flush();
		ob_implicit_flush(1);
		for($i=0;$i<=10;$i++){
			echo '测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试这是第'.$i.'<br />';
		sleep(1);
		} 
 exit; */
		$data = (new NovelModel)->getList();
		$this->assign([
			'title' => '小说主题',                     // 页面标题
			'novel' => $data,                     // 页面数据
		]);
		return view('/index');
	}
	
	public function chapter($id){
		$model = new NovelModel;
		$res = $model->getOne($id);
		if($res['state']['state'] != 1 || !$res){
			$this->assign('error_tips','暂时没有这个小说');
		}else{
			$data = (new NovelContentModel)->getList($id , true);
			$this->assign([
				'novel_info' => $res,                     // 小说信息
				'novel' => $data,                     // 小说章节
			]);
		}
		$this->assign('title','小说章节');
		return view('/chapter');
	}
	
    public function content($id,$nid)
    {
		if($id == 0){
			return DatajsonError('这是最后一章了');
		}
		$data = (new NovelContentModel)->getList($nid , false);
		foreach($data as $k=>$v){
			if($v['id'] == $id){
				$res = $v;
				$prev = $k-1<0?'':$data[$k-1];
				$next = $k+1>count($data)-1 || $k+1==count($data)?'':$data[$k+1];
			}
		}
		//添加浏览记录
		if(Cookie::has('user')){
			$res['uid'] = (Cookie::get("user"))['id'];
			(new NovelHistoryModel)->doadd($res);
		}
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
			$res['nid'] = $nid;
			$res['next'] = isset($next['id'])?$next['id']:'0';
			return DatajsonSuccess('下一章','',$res);
		}
		$this->assign([
			'nid' => $nid,                     // 当前选择书id
			'data' => $res,                     // 当前选择章节
			'prev' => $prev,                     // 当前选择章节的上一章
			'next' => $next,                     // 当前选择章节的下一章
			'title' => $res['title'],                     // 书名
		]);
        return view('/content');
    }
	
}
