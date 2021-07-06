<?php /*a:2:{s:60:"/www/wwwroot/www.lilymin.com/application/index/view/reg.html";i:1587109882;s:66:"/www/wwwroot/www.lilymin.com/application/index/view/public/js.html";i:1597042523;}*/ ?>
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
	body{
		background: url(/static/admin/images/bg.png) 0px -275px;
		background-size: 100%;
	}
	span{
		position:absolute;
		left: 50%;top: 40px;
		width: 500px;height: 280px;
	}
	h3{
		color: blue;
	}
	.layui-input{
		width: 90%;
	}
	</style>
</head>
<body>
<span style="margin-left:-250px">
    <div class="layui-form-item">
        <label class="layui-form-label"><h3>手机号码:</h3></label>
        <div class="layui-input-block">
          <input type="text" id="phone" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><h3>密码:</h3></label>
        <div class="layui-input-block">
          <input type="password" id="password" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><h3>重复密码:</h3></label>
        <div class="layui-input-block">
          <input type="password" id="re_password" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><h3>验证码:</h3></label>
        <div class="layui-input-block">
          <input type="text" id="code" placeholder="请输入" autocomplete="off" class="layui-input" style="width:60%;display:inline">
          <button type="submit" id="obtain_code" class="layui-btn" style="width:29%;display:inline;padding:0px">获取验证码</button>
        </div>
    </div>
    <button class="layui-btn layui-input-block" lay-submit id="login">登陆账号</button>
    <button class="layui-btn" lay-submit style="margin-left:110px" id="reg">注册</button>
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
    $('#login').click(function(){
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭 
        parent.layer.open({
            type: 2, 
            area: ['700px','400px'],
            scrollbar: false,
            resize: false,
            title: '登录',
            content: '/i-login'
          });
    });
    $("#reg").click(function(){
        var phone = $("#phone").val();
        var password = $("#password").val();
        var re_password = $("#re_password").val();
        var code = $("#code").val();
		if(phone=='' || password=='' || re_password=='' || code==''){
			layer.msg('请填写完整', {icon: 2});
			return false;
		}
        $.ajax({
            type:"post",
            url:"/i-doreg",
            data:{phone:phone,password:password,re_password:re_password,code:code},
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
    var wait = 60;
    function time() {
       if (wait == 0) {
           $("#obtain_code").attr("disabled",false);
           $("#obtain_code").text("重新获取验证码");
           wait = 60;
       } else {
           $("#obtain_code").attr("disabled", true);
           $("#obtain_code").text(wait+"秒后重新发送");
           wait--;
           setTimeout(function () {time($("#obtain_code"));},1000);
       }
    }
    function after(){
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭 
        parent.layer.open({
            type: 2, 
            area: ['700px','400px'],
            scrollbar: false,
            resize: false,
            title: '登录',
            content: '/i-login'
          });
    }
    $("#obtain_code").click(function(){
        var phone = $("#phone").val();
        if(phone == ''){
          layer.msg('手机号码不能为空', {icon: 2});return false;
        }else{
          $.ajax({
              type:"post",
              url:"/i-sms",
              data:{phone:phone},
              success:function(data){
			  console.log(data);
                  var obj = eval('(' + data + ')');
                  if(obj.code==000000){
                      time();
                      layer.msg('验证码发送成功', {icon: 1});
                  }else{
					  console.log(obj)
                      layer.msg(obj.msg, {icon: 2});
                      return false;
                  }
              }
          });
        }
    })
</script>
</html>