<?php
namespace app\admin\controller;

use app\admin\extra\tableField;

class Caption extends Base
{
    public function getindex(){
		$this->assign([
			'data' => $this->searchData(),
			'search' => $this->searchKeys(),
			]);
		return view('/top/database');
    }
	
	public function getedit(){
		$id = input('id');
		if($id){
			$data = model($this->controller)->where(['id'=>$id])->find();
			$data['field_id'] = explode(',',$data['field_id']);
			$field = model('field')->where(['caption_id'=>$id,'isread'=>'1'])->select();
			$this->assign(['data'=>$data,'field'=>$field]);
		}
		return view('/top/database_edit');
	}
	
	public function postdoedit(){
		$data = input('data');
		$check = isset($data['check']) ? $data['check'] : '1';
		if(isset($data['check']))unset($data['check']);
		if(isset($data['id'])){
			if(isset($data['field_id'])){
				$data['field_id'] = implode(',',$data['field_id']);
			}
			model($this->controller)->allowField(true)->isUpdate(true,['id'=>$data['id']])->save($data);
			return DatajsonSuccess('修改成功','',[]);
		}else{
			if($check==1){
				$validate = validate('AllVal');
				if(!$validate->scene('TableAdd')->batch()->check($data)){
					return DatajsonError('不符合规范','',$validate->getError());
				}
				if(!tableField::createTable($data['model'])){
					return DatajsonError('创建失败');
				}
			}
			model($this->controller)->save($data);
			return DatajsonSuccess('创建数据表成功','',[]);
		}
	}
	
	public function postdel(){
		$id = input('id');
		if(empty($id)){
			return DatajsonError('未选中任何需要删除的内容');
		}
		$data = model('caption')->with('fid')->where(['id'=>$id])->select();
		$database = [];
		$fields = [];
		foreach($data as $v){
			if(tableField::deleteTable($v['model'])){
				$database[] = $v['id'];
			}
			foreach($v['fid'] as $field){
				$fields[] = $field['id'];
			}
		}
		model('caption')->destroy($database);
		if(!empty($fields))model('field')->destroy($fields);
		return DatajsonSuccess('删除成功');
	}
	
	public function postorders(){
		$data = input('data');
		model('caption')->where('id',$data['id'])->update(['orders'=>$data['value']]);
		return DatajsonSuccess('修改成功');
	}
	
}