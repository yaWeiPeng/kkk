<?php /*a:3:{s:74:"/www/wwwroot/www.lilymin.com/application/admin/view/top/database_edit.html";i:1620287551;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1620268209;}*/ ?>
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
<!--数据库列表修改-->
<form class="layui-form">
	<?php $tagField = new \think\template\taglib\caption\tagField;$tagFieldstr = $tagField->getFieldstr("caption",$data['id']);echo $tagFieldstr; if((!isset($data))): ?>
	<div class="layui-form-item">
		<label for="check" class="layui-form-label"><span class="x-red">*</span>检查是否存在</label>
		<div class="layui-input-inline">
		<input type="radio" name="check" value="1" title="是" checked>
		<input type="radio" name="check" value="0" title="否">
		</div>
	</div>
	<?php else: ?>
	<div class="layui-form-item">
		<label for="search" class="layui-form-label"><span class="x-red">*</span>搜索框</label>
		<div class="layui-input-inline">
			<p>日期选择</p>
			<input type="checkbox" name="search" value="date" title="日期" <?php if((in_array('date',$data['field_id']))): ?>checked<?php endif; ?>>
			<p>模糊搜索</p>
			<?php foreach($field as $v): if(($v['type']['type'] == 'varchar')): ?>
			<input type="checkbox" name="search" value="<?php echo htmlentities($v['id']); ?>" title="<?php echo htmlentities($v['beizhu']); ?>" <?php if((in_array($v['id'],$data['field_id']))): ?>checked<?php endif; ?>>
			<?php endif; ?>
			<?php endforeach; ?>
			<p>下拉搜索</p>
			<?php foreach($field as $v): if(($v['type']['type'] == 'radio')): ?>
			<input type="checkbox" name="search" value="<?php echo htmlentities($v['id']); ?>" title="<?php echo htmlentities($v['beizhu']); ?>" <?php if((in_array($v['id'],$data['field_id']))): ?>checked<?php endif; ?>>
			<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
	<div class="layui-form-item">
		<label for="join" class="layui-form-label"><span class="x-red">*</span>关联表</label>
		<div class="layui-input-inline">
			<input type="checkbox" name="join" value="date" title="日期" lay-filter="join">
			<input type="checkbox" name="join" value="date" title="日期" lay-filter="join">
		</div>
	</div>
	<div class="layui-form-item">
		<label for="L_repass" class="layui-form-label"></label>
		<?php if((isset($data))): ?>
		<input type="hidden" name="id" value="<?php echo htmlentities($data['id']); ?>" />
		<button  class="layui-btn" lay-filter="edit" lay-submit="" id="wait">修改</button>
		<?php else: ?>
		<button  class="layui-btn" lay-filter="add" lay-submit="" id="wait">添加</button>
		<?php endif; ?>
	</div>
</form>
<script>
layui.use(['form', 'layer'],function() {
	var $ = layui.jquery,
		form = layui.form,
		layer = layui.layer;
	//监听提交
	form.on('submit(add)',function(data) {
		editajax('post','/caption/doedit',data.field);
		return false;
	});
	form.on('submit(edit)',function(data) {
		var search = [];
		$('input[name="search"]:checked').each(function() {
		  search.push($(this).val());
		});
		data.field.field_id = search;
		editajax('post','/caption/doedit',data.field);
		return false;
	});
	form.on('checkbox(join)', function(data){
		console.log(data.elem.checked); //是否被选中，true或者false
		console.log(data.value); //复选框value值，也可以通过data.elem.value得到
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