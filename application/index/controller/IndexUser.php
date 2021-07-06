<?php
namespace app\index\controller;

use app\index\model\IndexUser as IndexUserModel;
use app\index\model\NovelHistory as NovelHistoryModel;

class IndexUser extends Base
{
	public function history(){
		
		$this->assign([
			'title' => '浏览记录',                     // 页面标题
			'data' => (new NovelHistoryModel)->history_lists($this->user_info()),                     // 页面数据
		]);
		return view('/User/history');
	}
}
