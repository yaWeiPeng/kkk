<?php /*a:2:{s:62:"/www/wwwroot/www.lilymin.com/application/index/view/login.html";i:1614649352;s:66:"/www/wwwroot/www.lilymin.com/application/index/view/public/js.html";i:1597042523;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($title); ?></title>
	<style>
    *{
        margin:0px;
        padding:0px;
    }
    span{
        position:absolute;
        left: 50%;top: 42px;
        width: 500px;height: 200px;
    }
    h3{
        color: yellow;
    }
    .layui-input{
        width: 90%;
    }
  </style>
</head>
<body style="background: url(/static/admin/images/bg.png) no-repeat;background-size: 100%;">
<span style="margin-left:-250px">
    <div class="layui-form-item">
        <label class="layui-form-label"><h3>账号:</h3></label>
        <div class="layui-input-block" style="width: 280px;">
          <input type="text" id="phone" placeholder="请输入手机号码" autocomplete="off" class="layui-input" autofocus="autofocus">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><h3>密码:</h3></label>
        <div class="layui-input-block" style="width: 280px;">
          <input type="password" id="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block" style="margin-left:400px">
          <a href="javascript:0" id="forget_password">忘记密码</a>
        </div>
    </div>
    <button class="layui-btn layui-input-block" lay-submit id="do_login">登陆</button>
    <button class="layui-btn" lay-submit style="margin-left:110px" id="reg">注册账号</button>
</span>


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
$('#reg').click(function(){
	var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
	console.log(index)
	parent.layer.close(index); //再执行关闭 
	parent.layer.open({
		type: 2, 
		area: ['700px','400px'],
		scrollbar: false,
		resize: false,
		title: '短信注册账号',
		content: '/i-reg',
	});  
});
$("#do_login").click(function(){
        var phone = $("#phone").val();
        var password = $("#password").val();
		if(phone=='' || password==''){
			layer.msg('请填写完整', {icon: 2});
			return false;
		}
        $.ajax({
            type:"post",
            url:"/i-dologin",
            data:{phone:phone,password:password},
            success:function(data){
			var obj = eval('(' + data + ')');
                if(obj.code==1){
					layer.msg(obj.msg, {icon: 1});
					setTimeout(function () {after();},2000);
                }else{
					layer.msg(obj.msg, {icon: 2});
                }
            }
          });
          return false;
    });
document.onkeydown = function(e){
        var ev = document.all ? window.event : e;
        if(ev.keyCode==13) {
        var phone = $("#phone").val();
        var password = $("#password").val();
		if(phone=='' || password==''){
			layer.msg('请填写完整', {icon: 2});
			return false;
		}
        $.ajax({
            type:"post",
            url:"/i-dologin",
            data:{phone:phone,password:password},
            success:function(data){
			var obj = eval('(' + data + ')');
                if(obj.code==1){
					layer.msg(obj.msg, {icon: 1});
					setTimeout(function () {after();},2000);
                }else{
					layer.msg(obj.msg, {icon: 2});
                }
            }
          });
          return false;
        }
    }



function after(){
	var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
	parent.layer.close(index); //再执行关闭 
	parent.location.reload(index);
}
$('#forget_password').click(function(){
	var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
	parent.layer.close(index); //再执行关闭 
	parent.layer.open({
		type: 2, 
		area: ['500px','380px'],
		scrollbar: false,
		resize: false,
		title: '修改密码',
		content: '<?php echo url("/index/Index/forget_password"); ?>',
	});  
	return false;
});
</script>
<!--微信扫码登录-->
<!--
<div id="login_container"></div>
<script type="text/javascript" src="https://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
<script>
var obj = new WxLogin({
	self_redirect:true,
	id:"login_container", 
	appid: "wxd01bd7ab37537c33", 
	scope: "snsapi_login", 
	redirect_uri: "/",
	state: "",
	style: "",
	href: ""
});
</script>
-->
</html>