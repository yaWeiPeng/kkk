<?php
/**
set 全局设置
**/
namespace app\admin\controller;

use think\Db;
use think\Model;

class Set extends Base
{
	
    public function getindex()
    {
		$this->assign(['title'=>'全局设置']);
		return view('/set');
    }
	
	public function postedit(){
		$data = input('param.');
		$get_set = Db::name('set')->where('name',$data['name'])->find();
		if($get_set){
			Db::name('set')->where('name',$data['name'])->update(['value'=>$data['value']]);
		}else{
			Db::name('set')->insert(['name'=>$data['name'],'value'=>$data['value']]);
		}
		return DatajsonSuccess('修改成功');
	}
}