<?php
namespace app\admin\controller;

use Db;
use think\facade\Config;


use think\facade\Session;

class Admin extends Base
{
    public function index()
    {
		return $this->fetch('/index');
    }

	public function welcome()
    {
		$mysql_version = Db::query('select VERSION() as sqlversion');
		$_SERVER['MYSQL_VERSION'] = $mysql_version[0]['sqlversion'];
		$_SERVER['PHP_VERSION'] = PHP_VERSION;		//php版本
		$_SERVER['PHP_OS'] = PHP_OS;			//操作系统
		$_SERVER['APP_VERSION'] = Config::get('app_version');		//app版本
		$this->assign('server',$_SERVER);
        return $this->fetch('/welcome');
    }
	
	public function welcome1()
    {
        return $this->fetch('/welcome1');
    }
	public function member_list()
    {
        return $this->fetch('/member-list');
    }
	public function member_list1()
    {
        return $this->fetch('/member-list1');
    }
	public function member_del()
    {
        return $this->fetch('/member-del');
    }
	public function order_list()
    {
        return $this->fetch('/order-list');
    }
	public function order_list1()
    {
        return $this->fetch('/order-list1');
    }
	public function cate()
    {
        return $this->fetch('/cate');
    }
	public function city()
    {
        return $this->fetch('/city');
    }
	public function admin_list()
    {
        return $this->fetch('/admin-list');
    }
	public function admin_role()
    {
        return $this->fetch('/admin-role');
    }
	public function admin_cate()
    {
        return $this->fetch('/admin-cate');
    }
	public function admin_rule()
    {
        return $this->fetch('/admin-rule');
    }
	public function echarts1()
    {
        return $this->fetch('/echarts1');
    }
	public function echarts2()
    {
        return $this->fetch('/echarts2');
    }
	public function echarts3()
    {
        return $this->fetch('/echarts3');
    }
	public function echarts4()
    {
        return $this->fetch('/echarts4');
    }
	public function echarts5()
    {
        return $this->fetch('/echarts5');
    }
	public function echarts6()
    {
        return $this->fetch('/echarts6');
    }
	public function echarts7()
    {
        return $this->fetch('/echarts7');
    }
	public function echarts8()
    {
        return $this->fetch('/echarts8');
    }
	public function unicode()
    {
        return $this->fetch('/unicode');
    }
	public function login()
    {
        return $this->fetch('/login');
    }
	public function error1()
    {
        return $this->fetch('/error');
    }
	public function demo()
    {
        return $this->fetch('/demo');
    }
	public function log()
    {
        return $this->fetch('/log');
    }
	
}