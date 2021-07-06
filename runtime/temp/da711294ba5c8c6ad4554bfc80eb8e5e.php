<?php /*a:3:{s:69:"/www/wwwroot/www.lilymin.com/application/index/view/User/history.html";i:1597053058;s:70:"/www/wwwroot/www.lilymin.com/application/index/view/public/header.html";i:1595663215;s:66:"/www/wwwroot/www.lilymin.com/application/index/view/public/js.html";i:1597042523;}*/ ?>
<html>
	<head>
    <meta name="baidu-site-verification" content="W5dxvLJrfV" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title><?php if((!empty($title))): ?><?php echo htmlentities($title); else: ?>欢迎<?php endif; ?></title>
	
	<style>
	*{padding:0px;margin:0px;}
	html{font-size:62.5%;}
	body {font:normal 100% Arial,sans-serif;font-size:14px; font-size:1.4rem; } 
	.left{ width:30%; float:left} 
	.right{ width:70%; float:right;}
	</style>
 </head>
	
<link rel="stylesheet" href="/static/index/css/header.css">
<script type="text/javascript" src="/static/index/js/header.js"></script>

<script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>


<link rel="stylesheet" href="/static/index/layui/css/layui.css" media="all">
<script type="text/javascript" src="/static/index/layui/layui.js"></script>
<script type="text/javascript" src="/static/index/layui/layui.all.js"></script>



<link rel="stylesheet" href="/static/admin/css/xadmin.css"> <!--分页-->


<style>
.mosueimg{position: fixed;z-index:99;display:none;
</style>
<script>
//$(function(){
//	$("body").append("<img src='/static/c1.gif' class='mosueimg' style='width:100px;height:50px;'>");
//	$(".mosueimg").css({"left":event.clientX,"top":event.clientY})	
//})
//$(window).mousemove(function(){
//	$(".mosueimg").css({"display":"block","left":event.clientX+10,"top":event.clientY+10})
//})
</script>
<body>
<h1>浏览记录</h1>
<div class="layui-container"> 
<?php foreach($data as $v): ?>
  <div class="layui-row">
    <div class="layui-col-xs4">
      <?php echo htmlentities($v['novel_title']); ?>
    </div>
    <div class="layui-col-xs5">
      <a href="/chapter_content/<?php echo htmlentities($v['cid']); ?>/<?php echo htmlentities($v['nid']); ?>" target="_blank"><?php echo htmlentities($v['chapter_title']); ?></a>
    </div>
    <div class="layui-col-xs3">
      <?php echo htmlentities($v['update_time']); ?>
    </div>
  </div>
 <?php endforeach; ?>
</div>
</body>
</html>