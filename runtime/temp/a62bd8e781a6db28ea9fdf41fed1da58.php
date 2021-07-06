<?php /*a:3:{s:67:"/www/wwwroot/www.lilymin.com/application/admin/view/image/list.html";i:1607075673;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1620268209;}*/ ?>
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
	<?php if(('[type]'=='list')): ?>
	<div class="layui-fluid">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md12">
				<div class="layui-card">
	<?php endif; if(('[type]'=='edit')): ?>
	<div class="layui-fluid">
		<div class="layui-row">
	<?php endif; ?>
<style>
	.capiton-inline{
		font-size: 14px;
		height:30px;
		padding: 10px 15px 10px 15px;
		display: block;
		border-left: 4px solid transparent;
		text-align:center;
		line-height:30px;
	}
	.caption-right{
		top: 45px;
		right: -5px;
		bottom: 0px;
		z-index: 1;
		overflow: hidden;
		float:left;
	}
	.caption-images{
		height:200px;
		float:left;
		overflow:hidden; 
		padding:15px;
		border: 1px dotted transparent;
	}
	.caption-images img{
		margin:0 auto;
		display:block;
	}
	.caption-images span{
		display:block;text-align:center;
	}
	#nav li{
		height:40px;
		text-align:center;
		line-height:40px;
		cursor:pointer;
	}
	#nav li:nth-child(n+2):hover{
		font-size:20px;
	}
	#nav li:nth-child(n+2) span{
		float:right;
		display:none;
	}
	#nav li:nth-child(n+2):hover span{
		display:inline;
	}
	.caption-nav{
		top: 45px;
		bottom: 0px;
		left: 0px;
		z-index: 2;
		padding-top: 10px;
		background-color: rgb(238, 238, 238);
		width: 20%;
		max-width: 20%;
		overflow: auto;
		float:left;
	}
	.caption-left-border{
		color:red;
		font-size:20px;
	}
	.caption-images-border{
		border-color:red;
	}
</style>
<div class="capiton-inline">
	<div class="layui-col-xs3" style="height:100%">
	  <img src="/static/i.ico" style="height:100%;width:auto;">
	</div>
	<div class="layui-col-xs9">
	  <div class="layui-row">
		<div class="layui-col-xs3">
			<button type="button" class="layui-btn" id="uploads">上传</button>
		</div>
		<div class="layui-col-xs3">
			<button type="button" class="layui-btn layui-btn layui-btn-danger" id="del">删除</button>
		</div>
		<div class="layui-col-xs3">
			<button type="button" class="layui-btn layui-btn-warm" id="all">全选</button>
		</div>
		<div class="layui-col-xs3">
			<button type="button" class="layui-btn" id="sure">确认</button>
		</div>
	  </div>
	</div>
</div>
<div class="caption-nav" style="width:20%">
		<ul id="nav">
			<li onclick="xadmin.open('添加分类','/image-category-edit/add')">添加分类</li>
			<li class="cname caption-left-border" data-id="-1">所有</li>
			<li class="cname" data-id="0">未分类</li>
			<?php foreach($cate as $v): ?>
			<li class="cname" data-id="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?>
				<span class="layui-btn layui-btn-normal" onclick="xadmin.open('修改','/image-category-edit/<?php echo htmlentities($v['id']); ?>')" id="image-category-edit">修改</span>
			</li>
			<?php endforeach; ?>
		</ul>
</div>
<div class="caption-right" style="width:80%">
	<div class="layui-row" id="caption-image-div" style="height:500px;overflow: auto;margin-left:5px">
		<?php foreach($data as $v): ?>
		<div class="caption-images layui-col-xs6 layui-col-md3" data-id="<?php echo htmlentities($v['id']); ?>">
		  <img src="<?php echo htmlentities($v['path']); ?>" style="height:80%;max-width:100%;">
		  <span style="margin-top:14px"><?php echo htmlentities($v['name']); ?></span>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<script>
layui.use('upload', function(){
	$ = layui.jquery;
	var upload = layui.upload;

	//执行实例
	var uploadInst = upload.render({
	elem: '#uploads' //绑定元素
	,url: '/images-uploads' //上传接口
	,method: 'post'
	,multiple: true
	,number: 3
	,field : 'pic'
	,data: {
	  id: function(){
	   return id = $('.caption-left-border').attr("data-id");
	  }
	}
	,acceptMime:'image/*'
	,allDone: function(res){
	console.log(res);
	  //上传完毕回调
	}
	,done: function(res){
		layer.msg(res.msg, {icon: 1});
		location.reload();
	  //上传完毕回调
	}
	,error: function(res){
	  //请求异常回调
	  console.log(res)
	}
	});
	
	//选中事件
	$('.cname').click(function(){
		$('#nav').children().removeClass('caption-left-border');
		$(this).addClass('caption-left-border');
		var id = $('.caption-left-border').attr("data-id");
		$.ajax({
			type:"post",
			url:'/image-plugin-cate',
			data:{id:id},
			success:function(data){
			  var data = JSON.parse(data);
			  if(data.code == 1){
				$('#caption-image-div').html("");
				for(var i=0;i<data.data.length;i++){
					$('#caption-image-div').append("<div class='caption-images layui-col-xs6 layui-col-md3' data-id='"+data.data[i].id+"'><img src='"+data.data[i].path+"' style='height:80%;max-width:200px;'>  <span>"+data.data[i].name+"</span></div>");
				}
				layer.msg(data.msg, {icon: 1});
			  }else{
				layer.msg('获取失败，重试', {icon: 2});
			  }
			}
		});
	});
	
	$('.caption-right').on("click", '.caption-images', function(){
		if($(this).hasClass('caption-images-border')){
			$(this).removeClass('caption-images-border');
		}else{
			$(this).addClass('caption-images-border');
		}
	});
	
	$('#del').click(function(){
		var id=[];
		for(var i=0;i<$(".caption-images-border").length;i++){
			id.push($(".caption-images-border").eq(i).attr("data-id"))
		}
		$.ajax({
			type:"post",
			url:'/image-plugin-del',
			data:{id:id},
			success:function(data){
			  var data = JSON.parse(data);
			  if(data.code == 1){
				$('.caption-images-border').remove();
				layer.msg(data.msg, {icon: 1});
			  }else{
				layer.msg('重试', {icon: 2});
			  }
			}
		});
	});
	
	$('#all').click(function(){
		$('#caption-image-div').children(".caption-images").addClass('caption-images-border');
	});
	
	$('#sure').click(function(){
		var arr = [];
		for(var i=0;i<$(".caption-images-border").length;i++){
			var image = [];
			image['path'] = $(".caption-images-border").eq(i).children('img').attr('src');
			image['sort'] = 888;
			arr.push(image);
		}
		parent.image(arr);	
		
		
		var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
		
		parent.layer.close(index);
		
	});
	
	$("#image-category-edit").click(function(event){
		event.stopPropagation();
	});
	
});


</script>
<?php if(('[type]'=='list')): ?>
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
<?php endif; if(('[type]'=='edit')): ?>
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