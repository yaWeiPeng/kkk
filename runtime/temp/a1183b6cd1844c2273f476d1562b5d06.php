<?php /*a:3:{s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/top/field_edit.html";i:1620288522;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1620268209;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="stylesheet" href="/static/admin/css/font.css">
        <link rel="stylesheet" href="/static/admin/css/xadmin.css">
        <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/static/admin/js/xadmin.js"></script>
		<!--兼容jq-->
		<script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>
		
		<!--百度编辑器js-->
		<script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.config.js"></script>
		<script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.all.min.js"> </script>
		<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
		<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
		<script type="text/javascript" charset="utf-8" src="/static/ueditor/lang/zh-cn/zh-cn.js"></script>
		
    </head>
    <body>
	<div class="x-nav">
		<?php if(isset($title)): ?>
		<!-- <span class="layui-breadcrumb">
			<a href="javascript:void(0)">首页</a>
			<a><cite><?php echo htmlentities($title); ?></cite></a>
		</span> -->
		<?php endif; ?>
		<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新"><i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
	</div>
	<?php if(('edit'=='list')): ?>
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
	<?php endif; if(('edit'=='edit')): ?>
	<div class="layui-fluid">
		<div class="layui-row">
	<?php endif; ?>
<form class="layui-form">
	<!-- <div class="layui-form-item">
		<label for="table" class="layui-form-label">
			<span class="x-red">*</span>表
		</label>
		<div class="layui-input-inline" style="width:260px">
			<select name="table" lay-verify="required">
				<option value="">选择表</option>
				<option value="main">主表</option>
				<option value="side">副表</option>
			</select>
		</div>
	</div> -->
	<div class="layui-form-item">
		<label for="field" class="layui-form-label">
			<span class="x-red">*</span>字段名
		</label>
		<div class="layui-input-inline">
			<input type="text" name="field" <?php if((isset($field))): ?>value="<?php echo htmlentities($field['field']); ?>" disabled<?php endif; ?> autocomplete="off" class="layui-input" lay-verify="required">
		</div>
		<div class="layui-form-mid layui-word-aux">
			<span class="x-red">*2-15位,可英文,可下划线,区分大小写</span>
		</div>
	</div>
  <div class="layui-form-item">
	  <label for="type" class="layui-form-label">
		  <span class="x-red">*</span>字段类型
	  </label>
	  <div class="layui-input-inline" style="width:260px">
		  <select name="type" lay-filter="type" lay-verify="required">
			<option value="">选择类型</option>
			<option value="varchar" <?php if((isset($field))): if($field['type']['type']=='varchar'): ?>selected<?php endif; ?><?php endif; ?>>输入框</option>
			<option value="radio" <?php if((isset($field))): if($field['type']['type']=='radio'): ?>selected<?php endif; ?><?php endif; ?>>单选</option>
			<option value="checkbox" <?php if((isset($field))): if($field['type']['type']=='checkbox'): ?>selected<?php endif; ?><?php endif; ?>>多选</option>
			  <option value="img" <?php if((isset($field))): if($field['type']['type']=='img'): ?>selected<?php endif; ?><?php endif; ?>>图片</option>
			  <option value="img" <?php if((isset($field))): if($field['type']['type']=='img'): ?>selected<?php endif; ?><?php endif; ?>>关联</option>
		  </select>
	  </div>
  </div>
  <div class="layui-form-item">
	  <label for="type_val" class="layui-form-label">
		  <span class="x-red">*</span>字段类型值
	  </label>
	  <div class="layui-input-inline" style="width:70%">
		  <input type="text" name="type_val" <?php if((isset($field))): ?>value="<?php echo htmlentities($field['type_val']); ?>"<?php endif; ?> autocomplete="off" class="layui-input" placeholder="单选多选输入格式:键:值,键:值 | 图片输入格式:1单图,0多图 | 关联表的名字,默认关联到id">
	  </div>
  </div>
  <!-- <div class="layui-form-item">
	  <label for="url" class="layui-form-label">
		  <span class="x-red">*</span>无符号
	  </label>
	  <div class="layui-input-block">
		  <input type="radio" name="unsigned" value="1" title="无符号">
		  <input type="radio" name="unsigned" value="0" title="有符号" checked>
	  </div>
  </div> -->
  <!-- <div class="layui-form-item">
	  <label for="url" class="layui-form-label">
		  <span class="x-red">*</span>是否为空
	  </label>
	  <div class="layui-input-block">
		  <input type="radio" name="null" value="1" title="不为空">
		  <input type="radio" name="null" value="0" title="为空" checked>
	  </div>
  </div> -->
  <div class="layui-form-item">
	  <label for="default_value" class="layui-form-label">
		  <span class="x-red">*</span>默认值
	  </label>
	  <div class="layui-input-inline" style="width:70%">
		  <input type="text" name="default_value" <?php if((isset($field))): ?>value="<?php echo htmlentities($field['default_value']); ?>"<?php endif; ?> autocomplete="off" class="layui-input" placeholder="单选多选默认选择哪个,就写键的值.输入框直接写,没有就不填">
	  </div>
  </div>
	<?php if((!isset($field))): ?>
	<div class="layui-form-item">
		<label for="check" class="layui-form-label"><span class="x-red">*</span>检查是否存在</label>
		<div class="layui-input-inline">
			<input type="radio" name="check" value="1" title="是" checked>
			<input type="radio" name="check" value="0" title="否">
		</div>
	</div>
	<?php endif; $tagField = new \think\template\taglib\caption\tagField;$tagFieldstr = $tagField->getFieldstr("field",$field['id']);echo $tagFieldstr; ?>
  <!-- <div class="layui-form-item">
	  <label for="url" class="layui-form-label">
		  <span class="x-red">*</span>注释
	  </label>
	  <div class="layui-input-block">
		  <textarea name="body" placeholder="请输入内容"></textarea>
	  </div>
  </div> -->
  <input type="hidden" name="tableName" value="<?php echo htmlentities($table['model']); ?>">
  <input type="hidden" name="caption_id" value="<?php echo htmlentities($table['id']); ?>">
  <div class="layui-form-item">
	  <label for="L_repass" class="layui-form-label"></label>
		<?php if((isset($field))): ?>
		<input type="hidden" name="id" value="<?php echo htmlentities($field['id']); ?>" />
		<button  class="layui-btn" lay-filter="edit" lay-submit="" id="wait">修改</button>
		<?php else: ?>
		<button  class="layui-btn" lay-filter="add" lay-submit="" id="wait">添加</button>
		<?php endif; ?>
  </div>
</form>
<script>
layui.use(['form', 'layer'],function() {
	var $ = layui.jquery,
		form = layui.form;
	form.on('submit(add)',function(data) {
		editajax('post','/field/doedit',data.field);
		return false;
	});
	form.on('submit(edit)',function(data) {
		editajax('post','/field/doedit',data.field);
		return false;
	});
});

</script>
<?php if(('edit'=='list')): ?>
			</div>
		</div>
	</div>
</div>

<script>
function delajax(type,url,id){
	$.ajax({
		type:type,
		url:url,
		data:{id:id},
		success:function(data){
			var data = JSON.parse(data);
			if(data.code == 1){
				layer.msg(data.msg,{icon:1,time:1000});
				setTimeout(function () {
					location.reload();
				},1000);
			}else{
				layer.msg(data.msg, {icon: 2});
			}
		}
	});
}
</script>
<?php endif; if(('edit'=='edit')): ?>
	</div>
</div>

<script>
function editajax(type,url,field){
	$('#wait').addClass("layui-btn-disabled");
	$.ajax({
		type:type,
		url:url,
		data:{data:field},
		success:function(data){
			var data = JSON.parse(data);
			if(data.code == 1){
				layer.msg(data.msg, {icon: 1});
				var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
				setTimeout(function () {
				  parent.layer.close(index);
				  parent.location.reload();
				},1000);
			}else{
				layer.msg(data.msg, {icon: 2});
				$('#wait').removeClass("layui-btn-disabled");
			}
		}
	});
}
</script>
<?php endif; ?>


</body>

</html>