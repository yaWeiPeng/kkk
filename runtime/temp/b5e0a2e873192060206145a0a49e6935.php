<?php /*a:5:{s:64:"/www/wwwroot/www.lilymin.com/application/index/view/chapter.html";i:1591068972;s:70:"/www/wwwroot/www.lilymin.com/application/index/view/public/header.html";i:1595663215;s:66:"/www/wwwroot/www.lilymin.com/application/index/view/public/js.html";i:1597042523;s:69:"/www/wwwroot/www.lilymin.com/application/index/view/public/login.html";i:1594369780;s:69:"/www/wwwroot/www.lilymin.com/application/index/view/public/share.html";i:1591069426;}*/ ?>
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

<script src="https://translate.google.cn/translate_a/element.js?cb=googleTranslateElementInit"></script>
<div id="google_translate_element" style="position:absolute;bottom:10px;right:10px;z-index:2000;opacity:0.7;width:200px;height:100px"></div>
<script>

delCookie("googtrans");
function delCookie(name) {
	var Days = 30;
	var exp = new Date();
	exp.setTime(exp.getTime() - Days * 24 * 60 * 60 * 30);

	//这里一定要注意，如果直接访问ip的话，不用注明域名domain
	//但访问的是域名例如www.baidu.com时，翻译插件的cookie同时存在于一级和二级域名中
	//即删除翻译cookie时要把domain=www.baidu.com和domain=.baidu.com两个cookie一起删除才行
	var domain = document.domain;
	var domainIsIp = false;
	var dd = domain.split(".");
	if(dd.length==4){
		domainIsIp=true;
	}
	document.cookie = name + "='';path=/;expires="+ exp.toUTCString();
	if(domainIsIp==false){
		domain="."+dd[1]+"."+dd[2];
		document.cookie = name + "='';domain="+domain+";expires="+exp.toGMTString()+";path=/";
	}
}
<?php if(isset($_GET['lang'])){?>

function googleTranslateElementInit() {
 
	new google.translate.TranslateElement(
		{
                //这个参数不起作用，看文章底部更新，翻译面板的语言
                //pageLanguage: 'zh-CN',
            //这个是你需要翻译的语言，比如你只需要翻译成越南和英语，这里就只写en,vi
			includedLanguages: 'en,zh-CN,hr,cs,da,nl,fr,de,el,iw,hu,ga,it,ja,ko,pt,ro,ru,sr,es,th,vi',
            //选择语言的样式，这个是面板，还有下拉框的样式，具体的记不到了，找不到api~~
			layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            //自动显示翻译横幅，就是翻译后顶部出现的那个，有点丑，这个属性没有用的话，请看文章底部的其他方法
			autoDisplay: false, 
			//还有些其他参数，由于原插件不再维护，找不到详细api了，将就了，实在不行直接上dom操作
		}, 
		'google_translate_element'//触发按钮的id
	);
 
}
var lang = "<?php echo isset($_GET['lang'])?$_GET['lang']:'auto'; ?>";
document.cookie = "googtrans = /auto/"+lang;

<?php } ?>
</script>
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

<style>
body{
	top:0px!important; 
    min-height: 0px!important;
}
.goog-te-banner-frame{
	display:none
}
</style>

	<style type="text/css">
		.fxbut{position: fixed;right: 50px;top: 120px;cursor: pointer;}
		.ewm{width: 200px;height: auto;position:fixed;left: 50%;top: 50%;transform: translate(-50%,-50%);padding: 5px;background: #fff;display: none;}
		.ewm img{width: 100%;}
		.ewm a{width: 100px;height: 34px;border: 0;background: #ccc;margin: 15px auto;display: block;cursor: pointer;text-align: center;line-height: 34px;}
	</style>
		
		
		<div class="fxbut"><i class="layui-icon layui-icon-share"></i>分享</div>
		<div class="ewm"><img src="" class="eimg"><a href="" class="addrss" download="二维码">下载</a></div>
		
	<script>
		
		var fxbut=$(".fxbut");
		fxbut.click(function(){
			$.ajax({
			url:"/qrcode",
			async:true,
			dataType:'JSON',
			success:function(result){
				var data = JSON.parse(result);
				console.log(data.data)
				$(".eimg").attr("src",data.data);
				$(".addrss").attr("href",data.data);
			}
			});
			$(".ewm").css("display","block")
		})
		
$(document).mouseup(function(e) {
		var _con = $('.ewm'); // 设置目标区域
		if (!_con.is(e.target) && _con.has(e.target).length === 0) {
			$(".ewm").css("display","none")
		}
	});
	
	</script>


<?php if((!empty($error_tips))): ?>
<?php echo htmlentities($error_tips); else: ?>
<p>标题：<?php echo htmlentities($novel_info['title']); ?></p>
<p>状态：<?php echo htmlentities($novel_info['novel_state']['text']); ?></p>
<p></p>
	<h1>小说章节</h1>
	<?php foreach($novel as $k=>$v): ?>
	<div style="height:40px"><a href="/chapter_content/<?php echo htmlentities($v['id']); ?>/<?php echo htmlentities($v['novel_id']); ?>"><?php echo htmlentities($v['title']); ?></a></div>
	<?php endforeach; ?>
	<?php echo $novel; ?>
<?php endif; ?>
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
</html>
