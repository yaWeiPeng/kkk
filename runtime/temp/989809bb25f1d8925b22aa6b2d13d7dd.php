<?php /*a:4:{s:64:"/www/wwwroot/www.lilymin.com/application/index/view/content.html";i:1594287592;s:70:"/www/wwwroot/www.lilymin.com/application/index/view/public/header.html";i:1595663215;s:66:"/www/wwwroot/www.lilymin.com/application/index/view/public/js.html";i:1597042523;s:69:"/www/wwwroot/www.lilymin.com/application/index/view/public/login.html";i:1594369780;}*/ ?>
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
<body onkeydown="return noNumbers(event)">
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
	<div style="position:fixed;right:20%;top:30%">
	<input id="auto" value="" type="number" min="0" placeholder="滚动速度"> <button onclick="begin()" id="begin">开始</button><button onclick="end()" id="end" disabled="disabled">暂停</button>
	<audio src="/static/山楂树之恋.mp3" controls="controls" style="width:100%" loop="loop" id="music"></audio>
	<button type="button" class="layui-btn" id="speech"><i class="layui-icon">&#xe652;</i> 语音读小说</button>
	
	<audio id="chapter" src=""></audio>
  </div>
  <!--进来首次加载-->
<div class="text">
	  <span id="title">
	  <?php echo htmlentities($title); ?>
	  </span>
	  <br>
	  <br>
	  <br>
	  <span id="content" style="font-size:21px">
		<?php echo $data['content']; ?>
		</span>
		<br>
		<br>
		<br>
		<?php if((!empty($prev))): ?>
		<input id="prev" value="上一章" type="submit" onclick="page(this.id)">
		<input id="prevpage" value="/chapter_content/<?php echo htmlentities($prev['id']); ?>/<?php echo htmlentities($nid); ?>" type="hidden">
		<?php endif; if((!empty($next))): ?>
		<input id="nex" value="下一章" type="submit" onclick="page(this.id)">
		<input id="nexpage" value="/chapter_content/<?php echo htmlentities($next['id']); ?>/<?php echo htmlentities($nid); ?>" type="hidden">
		<?php endif; ?>
		<br>
		<br>
		<br>
		<br>
</div>
  </body>
  
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
  <script>

var text = $('#content').html();
var pattern = /[\u4e00-\u9fa5]+(.*?)<br>/g;
var TextArr = text.match(pattern);
for(var i=0;i<TextArr.length;i++){
	TextArr[i] = TextArr[i].slice(0,-4);
}

//控制播放器
$("#speech").click(function(){
var audio = $('#chapter').get(0); 
$("#speech").html()
var audioText = $("#speech").html();
audioText = audioText.match(/[\u4e00-\u9fa5]+/);
console.log(audioText[0]);
if(audioText[0] == '暂停' || audioText[0] == '继续'){
	if(audio!==null){ 
		if(audio.paused){ 
			$("#speech").html('<i class="layui-icon">&#xe651;</i>暂停');
			audio.play();// 播放 
		}else{
			$("#speech").html('<i class="layui-icon">&#xe652;</i> 继续');
			audio.pause();// 暂停
		}
	} 
}else{
console.log(TextArr);

var j = 0
$.ajax({
	type:"get",
	url:'/speech',
	data:{data:TextArr[j]},
	success:function(data){
	var data = JSON.parse(data);
	  if(data.code == 1){
		//layer.msg(data.msg, {icon: 1});
		audio.src = data.data;
		//$('#chapter').attr('src',data.data);
		if(audio!==null){
console.log(audio);		
			if(audio.paused){
				audio.play();// 播放 
				audio.addEventListener('ended', function () { //加载数据
					//播放结束继续下一段
					console.log(audio.duration);
					if(j<TextArr.length){
						v(++j);
					}else{
						$("#speech").html('<i class="layui-icon">&#xe652;</i> 继续');
						audio.pause();// 暂停
					}
				});
			}
		} 
	  }
	}
});



	if(audioText[0] == '语音读小说' || audioText[0] == '继续'){
		$("#speech").html('<i class="layui-icon">&#xe651;</i>暂停');
	}else{
		$("#speech").html('<i class="layui-icon">&#xe652;</i> 继续');
	}
}})

//语音

function v(j){
//++j;
var audio = $('#chapter').get(0); 
if(j<TextArr.length){
	console.log(TextArr[j]);
	//v(j);
	$.ajax({
		type:"get",
		url:'/speech',
		data:{data:TextArr[j]},
		success:function(data){
		var data = JSON.parse(data);
		  if(data.code == 1){
			//layer.msg(data.msg, {icon: 1});
			audio.src = data.data;
			//return;
			if(audio!==null){
				if(audio.paused){ 
					audio.play();// 播放 
					//audio.addEventListener('ended', function () { //加载数据
						//播放结束继续下一段
					//	console.log(audio.duration);
					//	v(j);
					//});
				}
			} 
		  }
		}
	});
}
}

function page(val)
{
	var url;
    if(val == 'prev'){
		url = $('#prevpage').val();
	}
	if(val == 'nex'){
		url = $('#nexpage').val();
	}
	if(url != undefined){
		window.location.href=url
	}
}


function noNumbers(e)
{
    var keynum;
	var url;
	
    keynum = window.event ? e.keyCode : e.which;

	//上一页
	if(keynum == 37){
		url = $('#prevpage').val();
	}
	//下一页
	if(keynum == 39){
		url = $('#nexpage').val();
	}

	if(url != undefined){
		window.location.href=url
	}
}
//到底部自动加载
//获取滚动条当前的位置 
function getScrollTop() {
var scrollTop = 0;
if(document.documentElement && document.documentElement.scrollTop) {
	scrollTop = document.documentElement.scrollTop;
} else if(document.body) {
	scrollTop = document.body.scrollTop;
}
return scrollTop;
}
//获取当前可视范围的高度 
function getClientHeight() {
var clientHeight = 0;
if(document.body.clientHeight && document.documentElement.clientHeight) {
	clientHeight = Math.min(document.body.clientHeight, document.documentElement.clientHeight);
} else {
	clientHeight = Math.max(document.body.clientHeight, document.documentElement.clientHeight);
}
return clientHeight;
}
//获取文档完整的高度
function getScrollHeight(){
　　var scrollHeight = 0, bodyScrollHeight = 0, documentScrollHeight = 0;
　　if(document.body){
　　　　bodyScrollHeight = document.body.scrollHeight;
　　}
　　if(document.documentElement){
　　　　documentScrollHeight = document.documentElement.scrollHeight;
　　}
　　scrollHeight = (bodyScrollHeight - documentScrollHeight > 0) ? bodyScrollHeight : documentScrollHeight;
　　return scrollHeight;
}
//获取文档完整的高度 
	// function getScrollHeight() {
	 //   return Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
	 //}
//滚动事件触发
var auto_read = 0;
	 window.onscroll = function() {
	 auto_read = 1;
//加1的原因是移动端有1像素的偏差（这是在设置了容器不显示横向滚动条的情况下overflow-x: hidden,否则可能不止1像素、可能是4像素）
		if(getScrollTop() + getClientHeight() +1>= getScrollHeight()) {
		
		var num = 1;  //num == 1 表示可以加载下一章。避免重复请求
		if(num == 1){
			num = 0;
			//这里向后台进行数据请求（第一页数据就是1，第二页就是2，然后将请求回来的数组（处理成数组）拼接起来）
			var url = $('#nexpage').val();
			$.ajax({
			type:"get",
			url:url,
			data:{newurl:url},
			success:function(data){
			 //window.location.href="/text"
			  var data = JSON.parse(data);
			  console.log(data);
			  if(data.code == 1){
				  $('div[class=text]:last').after("<div class='text'><span id='title'>"+data.data.title+"</span><br><br><br><span id='content' style='font-size:21px'>"+data.data.content+"</span><br><br><br></div>");
				  //if(data.code == 1){
				  $('title').empty().html(data.data.title)
				  //$('#title').empty().html(data.data.title)
				  //$('#content').empty().html(data.data.content)
				  //$('#prevpage').val(data.data.prevpage)
				$('#nexpage').val('/chapter_content/'+ data.data.next + '/' + data.data.nid);
				auto_read = 0;
			  }else{
				layer.msg(data.msg, {icon: 2});
			  }
			  num = 1;
			}
		});
		}
		}
	 }
//自动阅读
var atuo;
function begin(){
	auto = setInterval("auto_process()",100);
	$('#begin').attr("disabled","disabled");
	$('#end').attr("disabled",false);
}
function end(){
	clearInterval(auto);
	$('#begin').attr("disabled",false);
	$('#end').attr("disabled","disabled");
}
function auto_process(){
//滚动速度
	var speed = $('#auto').val();
//当前高度
	var scrollTop1 = $(window).scrollTop();
//滚动后的高度
	var now = Number(scrollTop1) + Number(speed);
//赋值滚动条
	$("body").scrollTop(now);
}
</script>
</html>
