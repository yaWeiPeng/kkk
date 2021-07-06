<?php /*a:3:{s:67:"/www/wwwroot/www.lilymin.com/application/admin/view/visit/list.html";i:1588147474;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1615798732;}*/ ?>
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
                            <form class="layui-form layui-col-space5" action="/article" method="get">
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="title"  placeholder="请输入文章名" autocomplete="off" class="layui-input" <?php if((!empty($get['title']))): ?>value="<?php echo htmlentities($get['title']); ?>"<?php endif; ?>>
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                            <button class="layui-btn" onclick="xadmin.open('添加分类','/visit-category-edit/add',600,300)"><i class="layui-icon"></i>添加分类</button>
							<button class="layui-btn" onclick="xadmin.open('添加控制器方法','/visit-list-edit/add',500,400)"><i class="layui-icon"></i>添加控制器方法</button>
							<span style="float:right">分类数：<span id="cp"><?php echo htmlentities($count); ?></span></span>
						</div>
                        <div class="layui-card-body layui-table-body layui-table-main">
                            <table class="layui-table layui-form">
                              <thead>
                                <tr>
                                  <th>
                                    <input type="checkbox" lay-filter="checkall" name=""  lay-skin="primary">
                                  </th>
                                  <th>ID</th>
                                  <th>名称</th>
                                  <th>作用|路径</th>
                                  <th>创建时间</th>
                                  <th>操作</th>
                              </thead>
                              <tbody>
							  <?php foreach($data as $v): ?>
                                <tr>
                                  <td>
                                    <input type="checkbox" name="id" value="<?php echo htmlentities($v['id']); ?>" lay-skin="primary">
                                  </td>
                                  <td><?php echo htmlentities($v['id']); ?></td>
                                  <td><?php echo htmlentities($v['name']); ?></td>
                                  <td>
								  <?php foreach($v['son'] as $vv): ?>
								  <p><?php echo htmlentities($vv['name']); ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;/<?php echo htmlentities($vv['controller']); ?>/<?php echo htmlentities($vv['action']); ?></p>
								  <?php endforeach; ?>
								  </td>
                                  <td><?php echo htmlentities($v['create_time']); ?></td>
                                  <td class="td-manage">
                                    <a title="编辑"  onclick="xadmin.open('编辑','/article-edit/<?php echo htmlentities($v['id']); ?>')" href="javascript:;">
                                      <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="删除" onclick="member_del(this,<?php echo htmlentities($v['id']); ?>)" href="javascript:;">
                                      <i class="layui-icon">&#xe640;</i>
                                    </a>
                                  </td>
                                </tr>
								<?php endforeach; ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    <script>
      layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var  form = layui.form;


        // 监听全选
        form.on('checkbox(checkall)', function(data){

          if(data.elem.checked){
            $('tbody input').prop('checked',true);
          }else{
            $('tbody input').prop('checked',false);
          }
          form.render('checkbox');
        }); 
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });


      });

       /*用户-停用*/
            function member_stop(obj,id){
          layer.confirm('确认要操作吗？',function(index){
$.ajax({
	type:"post",
	url:'/article-state',
	data:{id:id},
	success:function(data){
	  var data = JSON.parse(data);
	  if(data.code == 1){
			if($(obj).text()=='显示' || $(obj).text()=='已显示'){
                //发异步把用户状态进行更改
                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-normal').addClass('layui-btn-warm').text('已隐藏');
                layer.msg('已隐藏!',{icon: 1,time:1000});
              }else{
                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-warm').addClass('layui-btn-normal').text('已显示');
                layer.msg('已显示!',{icon: 1,time:1000});
              }
	  }else{
		layer.msg(data.msg, {icon: 2,time:1000});
	  }
	}
});
              
              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
			  $.ajax({
					type:"post",
					url:'/article-edit/del',
					data:{id:id},
					success:function(data){
					  var data = JSON.parse(data);
					  if(data.code == 1){
							$(obj).parents("tr").remove();
							var old = $("#cp").html();
							$("#cp").html(old - 1);
							layer.msg(data.msg,{icon:1,time:1000});
					  }else{
						layer.msg(data.msg, {icon: 2});
					  }
					}
				});
             
          });
      }



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
			$.ajax({
					type:"post",
					url:'/article-edit/del',
					data:{id:ids},
					success:function(data){
					  var data = JSON.parse(data);
					  if(data.code == 1){
							$(".layui-form-checked").not('.header').parents('tr').remove();
							var old = $("#cp").html();
							$("#cp").html(old - ids.length);
							layer.msg(data.msg,{icon:1,time:1000});
					  }else{
					  console.log(data.msg);
						layer.msg(data.msg, {icon: 2});
					  }
					}
				});
        });
      }
      $('body').on('click',".layui-layer-close",function(){
			var pic = JSON.parse(localStorage.getItem('lpic'));
			$.ajax({
				type:"post",
				url:'/delfiles',
				data:{data:pic},
				success:function(data){
				  var data = JSON.parse(data);
				  if(data.code == 1){
					localStorage.removeItem('lpic');
				  }
				}
			});
		})
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