<?php /*a:4:{s:62:"/www/wwwroot/www.lilymin.com/application/index/view/index.html";i:1617175048;s:70:"/www/wwwroot/www.lilymin.com/application/index/view/public/header.html";i:1595663215;s:66:"/www/wwwroot/www.lilymin.com/application/index/view/public/js.html";i:1597042523;s:69:"/www/wwwroot/www.lilymin.com/application/index/view/public/login.html";i:1594369780;}*/ ?>
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
<!-- <h1>子域名</h1> -->
<!-- <a href="https://shop.lilymin.com/shop.php">https://shop.lilymin.com</a> -->
<!-- <a href="http://ebuycms.lilymin.com">ebuycms.lilymin.com</a> -->

<style type="text/css">
	.zh_box{position: fixed;right:100px;top: 100px;width:auto;}
	.zh_box button{display:block;
    height: 38px;
    line-height: 38px;
    padding: 0 18px;
    background-color: #009688;
    color: #fff;
    white-space: nowrap;
    text-align: center;
    font-size: 14px;
    border: none;
    border-radius: 2px;
    cursor: pointer;}
	.zh_box a{display:none;line-height: 32px;text-align: center;cursor: pointer;}
	.zh_box:hover a{display: block;}
</style>

<div class="zh_box">
<?php if((empty($user))): ?>
<button id="login">登陆账号</button>
<?php else: ?>
<div class="user_box">
<button><?php echo htmlentities($user['phone']); ?></button>
<a href="javascript:void(0);" id="history">小说浏览记录</a>
<a href="javascript:void(0);" id="collection">收藏记录</a>
<a href="javascript:void(0);" id="exit">退出</a>
</div>
<?php endif; ?>
</div>
<script>
$('#login').click(function(){
	layer.open({
		type: 2, 
		area: ['700px','400px'],
		scrollbar: false,
		resize: false,
		title: '登录',
		content: '/i-login'
	});
});

$('#history').click(function(){
	layer.open({
		type: 2, 
		area: ['700px','400px'],
		scrollbar: false,
		resize: false,
		title: '浏览记录',
		content: '/i-history'
	});
});

$('#collection').click(function(){
	layer.open({
		type: 2, 
		area: ['700px','400px'],
		scrollbar: false,
		resize: false,
		title: '收藏记录',
		content: '/i-collection'
	});
});

$('#exit').click(function(){
	$.ajax({
		type:"post",
		url:"/i-exit",
		success:function(data){
		var obj = eval('(' + data + ')');
			if(obj.code==1){
				layer.msg(obj.msg, {icon: 1});
				setTimeout(function () {after();},1000);
			}else{
				layer.msg(obj.msg, {icon: 2});
			}
		}
	});
});
function after(){
	location.reload();
}
</script>
<h1>小说书架</h1>
	<?php foreach($novel as $v): ?>
	<div style="height:40px"><a href="/chapter/<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['title']); ?></a></div>
	<?php endforeach; ?>
</body>
</html>
