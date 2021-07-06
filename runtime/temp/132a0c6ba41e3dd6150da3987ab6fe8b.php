<?php /*a:3:{s:75:"/www/wwwroot/www.lilymin.com/application/admin/view/novelcategory/list.html";i:1587713974;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_header.html";i:1614937591;s:71:"/www/wwwroot/www.lilymin.com/application/admin/view/public/_footer.html";i:1615798732;}*/ ?>
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
		<a href="/">首页</a>
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
					<form class="layui-form layui-col-space5">
						<div class="layui-input-inline layui-show-xs-block">
							<input class="layui-input" placeholder="分类名" name="cate_name"></div>
						<div class="layui-input-inline layui-show-xs-block">
							<button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon"></i>增加</button>
						</div>
					</form>
					<hr>
					<blockquote class="layui-elem-quote">每个tr 上有两个属性 cate-id='1' 当前分类id fid='0' 父级id ,顶级分类为 0，有子分类的前面加收缩图标<i class="layui-icon x-show" status='true'>&#xe623;</i></blockquote>
				</div>
				<div class="layui-card-header">
					<button class="layui-btn layui-btn-danger" onclick="delAll()">
						<i class="layui-icon"></i>批量删除</button>
					<button class="layui-btn" onclick="xadmin.open('添加分类','/novel-category-edit/add')"><i class="layui-icon"></i>添加分类</button>
					<span style="float:right">总数：<span id="cp"><?php echo htmlentities($count); ?></span></span>
				</div>
				<div class="layui-card-body ">
					<table class="layui-table layui-form">
					  <thead>
						<tr>
						  <th width="20">
							<input type="checkbox" lay-filter="checkall" name="" lay-skin="primary">
						  </th>
						  <th width="70">ID</th>
						  <th width="500">栏目名</th>
						  <th width="50">排序</th>
						  <th width="80">状态</th>
						  <th>操作</th>
					  </thead>
					  <tbody class="x-cate">
						<?php foreach($data as $v): ?>
						<tr cate-id='<?php echo htmlentities($v["id"]); ?>' fid='<?php echo htmlentities($v["pid"]); ?>' >
						  <td>
							<input type="checkbox" class="checkbox" name="id" value="<?php echo htmlentities($v['id']); ?>" lay-skin="primary">
						  </td>
						  <td><?php echo htmlentities($v["id"]); ?></td>
						  <td>
						  <?php if((!empty($v['next']))): ?>
							<i class="layui-icon x-show" status='true'>&#xe623;</i>
							<?php echo htmlentities($v["name"]); else: ?>
							<?php echo htmlentities($v["name"]); ?>
							<?php endif; ?>
						  </td>
						  <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
						  <td class="td-status">
						  <span class="layui-btn layui-btn-mini 
							<?php if(($v['state']['state'] == 0)): ?>layui-btn-warm<?php else: ?>layui-btn-normal<?php endif; ?>" onclick="member_stop(this,'<?php echo htmlentities($v['id']); ?>')"><?php echo htmlentities($v['state']['text']); ?></span>
						</td>
						  <td class="td-manage">
							<button class="layui-btn layui-btn layui-btn-xs"  onclick="xadmin.open('编辑','/novel-category-update/<?php echo htmlentities($v['id']); ?>')" ><i class="layui-icon">&#xe642;</i>编辑</button>
							<button class="layui-btn layui-btn-warm layui-btn-xs"  onclick="xadmin.open('添加子栏目','/novel-category-edit/<?php echo htmlentities($v['id']); ?>')" ><i class="layui-icon">&#xe642;</i>添加子栏目</button>
							<button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,<?php echo htmlentities($v['id']); ?>)" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
						  </td>
						</tr>
						<?php if((isset($v['next']))): foreach($v['next'] as $vv): ?>
						<tr cate-id='<?php echo htmlentities($vv["id"]); ?>' fid='<?php echo htmlentities($vv["pid"]); ?>' >
						  <td>
							<input type="checkbox" class="checkbox" name="id" value="<?php echo htmlentities($vv['id']); ?>" lay-skin="primary">
						  </td>
						  <td><?php echo htmlentities($vv["id"]); ?></td>
						  <td>&nbsp;&nbsp;&nbsp;&nbsp;
						  <?php if((!empty($vv['next']))): ?>
							<i class="layui-icon x-show" status='true'>&#xe623;</i>
							<?php echo htmlentities($vv["name"]); else: ?>
							<?php echo htmlentities($vv["name"]); ?>
							<?php endif; ?>
						  </td>
						  <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
						  <td class="td-status">
						  <span class="layui-btn layui-btn-mini 
							<?php if(($vv['state']['state'] == 0)): ?>layui-btn-warm<?php else: ?>layui-btn-normal<?php endif; ?>" onclick="member_stop(this,'<?php echo htmlentities($vv['id']); ?>')"><?php echo htmlentities($vv['state']['text']); ?></span>
						</td>
						  <td class="td-manage">
							<button class="layui-btn layui-btn layui-btn-xs"  onclick="xadmin.open('编辑','/novel-category-update/<?php echo htmlentities($vv['id']); ?>')" ><i class="layui-icon">&#xe642;</i>编辑</button>
							<button class="layui-btn layui-btn-warm layui-btn-xs"  onclick="xadmin.open('添加子栏目','/novel-category-edit/<?php echo htmlentities($vv['id']); ?>')" ><i class="layui-icon">&#xe642;</i>添加子栏目</button>
							<button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,<?php echo htmlentities($vv['id']); ?>)" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
						  </td>
						</tr>
						<?php if((isset($vv['next']))): foreach($vv['next'] as $vvv): ?>
						<tr cate-id='<?php echo htmlentities($vvv["id"]); ?>' fid='<?php echo htmlentities($vvv["pid"]); ?>' >
						  <td>
							<input type="checkbox" class="checkbox" name="id" value="<?php echo htmlentities($vvv['id']); ?>" lay-skin="primary">
						  </td>
						  <td><?php echo htmlentities($vvv["id"]); ?></td>
						  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <?php if((!empty($vvv['next']))): ?>
							<i class="layui-icon x-show" status='true'>&#xe623;</i>
							<?php echo htmlentities($vvv["name"]); else: ?>
							<?php echo htmlentities($vvv["name"]); ?>
							<?php endif; ?>
						  </td>
						  <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
						  <td class="td-status">
						  <span class="layui-btn layui-btn-mini 
							<?php if(($vvv['state']['state'] == 0)): ?>layui-btn-warm<?php else: ?>layui-btn-normal<?php endif; ?>" onclick="member_stop(this,'<?php echo htmlentities($vvv['id']); ?>')"><?php echo htmlentities($vvv['state']['text']); ?></span>
						</td>
						  <td class="td-manage">
							<button class="layui-btn layui-btn layui-btn-xs"  onclick="xadmin.open('编辑','/novel-category-update/<?php echo htmlentities($vvv['id']); ?>')" ><i class="layui-icon">&#xe642;</i>编辑</button>
							<button class="layui-btn layui-btn-warm layui-btn-xs"  onclick="xadmin.open('添加子栏目','/novel-category-edit/<?php echo htmlentities($vvv['id']); ?>')" ><i class="layui-icon">&#xe642;</i>添加子栏目</button>
							<button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,<?php echo htmlentities($vvv['id']); ?>)" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
						  </td>
						</tr>
						<?php endforeach; ?>
						<?php endif; ?>
						<?php endforeach; ?>
						<?php endif; ?>
						<?php endforeach; ?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
  layui.use(['form'], function(){
	form = layui.form;
	
	// 监听全选
	form.on('checkbox(checkall)', function(data){

	  if(data.elem.checked){
		$('tbody .checkbox').prop('checked',true);
	  }else{
		$('tbody .checkbox').prop('checked',false);
	  }
	  form.render('checkbox');
	}); 
	
  });
       /*停用*/
function member_stop(obj,id){
layer.confirm('确认隐藏吗？',function(index){
$.ajax({
type:"post",
url:'/novel-category-state',
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
	  console.log(id);
		  //发异步删除数据
		  $.ajax({
			type:"post",
			url:'/novel-category-edit/del',
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

  // 分类展开收起的分类的逻辑
  // 
  $(function(){
	$("tbody.x-cate tr[fid!='0']").hide();
	// 栏目多级显示效果
	$('.x-show').click(function () {
		if($(this).attr('status')=='true'){
			$(this).html('&#xe625;'); 
			$(this).attr('status','false');
			cateId = $(this).parents('tr').attr('cate-id');
			$("tbody tr[fid="+cateId+"]").show();
	   }else{
			cateIds = [];
			$(this).html('&#xe623;');
			$(this).attr('status','true');
			cateId = $(this).parents('tr').attr('cate-id');
			getCateId(cateId);
			for (var i in cateIds) {
				$("tbody tr[cate-id="+cateIds[i]+"]").hide().find('.x-show').html('&#xe623;').attr('status','true');
			}
	   }
	})
  })

  var cateIds = [];
  function getCateId(cateId) {
	  $("tbody tr[fid="+cateId+"]").each(function(index, el) {
		  id = $(el).attr('cate-id');
		  cateIds.push(id);
		  getCateId(id);
	  });
  }
  
  //批量删除
      function delAll (argument) {
        var ids = [];

        // 获取选中的id 
        $('tbody input').each(function(index, el) {
            if($(this).prop('checked')){
               ids.push($(this).val())
            }
        });
  console.log(ids)
        layer.confirm('确认要删除吗？'+ids.toString(),function(index){
            //捉到所有被选中的，发异步进行删除
			$.ajax({
					type:"post",
					url:'/novel-category-edit/del',
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