<?php /*a:3:{s:73:"/www/wwwroot/www.lilymin.com/application/admin/view/permissions_edit.html";i:1616640910;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1615798732;}*/ ?>
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
	<?php $tagField = new \think\template\taglib\caption\tagField;$tagFieldstr = $tagField->getFieldstr("permissions",$data['id']);echo $tagFieldstr; ?>
	<div class="layui-form-item">
		<label for="visitId" class="layui-form-label">
			<span class="x-red">*</span>权限列表
		</label>
		<div class="layui-input-inline">
			<div class="layui-input-inline"><span class="x-red">一级</span></div>
			<?php foreach($column as $v): ?>
			<div class="layui-input-inline">
				<input type="checkbox" lay-filter="quanxian" name="quanxian" pid="0" value="<?php echo htmlentities($v['id']); ?>" title="<?php echo htmlentities($v['column_name']); ?>" <?php if((in_array($v['id'],$data['quanxian']))): ?>checked<?php endif; ?>>
			</div>
			<?php foreach($v['son'] as $val): ?>
			<div class="layui-input-inline"><span style="color:blue">二级</span></div>
			<div class="layui-input-inline">
				<input type="checkbox" lay-filter="quanxian" name="quanxian" pid="<?php echo htmlentities($v['id']); ?>" value="<?php echo htmlentities($val['id']); ?>" title="<?php echo htmlentities($val['column_name']); ?>" <?php if((in_array($val['id'],$data['quanxian']))): ?>checked<?php endif; ?>>
			</div>
			<div class="layui-input-inline"><span style="color:yellow">三级</span></div>
			<div class="layui-input-inline">
				<?php foreach($val['son'] as $value): ?>
				<input type="checkbox" lay-filter="quanxian" name="quanxian" pid="<?php echo htmlentities($val['id']); ?>" value="<?php echo htmlentities($value['id']); ?>" title="<?php echo htmlentities($value['column_name']); ?>" <?php if((in_array($value['id'],$data['quanxian']))): ?>checked<?php endif; ?>>
				<?php endforeach; ?>
			</div>
			<?php endforeach; ?>
			<?php endforeach; ?>
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
		$('#wait').addClass("layui-btn-disabled");
		$('#wait').html("正在提交");
		var visit = [];
		$("input:checkbox[name='quanxian']:checked").each(function(i){
			visit[i] = $(this).val();
		});
		data.field.quanxian = visit;
		editajax('post','/permissions/doedit',data.field);
		return false;
	});
	form.on('submit(edit)',function(data) {
		$('#wait').addClass("layui-btn-disabled");
		$('#wait').html("正在提交");
		var visit = [];
		$("input:checkbox[name='quanxian']:checked").each(function(i){
			visit[i] = $(this).val();
		});
		data.field.quanxian = visit;
		editajax('post','/permissions/doedit',data.field);
		return false;
	});
	form.on('checkbox(quanxian)', function(data){
		var pid = data.value;
		var value = $(this).attr('pid');
		var check = $(this).prop('checked');
		//console.log(pid);
		//console.log(value);
		$('input[name="quanxian"]').each(function() {
			if($(this).attr('pid') == pid){
				if(check){
					$(this).prop('checked',true);
				}else{
					$(this).prop('checked',false);
				}
				var secondpid = $(this).attr('value');
				var check2 = $(this).prop('checked');
				$('input[name="quanxian"]').each(function() {
					if($(this).attr('pid') == secondpid){
						if(check2){
							$(this).prop('checked',true);
						}else{
							$(this).prop('checked',false);
						}
					}
				});
			}
			if($(this).attr('value') == value){
				$(this).prop('checked',true);
			}
			//if($(this).prop('checked')){
				//var c = $(this).attr('pid');
				//console.log('选择的'+c);
				//$('input[name="quanxian"]').each(function() {
					//if($(this).prop('checked')){
					//console.log($(this).attr('pid'));
						//if($(this).attr('pid') != c){
							//$('input[name="quanxian"]').each(function() {
								//$(this).prop('checked',false);
							//});
							//$('input[name="quanxian"]').attr('value')
							//$(this).prop('checked',true);
						//}
					//}
				//});
			//}
		}); 
		form.render('checkbox');
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
