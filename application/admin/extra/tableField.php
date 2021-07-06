<?php
/*数据库操作*/
namespace app\admin\extra;

use think\Db;

class tableField{
	
	/*查询所有数据库*/
	static function showTable(){
		$showTable = Db::query("show tables");
		return array_column($showTable,'Tables_in_bk');
	}
	
	/*判断数据库是否存在*/
	static function isTable($tableName){
		/*对比数据表*/
		if(in_array(config('database.prefix').$tableName,static::showTable())){
			return false;
		}else{
			/*对比caption表 暂定*/
			return true;
		}
	}
	
	/*创建数据表*/
	static function createTable($tableName,$side_table=false){
		if(!static::isTable($tableName)){
			return false;
		}
		/*创建数据主表*/
		$sql = "create table ".config('database.prefix')."{$tableName} 
				(
				id int(10) unsigned auto_increment primary key not null,
				orders int(11) unsigned default 99,
				create_time int(11) unsigned,
				update_time int(11) unsigned,
				delete_time int(11) unsigned
				)";
		if(Db::execute($sql) !== false){
			/*主表数据库创建成功,创建附表*/
			if($side_table){
			    static::createSideTable($tableName);
			}
			return true;
		}else{
			/*创建失败*/
			return false;
		}
	}
	
	/*创建副表*/
	static function createSideCreate($tableName){
	    if(!static::isTable($tableName)){
			return false;
		}
		$sql = "create table ".config('database.prefix')."{$tableName}_field 
					(
					aid int(10) unsigned auto_increment primary key not null,
					create_time int(11) unsigned,
					update_time int(11) unsigned,
					delete_time int(11) unsigned
					)";
		if(Db::execute($sql) !== false){
			return true;
		}else{
			/*创建失败*/
			return false;
		}
	}
	
	/*删除数据表*/
	static function deleteTable($model=''){
		if($model == ''){
			return false;
		}
		$table = config('database.prefix').$model;
		$sql = "drop table ".$table;
		if(Db::execute($sql)!==false){
			if(!static::isTable($table.'_field')){
				$sql = "drop table ".$table.'_field';
				Db::execute($sql);
			}
			return true;
		}
		return false;
	}
	
	/*创建字段*/
	static function createField($data){
		$table = config('database.prefix').$data['tableName'];
		/* switch($data['table']){
			case "main":
				$table = config('database.prefix').$data['tableName'];
				break;
			case "side":
				$table = config('database.prefix').$data['tableName'].'_field';
				break;
		}
		if($data['long']==''){
			$long = 255;
		}else{
			$long = $data['long'];
		}
		
		$unsigned = $data['unsigned']=='1'?'unsigned':'';
		$null = $data['null']=='1'?'not null':''; */
		$defaultValue = $data['default_value']!=''?'default '.$data['default_value']:'';
		$sql = "alter table {$table} add {$data['field']} varchar(255) {$defaultValue}";
		Db::query($sql);
		return true;
	}
	
	/*查询字段*/
	static function showField($model='',$sideTable=0){
		if($model == ''){
			return false;
		}
		//数据库全称
		$model = config('database.prefix').$model;
		//主表字段
		$mainTable = Db::getTableFields($model);
		//副表字段
		if($sideTable == 1){
			$sideTable=static::sideTableField($model);
			$count = count($mainTable)+count($sideTable);
		}else{
			$sideTable=['msg'=>'没有查询,插入$sideTable=1查询'];
			$count = count($mainTable);
		}
		$field = [
				'mainTable'=>['name'=>'主表字段','data'=>$mainTable],
				'sideTable'=>['name'=>'副表字段','data'=>$sideTable],
				];
		$data = ['count'=>$count,'field'=>$field];
		return $data;
	}
	
	/*副表字段*/
	static function sideTableField($model){
		//查询副表是否存在
		if(static::isTable($model.'_field')){
			return ['msg'=>'副表不存在'];
		}
		return Db::getTableFields($model.'_field');
	}
	
	/*判断是否存在字段*/
	static function is_exist($table,$field){
		$table = config('database.prefix').$table;
		$fields = Db::getTableFields($table);
		if(in_array($field,$fields)){
			return false;
		}else{
			return true;
		}
	}
	
	/*修改字段*/
	static function editField($data = '',$key = ''){
		if($data == '' || $key == ''){
			return false;
		}else{
			$table = config('database.prefix').$data['tableName'];
			$sql = '';
			switch($key){
				case "default_value":
					$sql = "alter table {$table} alter column {$data['field']} drop default";
					Db::query($sql);
					$sql = "alter table {$table} alter column {$data['field']} set default {$data['default_value']}";
					Db::query($sql);
					break;
				default:
					break;
			}
			return true;
		}
	}
	
	/*删除字段*/
	static function delField($table = '', $field = ''){
		if($table == '' || $field == ''){
			return false;
		}else{
			$table = config('database.prefix').$table;
			$sql = "alter table {$table} drop {$field}";
			Db::query($sql);
			return true;
		}
	}
}