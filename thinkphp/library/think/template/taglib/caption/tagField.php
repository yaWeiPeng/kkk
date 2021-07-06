<?php

namespace think\template\taglib\caption;

use think\Db;

class tagField
{
    public function getFieldstr($model,$id='')
    {
		$tagcaption = new \app\common\model\Caption();
		$tagcaptionid = $tagcaption->where("model",$model)->value("id");
		$tagfield = new \app\common\model\Field();
		$tagfieldlist = $tagfield->where(["caption_id"=>$tagcaptionid,'isread'=>1])->order('orders desc')->column("field,type,type_val,default_value,isread,beizhu,required,miaoshu");
		$tagvalue = Db::name($model)->where('id',$id)->find();
		//$tagvalue = $tagfield->where('id',$id)->find();
        $parseStr = "";
		foreach($tagfieldlist as $k=>$v){
			switch ($v["type"]) {
			   case "varchar":
				$value = isset($tagvalue[$v["field"]]) ? $tagvalue[$v["field"]] : '';
				$required = $v['required'] == 1 ? 'lay-verify="required"' : '';
				$parseStr .= '<div class="layui-form-item"><label for="'.$v["field"].'" class="layui-form-label">'.$v["beizhu"].'</label><div class="layui-input-inline"><input type="text" name="'.$v["field"].'" value="'.htmlentities($value).'" autocomplete="off" class="layui-input" '.$required.' placeholder="'.$v['miaoshu'].'"></div></div>';
				 break;
			   case "radio":
				$arr = explode(',',$v['type_val']);
				$parseStr .= '<div class="layui-form-item"><label for="'.$v["field"].'" class="layui-form-label">'.$v["beizhu"].'</label><div class="layui-input-inline">';
				foreach($arr as $key=>$val){
					$arr2 = explode(':',$val);
					$checkedval = $tagvalue[$v["field"]] == $tagvalue["default_value"] ? $tagvalue["default_value"] : $tagvalue[$v["field"]];
					$checkedval = is_null($checkedval) ? $v["default_value"] : $checkedval;
					$checked = $arr2[0]==$checkedval ? 'checked' : '';
					$parseStr .= '<input type="radio" name="'.$v["field"].'" value="'.$arr2[0].'" title="'.$arr2[1].'" '.$checked.'>';
				}
				$parseStr .= '</div></div>';
				 break;
			   case "checkbox":
				 break;
			   case "img":
				 break;
			   default:
				 break;
			};
		}
		
		return $parseStr;
    }
	
	public function getSearch($model){
		$tagSearch = new \app\common\model\Caption();
		$tagfid = $tagSearch->where("model",$model)->value("field_id");
		$tagfid = explode(',',$tagfid);
		$fieldModel = new \app\common\model\Field();
		$search = [];
		foreach($tagfid as $v){
			if($v == 'date'){
				$search['date'] = 1;
			}else if(is_numeric($v)){
				$search['form'][] = $fieldModel->where('id',$v)->field('field,type,type_val,beizhu')->find()->toArray();
			}
		}
		return $search;
	}
}