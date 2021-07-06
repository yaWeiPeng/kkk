<?php /*a:3:{s:69:"/www/wwwroot/www.lilymin.com/application/admin/view/dynamic/edit.html";i:1586505189;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1615798732;}*/ ?>
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
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form">
                  <div class="layui-form-item">
                      <label for="name" class="layui-form-label">
                          <span class="x-red">*</span>微信名
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="title" name="name" required="" autocomplete="off" class="layui-input" value="<?php if((!empty($list['name']))): ?><?php echo htmlentities($list['name']); else: ?>caption官方<?php endif; ?>">
                      </div>
                  </div>
				  <div class="layui-form-item">
                      <label for="avatarUrl" class="layui-form-label">
                          <span class="x-red">*</span>头像
                      </label>
                      <div class="layui-input-inline">
						<img src="<?php if((!empty($list['avatarUrl']))): ?><?php echo htmlentities($list['avatarUrl']); else: ?>/static/i.ico<?php endif; ?>">
                      </div>
                  </div>
				  <div class="layui-form-item">
                      <label for="content" class="layui-form-label">
                          <span class="x-red">*</span>内容
                      </label>
                      <div class="layui-input-block">
					  <textarea name="content" placeholder="请输入内容" class="layui-textarea"><?php if((!empty($list['content']))): ?><?php echo htmlentities($list['content']); ?><?php endif; ?></textarea>
                      </div>
                  </div>
				  <div class="layui-form-item">
                      <label for="dianzan" class="layui-form-label">
                          <span class="x-red">*</span>点赞数量
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="title" name="dianzan" required="" autocomplete="off" class="layui-input" <?php if((!empty($list['dianzan']))): ?>value="<?php echo htmlentities($list['dianzan']); ?>"<?php endif; ?>>
                      </div>
                  </div>
				  <div class="layui-form-item">
                      <label class="layui-form-label">
                          <span class="x-red">*</span>图片
                      </label>
                      <div class="layui-input-inline">
                         <button type="button" class="layui-btn" id="uploads">
						  <i class="layui-icon">&#xe67c;</i>上传图片
						</button>
                      </div>
                  </div>
				  <div class="layui-form-item" id="pipipi" <?php if((empty($list['pic']))): ?>style="display:none;"<?php endif; ?>>
                      <label class="layui-form-label">
                          <span class="x-red">*</span>图片预览
                      </label>
					  <div id="picend">
					  <?php if((!empty($list['pic']))): foreach($list['pic'] as $v): ?>
					  <div class="imgbox" style="width:150px;height:150px;padding:10px;float:left;position: relative;border:1px double #ccc">
					  <span class="removeimg1" style="cursor: pointer;width:24px;height:24px;font-size:16px;text-align:center;line-height:24px;background: #000;color:#fff;position: absolute;right:0;top:0">x</span>
					  <img src="<?php echo htmlentities($v); ?>" height="100%" width="100%">
					  </div>
					  <?php endforeach; ?>
					  <?php endif; ?>
						 </div>
                  </div>
				  <div class="layui-form-item">
                      <label for="state" class="layui-form-label">
                          <span class="x-red">*</span>状态
                      </label>
                      <div class="layui-input-inline">
                      <input type="radio" name="state" value="1" title="显示" <?php if((!empty($list) && $list['state']['state'] == 1 || empty($list))): ?>checked<?php endif; ?>>
					  <input type="radio" name="state" value="0" title="隐藏" <?php if((!empty($list) && $list['state']['state'] == 0)): ?>checked<?php endif; ?>>
                      </div>
                  </div>
				  <?php if((!empty($list))): ?>
					<input type="hidden" name="id" value="<?php echo htmlentities($list['id']); ?>">
				  <?php endif; ?>
                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <button  class="layui-btn" lay-filter="add" lay-submit="">
                          <?php if((!empty($list))): ?>确认修改<?php else: ?>增加<?php endif; ?>
                      </button>
                  </div>
              </form>
            </div>
        </div>
        <script>
		var files = [];
		<?php if((!empty($list['pic']))): ?>
		var delfiles = [];
		<?php foreach($list['pic'] as $v): ?>
		files.push("<?php echo htmlentities($v); ?>");
		<?php endforeach; ?>
		console.log(files);
		<?php endif; ?>
        	
		layui.use('upload', function(){
		  var upload = layui.upload;
		   
		  //执行实例
		  var uploadInst = upload.render({
			elem: '#uploads' //绑定元素
			,url: '/dynamic-edit/files' //上传接口
			,method: 'post'
			,multiple: true
			,number: 5  //数量
			,field : 'pic'
			,acceptMime:'image/*'
			,done: function(res){
			  //上传完毕回调
			  $('#pipipi').css('display','block');
			  files.push(res.data);
			  $('#picend').append('<div class="imgbox" style="width:150px;height:150px;padding:10px;float:left;position: relative;border:1px double #ccc"><span class="removeimg" style="cursor: pointer;width:24px;height:24px;font-size:16px;text-align:center;line-height:24px;background: #000;color:#fff;position: absolute;right:0;top:0">x</span><img src="'+res.data+'" height="100%" width="100%"></div>');
				//0000
				localStorage.setItem('lpicdynamic',JSON.stringify(files));
				layer.msg(res.msg, {icon: 1});
			}
			,error: function(res){
			  //请求异常回调
			  console.log(res)
			}
		  });
		});
		
		$('body').on('click',".removeimg",function(){
		var that=$(this);
		var path = $(this).siblings("img").attr("src");
			$.ajax({
				type:"post",
				url:'/delfiles',
				data:{data:path},
				success:function(data){
				  var data = JSON.parse(data);
				  if(data.code == 1){
					that.parent(".imgbox").remove();
					files.splice(jQuery.inArray(that.siblings("img").attr("src"),files),1);
					if(files.length==0){
						$('#pipipi').css('display','none');
					}
					localStorage.setItem('lpicdynamic',JSON.stringify(files));
					layer.msg(data.msg, {icon: 1});
				  }else{
					layer.msg(data.msg, {icon: 2});
				  }
				}
			});
		})
		$('body').on('click',".removeimg1",function(){
		var path = $(this).siblings("img").attr("src");
			$(this).parent(".imgbox").remove();
			delfiles.push(path);
			files.splice(jQuery.inArray($(this).siblings("img").attr("src"),files),1);
			if(files.length==0){
				$('#pipipi').css('display','none');
			}
//			console.log(delfiles);
		})		
		
		layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                //监听提交
                form.on('submit(add)',function(data) {
                    //发异步，把数据提交给php
					var str = '';
					for(var i = 0;i<files.length;i++){
						str += ','+files[i];
					}
					data.field.pic = str;
					<?php if((!empty($list['pic']))): ?>
					data.field.delpic = delfiles;
					<?php endif; ?>
					console.log(data.field)
					
					$.ajax({
						type:"post",
						url:'/dynamic-edit/doadd',
						data:{data:data.field},
						success:function(data){
						  var data = JSON.parse(data);
						  if(data.code == 1){
							layer.msg(data.msg, {icon: 1});
							localStorage.removeItem('lpicdynamic');
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
                    return false;
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