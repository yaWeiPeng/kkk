<?php
namespace app\admin\controller;

class Novelcategory extends Base
{
	//列表页
	public function getindex(){
		$search = $this->searchKeys();
		if(!is_null($search) && $search!=null){
			$list = $this->searchData();
		}else{
			$list = model('novelcategory')->category('list',0);
		}
		$this->assign([
			'data' => $list,
			'search' => $search,
			]);
		return view('/novelcategory');
	}
	
	public function getedit(){
		$id = input('id');
		if($id){
			$data = model('novelcategory')->where(['id'=>$id])->find();
			$category = model('novelcategory')->category('option',$data['pid']);
			$this->assign([
				'data'=>$data,
			]);
		}else{
			$category = model('novelcategory')->category('option');
		}
		$this->assign([
			'category'=>$category,
		]);
		return view('/novelcategory_edit');
	}
	
	public function postdoedit(){
		$data = input('data');
		if(isset($data['id'])){
			model('novelcategory')->where(['id'=>$data['id']])->update($data);
			return DatajsonSuccess('修改成功','',[]);
		}else{
			model('novelcategory')->save($data);
			return DatajsonSuccess('保存成功','',[]);
		}
	}
	
	public function postdel(){
		$id = input('id');
		if(empty($id)){
			return DatajsonError('未选中任何需要删除的内容');
		}
		$res = model('novelcategory')->destroy($id);
		if($res){
			return DatajsonSuccess('删除成功');
		}else{
			return DatajsonError('删除失败');
		}
	}
	
	public function postorders(){
		$data = input('data');
		model('novelcategory')->where('id',$data['id'])->update(['orders'=>$data['value']]);
		return DatajsonSuccess('修改成功');
	}
}