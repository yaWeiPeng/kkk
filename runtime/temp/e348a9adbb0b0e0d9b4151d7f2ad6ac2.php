<?php /*a:4:{s:66:"/www/wwwroot/www.lilymin.com/application/admin/view/top/field.html";i:1616397630;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:65:"/www/wwwroot/www.lilymin.com/application/admin/view/top/curd.html";i:1616138187;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1620268209;}*/ ?>
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
	<?php if(('list'=='list')): ?>
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
	<?php endif; if(('list'=='edit')): ?>
	<div class="layui-fluid">
		<div class="layui-row">
	<?php endif; ?>
<!-- 添加删除按钮 -->
<div class="layui-card-header">
	<?php if(('/field/del')): ?>
	<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
	<?php endif; if(('/field/edit?model=caption')): ?>
	<button class="layui-btn" onclick="xadmin.open('添加','/field/edit?model=caption')"><i class="layui-icon"></i>添加</button>
	<?php endif; ?>
</div>

<script>
layui.use(['form'], function(){
	var form = layui.form;

	// 监听全选
	form.on('checkbox(checkall)', function(data){
		if(data.elem.checked){
			$('tbody input').prop('checked',true);
		}else{
			$('tbody input').prop('checked',false);
		}
		form.render('checkbox');
	});
});
/*删除选中*/
function delAll (argument) {
	var ids = [];

	// 获取选中的id 
	$('tbody input').each(function(index, el) {
		if($(this).prop('checked')){
		   ids.push($(this).val())
		}
	});

	layer.confirm('确认要删除吗？'+ids.toString(),function(index){
		//捉到所有被选中的，发异步进行删除
		delajax('post','/field/del',ids);
	});
}
</script>
<div class="layui-card-body layui-table-body layui-table-main">
	<table class="layui-table layui-form">
		<thead>
			<tr>
				<th><input type="checkbox" lay-filter="checkall" lay-skin="primary"></th>
				<th>字段名</th>
				<th>描述</th>
				<th>类型</th>
				<th>排序</th>
				<th>更新时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if((count($data)!=0)): foreach($data as $v): ?>
			<tr>
				<td><input type="checkbox" name="id" value="<?php echo htmlentities($v['id']); ?>" lay-skin="primary"></td>
				<td><?php echo htmlentities($v['field']); ?></td>
				<td><?php echo htmlentities($v['beizhu']); ?></td>
				<td><?php echo htmlentities($v['type']['text']); ?></td>
				<td><input type="text" name="orders" value="<?php echo htmlentities($v['orders']); ?>" data-id="<?php echo htmlentities($v['id']); ?>" class="layui-input orders" ></td>
				<td><?php echo htmlentities($v['update_time']); ?></td>
				<td>
					<button class="layui-btn layui-btn layui-btn-xs" onclick="xadmin.open('编辑','/field/edit?id=<?php echo htmlentities($v['id']); ?>&model=<?php echo htmlentities($model); ?>')"><i class="layui-icon">&#xe642;</i>编辑</button>
					<button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="del(this,<?php echo htmlentities($v['id']); ?>)" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
				</td>
			</tr>
			<?php endforeach; else: ?>
			<tr>
				<td colspan="20" align="center">暂无数据</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
						
<script>
/*删除*/
function del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		delajax('post','/field/del',id);
	});
}
$(".orders").blur(function(){
	var id = $(this).attr('data-id');
	var val = {id:id,name:this.name,value:this.value};
	$.ajax({
		type:"post",
		url:'/field/orders',
		data:{data:val},
		success:function(data){
			var data = JSON.parse(data);
			if(data.code == 1){
				layer.msg(data.msg, {icon: 1});
			}else{
				layer.msg(data.msg, {icon: 2});
			}
		}
	});
});
</script>
<?php if(('list'=='list')): ?>
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
<?php endif; if(('list'=='edit')): ?>
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