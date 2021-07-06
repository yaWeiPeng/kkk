<?php
namespace app\admin\controller;

class Column extends Base
{
	//列表页
	public function getindex(){
		$search = $this->searchKeys();
		if(!is_null($search) && $search!=null){
			$list = $this->searchData();
		}else{
			$list = model('column')->category('list',0);
		}
		$this->assign([
			'data' => $list,
			'search' => $search,
			]);
		return view('/top/column');
	}
	
	public function getedit(){
		$id = input('id');
		if($id){
			$data = model('column')->where(['id'=>$id])->find();
			$category = model('column')->category('option',$data['pid']);
			$this->assign([
				'data'=>$data,
			]);
		}else{
			$category = model('column')->category('option');
		}
		$this->assign([
			'category'=>$category,
		]);
		return view('/top/column_edit');
	}
	
	public function postdoedit(){
		$data = input('data');
		if(isset($data['id'])){
			model('column')->where(['id'=>$data['id']])->update($data);
			return DatajsonSuccess('修改成功','',[]);
		}else{
			model('column')->save($data);
			return DatajsonSuccess('保存成功','',[]);
		}
	}
	
	public function postdel(){
		$id = input('id');
		if(empty($id)){
			return DatajsonError('未选中任何需要删除的内容');
		}
		$res = model('column')->destroy($id);
		if($res){
			return DatajsonSuccess('删除成功');
		}else{
			return DatajsonError('删除失败');
		}
	}
	
	public function postorders(){
		$data = input('data');
		model('column')->where('id',$data['id'])->update(['orders'=>$data['value']]);
		return DatajsonSuccess('修改成功');
	}
}