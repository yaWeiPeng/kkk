<?php
namespace app\admin\controller;

use think\Db;
use app\admin\extra\tableField;
use app\common\model\Caption as caption;

class Field extends Base
{
	
    public function getindex(){
		$data = model('field')->where('caption_id',input('id'))->order('orders desc')->select();
		$this->assign([
			'data' => $data,
			'model' => input('model'),
			'addurl' => '/field/edit?model='.input('model'),				//添加url
			'delurl' => '/field/del',								//删除url
			]);
		return view("/top/field");
    }
	
	public function getedit(){
		$table = model('caption')->where('model',input('model'))->field('id,model')->find();
		if(input('id')){
			$field = model('field')->where('id',input('id'))->find();
			$this->assign([
				'field' => $field,
			]);
		}
		$this->assign([
			'table' => $table,
			]);
		return view("/top/field_edit");
	}
	
	public function postdoedit(){
		$data = input('data');
        $check = isset($data['check']) ? $data['check'] : '1';
		/* $validate = validate('AllVal');
		if(!$validate->scene('FieldAdd')->check($data)){
			return DatajsonError('字段不符合规则','',$validate->getError());
		} */
		if(isset($data['id'])){
			$old = model('field')->where('id',$data['id'])->find();
			if($old['default_value']!=$data['default_value']){
				if(tableField::editField($data,'default_value')){
					model('field')->where(['id'=>$data['id']])->update(['default_value'=>$data['default_value']]);
				}
			}
			unset($data['tableName']);unset($data['default_value']);
			model('field')->where(['id'=>$data['id']])->update($data);
			return DatajsonSuccess('修改成功','',[]);
		}else{
            if($check==1) {
                if (!tableField::is_exist($data['tableName'], $data['field'])) {
                    return DatajsonError('已存在字段');
                }
                if (tableField::createField($data) !== true) {
                    return DatajsonError(tableField::createField($data), '', $data);
                }
            }
            model($this->controller)->save($data);
            return DatajsonSuccess('创建成功','',[]);
		}
	}
	
	public function postdel(){
		$id = input('id');
		if(empty($id)){
			return DatajsonError('未选中任何需要删除的内容');
		}
		$data = model('field')->with('cid')->where(['id'=>$id])->select();
		$field = [];
		foreach($data as $k=>$v){
			if(tableField::delField($v['cid']['model'],$v['field'])){
				$field[] = $v['id'];
			}
		}
		model('field')->destroy($field);
		return DatajsonSuccess('删除成功');
	}
	
	public function postorders(){
		$data = input('data');
		model('field')->where('id',$data['id'])->update(['orders'=>$data['value']]);
		return DatajsonSuccess('修改成功');
	}
}