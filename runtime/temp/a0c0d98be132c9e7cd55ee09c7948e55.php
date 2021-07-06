<?php /*a:3:{s:70:"/www/wwwroot/www.lilymin.com/application/admin/view/qrcode/config.html";i:1594276331;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1615798732;}*/ ?>
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
        <div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a>
              <cite><?php echo htmlentities($title); ?></cite></a>
          </span>
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5">
                                <div class="layui-show-xs-block">
									可被覆盖的区域百分比: 
									<select name="errorCorrectionLevel" id="errorCorrectionLevel">
									  <option value="L" <?php if((!empty($config) && $config->errorCorrectionLevel == 'L')): ?>selected<?php endif; ?>>7%</option>
									  <option value="M" <?php if((!empty($config) && $config->errorCorrectionLevel == 'M')): ?>selected<?php endif; ?>>15%</option>
									  <option value="Q" <?php if((!empty($config) && $config->errorCorrectionLevel == 'Q')): ?>selected<?php endif; ?>>25%</option>
									  <option value="H" <?php if((empty($config) || $config->errorCorrectionLevel == 'H')): ?>selected<?php endif; ?>>30%</option>
									</select>
                                </div>
                                <div class="layui-show-xs-block">
								内容 : 
                                    <input class="layui-input"  autocomplete="off" placeholder="内容" name="content" id="content" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->content); else: ?>lilymin.com<?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
								生成图片大小 : 
                                    <input class="layui-input"  autocomplete="off" placeholder="生成图片大小" name="matrixPointSize" id="matrixPointSize" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->matrixPointSize); else: ?>10<?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
								空白区域: 
                                    <input type="text" name="margin" id="margin" placeholder="空白区域" autocomplete="off" class="layui-input" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->margin); else: ?>2<?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
								中间logo：
								  <input type="radio" name="logo_state" value="0" title="关闭" <?php if((empty($config->logo_state) || $config->logo_state == 0)): ?>checked<?php endif; ?> lay-filter="logo_state">
								  <input type="radio" name="logo_state" value="1" title="开启" <?php if((!empty($config->logo_state) && $config->logo_state == 1)): ?>checked<?php endif; ?> lay-filter="logo_state">
                                </div>
                                <div id="logo" <?php if((empty($config->logo_state) || $config->logo_state == 0)): ?>style="display:none"<?php endif; ?>>
								logo：
								<button type="button" class="layui-btn" onclick="xadmin.open('添加图片','/image-plugin')">添加图片</button>
								<div class="layui-show-xs-block" id="select_images">
								缩略图 : <img src="<?php echo htmlentities($config->logo); ?>" style='width:100px;height:100px;margin:10px;'>
                                </div>
                                </div>
                                <div class="layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="add">保存</button>
                                </div>
								
								
								
                            </form>
							
							
                                <div class="layui-show-xs-block">
									
									<img src="" id="qrcodeTest" style='width:200px;height:200px;margin:10px;'>
									
                                    <button class="layui-btn"  onclick="tts()">测试</button>
                                </div>
							
                        </div>
                        
                    </div>
                </div>
            </div>
        </div> 
	<script>
	layui.use(['form', 'layer'],function() {
				$ = layui.jquery;
                var form = layui.form;
                var layer = layui.layer;
				var logo_state = $("input[name='logo_state']:checked").val();
				form.on('radio(logo_state)', function(data){
					if(data.value == 1){
						$('#logo').css('display','');
					}else{
						$('#logo').css('display','none');
					}
				  logo_state = data.value; //被点击的radio的value值
				});
                //监听提交
                form.on('submit(add)',function(data) {
				data.field.logo_state = logo_state;
				data.field.logo = $("#select_images").children('img').attr('src');
				console.log(data.field);return false;
                    //发异步，把数据提交给php
					$.ajax({
						type:"post",
						url:'/qrcode-config',
						data:{data:data.field},
						success:function(data){
						  var data = JSON.parse(data);
						  if(data.code == 1){
							layer.msg(data.msg, {icon: 1});
							setTimeout(function () {
							  location.reload();
							},2000);
						  }else{
							layer.msg(data.msg, {icon: 2});
						  }
						}
					});
                    return false;
                });
				});
			
				function image(arr){
					if(arr.length > 1){
						layer.msg('只能选择一个', {icon: 2});
						return false;
					}
					$("#select_images").children('img').remove();
					for(var i=0;i<arr.length;i++){
						$("#select_images").append("<img src='"+arr[i]+"' style='width:100px;height:100px;margin:10px;'>");
					}
				}
				
	function tts(){
		var data = {};
		data.errorCorrectionLevel = $('#errorCorrectionLevel').val();
		data.content = $('#content').val();
		data.matrixPointSize = $('#matrixPointSize').val();
		data.margin = $('#margin').val();
		data.logo_state = $("input[name='logo_state']:checked").val();
		data.logo = $("#select_images").children('img').attr('src');
		console.log(data);
		$.ajax({
			type:"get",
			url:'/qrcode',
			data:{data:data},
			success:function(data){
			var data = JSON.parse(data);
			  if(data.code == 1){
				console.log(data);
				layer.msg(data.msg, {icon: 1});
				$('#qrcodeTest').attr('src',data.data);
			  }else{
				layer.msg(data.msg, {icon: 2});
			  }
			}
		});
	}
			
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