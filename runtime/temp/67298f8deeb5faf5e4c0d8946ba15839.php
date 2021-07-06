<?php /*a:2:{s:70:"/www/wwwroot/www.lilymin.com/application/admin/view/speech/config.html";i:1617328158;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;}*/ ?>
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
								APP_ID: 
                                    <input class="layui-input"  autocomplete="off" placeholder="APP_ID" name="APP_ID" id="" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->APP_ID); ?><?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
								API_KEY : 
                                    <input class="layui-input"  autocomplete="off" placeholder="API_KEY" name="API_KEY" id="" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->API_KEY); ?><?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
								SECRET_KEY: 
                                    <input type="text" name="SECRET_KEY"  placeholder="SECRET_KEY" autocomplete="off" class="layui-input" value="<?php if((!empty($config))): ?><?php echo htmlentities($config->SECRET_KEY); ?><?php endif; ?>">
                                </div>
                                <div class="layui-show-xs-block">
								语速：<br><br>
								<div id="spd"></div><br>
                                </div>
                                <div class="layui-show-xs-block">
								音调：<br><br>
								<div id="pit"></div><br>
                                </div>
                                <div class="layui-show-xs-block">
								音量：<br><br>
								<div id="vol"></div><br>
                                </div>
                                <div class="layui-show-xs-block">
								发音：<br><br>
								<div class="layui-input-inline">
								  <input type="radio" name="per" value="0" title="女声" <?php if((empty($config->per) || $config->per == 0)): ?>checked<?php endif; ?>>
								  <input type="radio" name="per" value="1" title="男声" <?php if((!empty($config->per) && $config->per == 1)): ?>checked<?php endif; ?>>
								  <input type="radio" name="per" value="2" title="情感合成-度逍遥" <?php if((!empty($config->per) && $config->per == 2)): ?>checked<?php endif; ?>>
								  <input type="radio" name="per" value="3" title="情感合成-度丫丫" <?php if((!empty($config->per) && $config->per == 3)): ?>checked<?php endif; ?>>
								  </div>
                                </div>
                                <div class="layui-show-xs-block">
								变量含义：<a href="https://ai.baidu.com/ai-doc/SPEECH/7k4nv3ngr" target="_blank">https://ai.baidu.com/ai-doc/SPEECH/7k4nv3ngr</a>
                                </div>
                                <div class="layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="add">保存</button>
                                </div>
								
								
								
                            </form>
							
                        </div>
                        
                    </div>
                </div>
            </div>
					<div class="layui-show-xs-block">
					测试: 
						<input type="text" name="text" id="text" autocomplete="off" class="layui-input" value="百度语音合成">
						<button class="layui-btn" onclick="tts()">合成</button>
						
			 <audio controls='controls' id="music"></audio>
					</div>
        </div> 
	<script>
	$ = layui.jquery;
	function tts(){
	var text = $('#text').val();
		$.ajax({
			type:"get",
			url:'/speech',
			data:{data:text},
			success:function(data){
			var data = JSON.parse(data);
			  if(data.code == 1){
				layer.msg(data.msg, {icon: 1});
				$('#music').attr('src',data.data);
			  }else{
				layer.msg(data.msg, {icon: 2});
			  }
			}
		});
	}
	
	var spdValue;
	var pitValue;
	var volValue;
	layui.use('slider', function(){
  var slider = layui.slider;
  
  //渲染
  var spd = slider.render({
    elem: '#spd'  //绑定元素
	,type: 'default'
	,min: 0
	,max: 9
	,step: 1
	,change: function(value){
		spdValue = value;//动态获取滑块数值
	  }
  });
  spd.setValue(<?php if((!empty($config))): ?><?php echo htmlentities($config->spd); else: ?>5<?php endif; ?>);
  
  var pit = slider.render({
    elem: '#pit'  //绑定元素dd
	,type: 'default'
	,min: 0
	,max: 9
	,step: 1
	,change: function(value){
		pitValue = value;//动态获取滑块数值
	  }
  });
  pit.setValue(<?php if((!empty($config))): ?><?php echo htmlentities($config->pit); else: ?>5<?php endif; ?>);
  var vol = slider.render({
    elem: '#vol'  //绑定元素
	,type: 'default'
	,min: 0
	,max: 15
	,step: 1
	,change: function(value){
		volValue = value;//动态获取滑块数值
	  }
  });
  vol.setValue(<?php if((!empty($config))): ?><?php echo htmlentities($config->vol); else: ?>5<?php endif; ?>);
});
	
	layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;
                //监听提交
                form.on('submit(add)',function(data) {
				data.field.spd = spdValue;
				data.field.pit = pitValue;
				data.field.vol = volValue;
                    //发异步，把数据提交给php
					$.ajax({
						type:"post",
						url:'/speech-config',
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