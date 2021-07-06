<?php
namespace app\api\controller\v1;

use think\Controller;
use app\api\model\Idea as IdeaModel;

class Index extends Base
{
	//提交意见
	public function idea(){
		return (new IdeaModel)->doadd($_POST);
	}
	
}


