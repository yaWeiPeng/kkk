<?php /*a:3:{s:67:"/www/wwwroot/www.lilymin.com/application/admin/view/visit/edit.html";i:1588140504;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1615798732;}*/ ?>
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
                      <label for="cid" class="layui-form-label">
                          <span class="x-red">*</span>上级分类
                      </label>
                      <div class="layui-input-inline">
                          <select name="cid">
							  <option value="">请选择分类</option>
							  <?php foreach($category as $v): ?>
							  <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
							  <?php endforeach; ?>
							</select>
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>必填
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="name" class="layui-form-label">
                          <span class="x-red">*</span>作用
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="name" name="name" lay-verify="required" autocomplete="off" class="layui-input" <?php if((!empty($list['name']))): ?>value="<?php echo htmlentities($list['name']); ?>"<?php endif; ?>>
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>必填
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="controller" class="layui-form-label">
                          <span class="x-red">*</span>控制器
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="controller" name="controller" lay-verify="required" autocomplete="off" class="layui-input" <?php if((!empty($list['controller']))): ?>value="<?php echo htmlentities($list['controller']); ?>"<?php endif; ?>>
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>必填
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="action" class="layui-form-label">
                          <span class="x-red">*</span>方法
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="action" name="action" lay-verify="required" autocomplete="off" class="layui-input" <?php if((!empty($list['action']))): ?>value="<?php echo htmlentities($list['action']); ?>"<?php endif; ?>>
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>必填
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
        	
		
		
		layui.use(['form', 'layer'],function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                //监听提交
                form.on('submit(add)',function(data) {
                    //发异步，把数据提交给php
					$.ajax({
						type:"post",
						url:'/visit-list-edit/doadd',
						data:{data:data.field},
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