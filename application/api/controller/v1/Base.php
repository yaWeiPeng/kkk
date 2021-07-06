<?php
namespace app\api\controller\v1;

use think\Controller;

class Base extends Controller
{
	
	protected $redis;
	public function __construct(){
		
		//redis
		//$this->redis = new \Redis();
        //$this->redis->connect("127.0.0.1",6379); 
        //$this->redis->auth('keweipeng');
		//调用库
		//$this->redis->select(1);
		//方法
        //$this->redis->lpush('list2',99);
	}
	
	//检测接口登录
	public function islogin(){
		if(empty($_POST['uid'])){
			return DatajsonError('先登录吧，谢谢合作！');
		}
	}
	
	 protected function postData($key = null)			
    {											
        return $this->request->post(is_null($key) ? '' : $key);
    }

    /**
     * 获取get数据 (数组)
     * @param $key
     * @return mixed
     */
    protected function getData($key = null)
    {
        return $this->request->get(is_null($key) ? '' : $key);
    }
}


