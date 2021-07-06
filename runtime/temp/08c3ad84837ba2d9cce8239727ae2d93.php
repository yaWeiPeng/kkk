<?php /*a:3:{s:70:"/www/wwwroot/www.lilymin.com/application/admin/view/region/region.html";i:1588054561;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1615798732;}*/ ?>
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
                <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
            </a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-md12  layui-form-pane">
                             <div class="layui-form-item">
                              <label class="layui-form-label">城市联动</label>
                              <div class="layui-input-inline">
                                <select name="province" lay-filter="city" id="province">
                                  <option value="">请选择省</option>
								  <?php foreach($data as $v): ?>
                                  <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
								  <?php endforeach; ?>
                                </select>
                              </div>
                              <div class="layui-input-inline city">
                                <select name="city" lay-filter="area" id="city">
                                  <option value="">请选择市</option>
                                </select>
                              </div>
                              <div class="layui-input-inline area">
                                <select name="area" id="area">
                                  <option value="">请选择县/区</option>
                                </select>
                              </div>
                            </div>
                          </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <script>
          layui.use(['form','laydate'], function(){
            var form = layui.form;
			var laydate = layui.laydate;
			//选择省
			form.on('select(city)', function(data){
			  //获取下一级
			$.ajax({
				type:"get",
				url:'/region',
				data:{pid:data.value},
				success:function(data){
				  var data = JSON.parse(data);
				  if(data.code == 1){
					$("#city").html("");
					$("#city").append("<option value=''>请选择市</option>");
					$("#area").html("");
					$("#area").append("<option value=''>请选择县/区</option>");
					for (var i = 0; i < data.data.length; i++) {
						$("#city").append("<option value="+data.data[i].id+">"+data.data[i].name+"</option>");
						form.render('select');
					}
					layer.msg(data.msg, {icon: 1});
				  }else{
					layer.msg(data.msg, {icon: 2});
				  }
				}
			});
			}); 
			//选择市
			form.on('select(area)', function(data){			  
			  //获取下一级
			$.ajax({
				type:"get",
				url:'/region',
				data:{pid:data.value},
				success:function(data){
				  var data = JSON.parse(data);
				  console.log(data);
				  if(data.code == 1){
					$("#area").html("");
					$("#area").append("<option value=''>请选择县/区</option>");
					for (var i = 0; i < data.data.length; i++) {
						$("#area").append("<option value="+data.data[i].id+">"+data.data[i].name+"</option>");
						form.render('select');
					}
					layer.msg(data.msg, {icon: 1});
				  }else{
					layer.msg(data.msg, {icon: 2});
				  }
				}
			});
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