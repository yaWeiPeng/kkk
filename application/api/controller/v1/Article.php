<?php
namespace app\api\controller\v1;

use think\Controller;
use app\api\model\Article as ArticleModel;

class Article extends Base
{
	//获取文章(一条)
	public function getone(){
		if(empty($_POST['id']))return DatajsonError('无效参数');
		//类型
		$data = (new ArticleModel)->getOne($_POST['id']);
		return DatajsonSuccess('success','https://lilymin.com',$data);
	}
}


