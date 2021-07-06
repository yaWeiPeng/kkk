<?php /*a:4:{s:60:"/www/wwwroot/www.lilymin.com/application/admin/view/set.html";i:1607508028;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:75:"/www/wwwroot/www.lilymin.com/application/admin/view/image/image_button.html";i:1607325590;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1620268209;}*/ ?>
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
.layui-form-label{
	text-align:left;
	width:auto;
}
.layui-input{
	border-style:none none solid none;
}
</style>
<div class="layui-fluid">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-body ">
				<div class="layui-form-item">
					<div class="layui-col-md2 layui-form-label">
						网站名字
					</div>
					<div class="layui-col-md10">
						<input type="text" name="title" placeholder="网站名字" autocomplete="off" class="layui-input" value="<?=globSet('title');?>">
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-col-md2 layui-form-label">
						网站ico
					</div>
					<div class="layui-col-md10">
						<style>
.imgbox{width:180px;height:180px;padding:10px;float:left;position: relative;border:1px double #ccc}
.remove{cursor: pointer;width:24px;height:24px;font-size:16px;text-align:center;line-height:24px;background: #000;color:#fff;position: absolute;right:0;top:0}
</style>
<div class="layui-form-item">
	<?php if((1!=1)): ?>
	<label for="url" class="layui-form-label">
		<span class="x-red">*</span>图片
	</label>
	<?php endif; if((1==1)): ?>
	<div class="layui-col-md4">
		<input type="text" name="ico" placeholder="图片路径" autocomplete="off" class="layui-input" value="<?=globSet('ico')?>">
		<div style="display:none;" id="ico">
			<!-- <img src="#" style="height:150px;width:100%"> -->
		</div>
	</div>
	<?php endif; ?>
	<div class="layui-input-inline">
		<button class="layui-btn" onclick="xadmin.open('图片管理器','/image-plugin?pics=1')"><i class="layui-icon"></i>添加图片</button>
	</div>
</div>
<?php if((1!=1)): ?>
<div class="layui-form-item" id="preview" style="display:none;">
	<label class="layui-form-label">
		图片预览
	</label>
	<div id="preview_pic">
		<!-- <div class="imgbox">
			<span class="remove">x</span>
			<img src="#" height="100%" width="100%">
		</div> -->
	</div>
</div>
<?php endif; ?>
<script>
var images = [];
function image(image_arr){
	if(1==1){
		$('#ico').css({'display':'block','text-align':'center','vertical-align':'middle'});
		$('input[name=ico]').val(image_arr[0]['path']).focus().blur();
		$('#ico').html("");
		$('#ico').append('<img src="'+image_arr[0]['path']+'" style="height:150px;max-width:100%">');
		console.log(image_arr);
	}else if(1==1){
		$('#preview').css('display','block');
		//$('#pic').value('image_arr');
		//二维转一维
		for(var i=0;i<image_arr.length;i++){
			images.push(image_arr[i]);
		}
		console.log(images);
		console.log(1);
		$('#preview_pic').html("");
		//循环显示
		for(var i=0;i<images.length;i++){
			$('#preview_pic').append('<div class="imgbox"><span class="remove">x</span><img src="'+images[i]['path']+'" height="60%" width="100%"><input type="text" class="layui-input" style="margin-top:6px" value="'+images[i]['sort']+'"><input type="text" class="layui-input" style="margin-top:6px" value="'+images[i]['path']+'"></div>');
		}
	}
}

//检测单图是否有值,有值显示图片
OnePics();
function OnePics(){
	var data = '<?=globSet('ico')?>';
	if(data!=''){
		$('#ico').css({'display':'block','text-align':'center','vertical-align':'middle'});
		$('#ico').append('<img src="<?=globSet('ico')?>" style="height:150px;max-width:100%">');
	}
}
$('#preview_pic').on('click',".remove",function(){
	var path = $(this).siblings("img").attr("src");
	images.splice(jQuery.inArray($(this).siblings("img").attr("src"),images),1);
	$(this).parent(".imgbox").remove();
	if(images.length==0){
		$('#preview').css('display','none');
	}
})	
</script>
						<!-- <input type="text" name="title" placeholder="网站ico" autocomplete="off" class="layui-input"> -->
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-col-md2 layui-form-label">
						后台超时登录时间
					</div>
					<div class="layui-col-md10">
						<input type="text" name="admin_logon_timeout" placeholder="后台超时登录时间" autocomplete="off" class="layui-input" value="<?=globSet('admin_logon_timeout');?>">
					</div>
				</div>
				<div class="layui-form-item">
					<button type="button" class="layui-btn layui-btn-warm" id="addSet">添加设置项</button>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
layui.use(['layer'],function() {
	$ = layui.jquery;
	layer = layui.layer;
	$("input").blur(function(){
		$.ajax({
			type:"post",
			url:'/set/edit',
			data:{name:this.name,value:this.value},
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
	
	$('#addSet').click(function(){
		console.log(1)
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