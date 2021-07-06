<?php
namespace app\admin\controller;

use think\Controller;

use app\admin\controller\Login;			//登录控制器

use think\facade\Session;
use think\facade\Cache;
use think\Db;

class Base extends Controller
{
	
	//初始化
	public function initialize(){
		//header("Access-Control-Allow-Origin:*");	// 制定允许其他域名访问
		//header('Access-Control-Allow-Methods:*');	// 响应类型
		//header('Access-Control-Allow-Headers:*');	// 响应头设置
		
		$this->getRouteinfo();						//路由信息
		$this->user = Session::get('userInfo');		//登录信息
		$this->check_login();						//是否有登录
		$this->white_list();						//权限控制
		
		//$this->check_session();					//测试session 
	}
	
	//无需验证
	protected $allowAllAction = [
        'login/getlogin',							//登录页面
        'login/postlogin',							//登录操作
		'login/postoutlogin',						//退出操作
    ];
	
	//当前控制器名称
    protected $controller = '';

    //当前方法名称
    protected $action = '';
	
	//当前路由uri
    protected $routeUri = '';
	
	//用户信息
    protected $user;
	
	//登录状态
	public function check_login(){
		if (in_array($this->routeUri, $this->allowAllAction)) {
            return true;
        }
		if(!Session::has('userInfo')){
			$this->redirect('/login/login');
		}
	}
	
	//权限控制
	public function white_list(){
		if(!in_array($this->routeUri,$this->allowAllAction)){
			$this->assign([
				'userInfo' => $this->user,						// 登录信息
			]);
		}
		//过滤权限列表
		$permission = [
					'admin/index',
					'admin/welcome',
					'base/checktoken',
				];
		$permission = array_merge($this->allowAllAction,$permission);
		//超级管理员默认全部权限开放
		$user = $this->user;
		//查询访问权限
		if(!in_array($this->routeUri,$permission)){
			if($user['permissions_id'] != 5){
				$this->permission($user);
			}
		}
	}
	
	//检查访问权限
	public function permission($user){
		$userinfo = explode(',',$user['permissions']['quanxian']);
		$permission = [];
		foreach($userinfo as $id){
			$One = model('column')->where('id',$id)->field('controller')->find()->toArray();
			$permission[$id] = $One['controller'];
		}
		if(!in_array($this->controller,$permission)){
			if(request()->isAjax()){
				echo DatajsonError("没有权限访问！！！！");exit;
			}
			echo "没有权限访问！！！！";exit;
		}
	}
	
	//检查session
	private function checklogin(){
		if(Session::has('userInfo','backLogin') == NULL){
			//Session::set('userInfo','123','backLogin');
			//var_dump(Session::get('userInfo','backLogin'));
			//echo '未登录';exit;
            $this->redirect('/login');
            return false;
		}else{
			Session(null);
			echo '已登录';exit;
		}
	}
	
	//路由信息
	protected function getRouteinfo()
    {
        // 控制器名称
        $this->controller = strtolower($this->request->controller());
        // 方法名称
        $this->action = $this->request->action();
        // 控制器分组 (用于定义所属模块)
        //$groupstr = strstr($this->controller, '.', true);
        //$this->group = $groupstr !== false ? $groupstr : $this->controller;
        // 当前uri
        $this->routeUri = $this->controller . '/' . $this->action;
    }
    
	//多图
	public function delfiles(){
		return delfiles($_POST['data']);
	}
	
	/**
     * 获取post数据 (数组)
     * @param $key
     * @return mixed
     */
/**
 * s 强制转换为字符串类型
 * d 强制转换为整型类型
 * b 强制转换为布尔类型
 * a 强制转换为数组类型  -------------------------------------------- 解释
 * f 强制转换为浮点类型                                         |   |
 */															//	|	|
    protected function postData($key = null)				//	|	|
    {														//	|	|
        return $this->request->post(is_null($key) ? '' : $key . '/a');
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
	
	//切割图片json
	public function cutPic($str){
		$pic = explode(',',$str);
		array_shift($pic);
		return $pic;
	}
	
	/*
		模糊查询
		$with 连表
		$whereField 额外参数
	*/
	public function searchData($with='',$whereField=[]){
		$search = $this->searchKeys();
		$where = [];
		if(is_array($search)){
			//模糊查询
			if(isset($search['likes'])){
				foreach($search['likes'] as $k=>$v){
					if($v != '')$where[]=[$k,'like','%'.$v.'%'];
				}
			}
			//时间查询
			if(isset($search['time'])){
				$time = $search['time'];
				if($time['start'] != '' && $time['end'] != '')$where[] = ['create_time','between',[strtotime($time['start']),strtotime($time['end'])]];
				if($time['start'] != '' && $time['end'] == '')$where[] = ['create_time','egt',strtotime($time['start'])];
				if($time['start'] == '' && $time['end'] != '')$where[] = ['create_time','elt',strtotime($time['end'])];
			}
			//准确查询
			if(isset($search['selects'])){
				foreach($search['selects'] as $k=>$v){
					if($v != '')$where[]=[$k,'=',$v];
				}
			}
			//额外参数
			if(is_array($whereField)){
				foreach($whereField as $k=>$v){
					$where[] = [$k,'=',$v];
				}
			}
		}
		//dump($where);
		dump(model($this->controller)->where($where)->fetchSql()->select());
		return model($this->controller)->with($with)->where($where)->order('orders desc')->paginate(10, false, [
			'query' => ['search'=>$search,],
		]);
	}
	
	/*搜索关键词*/
	public function searchKeys(){
		$search = input('get.search');
		if(is_array($search)){
			foreach($search as $k=>$v){
				foreach($v as $key=>$val){
					if($val == ''){
						unset($search[$k][$key]);
					}
				}
				if(empty($search[$k])){
					unset($search[$k]);
				}
			}
		}
		return $search;
	}
}


