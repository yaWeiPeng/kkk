<?php
namespace app\api\model;

use app\common\model\Idea as IdeaModel;

class Idea extends IdeaModel
{
	
	//添加
	public function doadd($data){
		if($this->allowField(true)->save($data)){
			return DatajsonSuccess('我们已经收到反馈！');
		}else{
			return DatajsonError('你的反馈太烂了');
		}
	}
	
}