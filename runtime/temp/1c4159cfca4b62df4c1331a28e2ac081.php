<?php /*a:2:{s:67:"/www/wwwroot/www.lilymin.com/application/admin/view/yzm/config.html";i:1617328116;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;}*/ ?>
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
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5">
                                <div class="layui-show-xs-block">
								Account Sid （开发者控制台首页）: 
                                    <input class="layui-input"  autocomplete="off" placeholder="AccountSid" name="AccountSid" id="" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->AccountSid); ?><?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
								Auth Token （开发者控制台首页）: 
                                    <input class="layui-input"  autocomplete="off" placeholder="AuthToken" name="AuthToken" id="" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->AuthToken); ?><?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
								appid （应用的ID，可在开发者控制台内的短信产品下查看）: 
                                    <input type="text" name="appid"  placeholder="appid" autocomplete="off" class="layui-input" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->appid); ?><?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
								templateid （模板ID）: 
                                    <input type="text" name="templateid"  placeholder="templateid" autocomplete="off" class="layui-input" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->templateid); ?><?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
								param （验证码）: 
                                    <input type="text" name="param"  placeholder="param" autocomplete="off" class="layui-input" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->param); ?><?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="add">保存</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
	<script>
	layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;
                //监听提交
                form.on('submit(add)',function(data) {
                    //发异步，把数据提交给php
					$.ajax({
						type:"post",
						url:'/yzm-config',
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
	</script>
</html>