<?php /*a:3:{s:68:"/www/wwwroot/www.lilymin.com/application/admin/view/column/edit.html";i:1616122199;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1615798732;}*/ ?>
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
	<div class="layui-form-item">
		<label for="pid" class="layui-form-label">
			<span class="x-red">*</span>上级分类
		</label>
		<div class="layui-input-inline">
			<select name="pid">
				<option value="0" <?php if((empty($data) || $data['pid']==0)): ?>selected<?php endif; ?>>顶级分类</option>
				<?php echo $category;?>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label for="column_name" class="layui-form-label"><span class="x-red">*</span>分类名字</label>
		<div class="layui-input-inline">
			<input type="text" name="column_name" lay-verify="required" autocomplete="off" class="layui-input" value="<?php if((!empty($data))): ?><?php echo htmlentities($data['column_name']); ?><?php endif; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label for="url" class="layui-form-label"><span class="x-red">*</span>访问地址</label>
		<div class="layui-input-inline">
			<input type="text" name="url" lay-verify="required" autocomplete="off" class="layui-input" value="<?php if((!empty($data))): ?><?php echo htmlentities($data['url']); else: ?>javascript:;<?php endif; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label for="position" class="layui-form-label"><span class="x-red">*</span>显示位置</label>
		<div class="layui-input-inline">
			<select name="position">
				<option value="1" <?php if((empty($data) || $data['position']['position']==1)): ?>selected<?php endif; ?>>左边</option>
				<option value="2" <?php if((!empty($data) && $data['position']['position']==2)): ?>selected<?php endif; ?>>顶部</option>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label for="status" class="layui-form-label"><span class="x-red">*</span>状态</label>
		<div class="layui-input-inline">
		<input type="radio" name="status" value="1" title="显示" <?php if((!empty($data) && $data['status']['status'] == 1 || empty($list))): ?>checked<?php endif; ?>>
		<input type="radio" name="status" value="0" title="隐藏" <?php if((!empty($data) && $data['status']['status'] == 0)): ?>checked<?php endif; ?>>
		</div>
	</div>
	<?php $tagField = new \think\template\taglib\caption\tagField;$tagFieldstr = $tagField->getFieldstr("column",$data['id']);echo $tagFieldstr; ?>
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
		$('#wait').addClass("layui-btn-disabled");
		$('#wait').html("正在创建。。。");
		editajax('post','/column/doedit',data.field);
		return false;
	});
	form.on('submit(edit)',function(data) {
		$('#wait').addClass("layui-btn-disabled");
		$('#wait').html("正在修改。。。");
		editajax('post','/column/doedit',data.field);
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
			}
		}
	});
}
</script>
<?php endif; ?>


</body>

</html>