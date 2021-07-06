<?php /*a:1:{s:68:"/www/wwwroot/www.lilymin.com/application/admin/view/admin/login.html";i:1614765968;}*/ ?>
<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title><?=globSet('title')?></title>
	<link rel="icon" href="<?=globSet('ico')?>" type="image/x-icon"/>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/static/admin/css/font.css">
    <link rel="stylesheet" href="/static/admin/css/login.css">
	  <link rel="stylesheet" href="/static/admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message"><?=globSet('title')?></div>
        <div id="darkbannerwrap"></div>
        <form method="post" class="layui-form" >
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            layui.use('form', function(){
              var form = layui.form;
               //layer.msg('玩命卖萌中', function(){
                 //关闭后的操作
                 //});
              //监听提交
              form.on('submit(login)', function(data){
				$.ajax({
						type:"post",
						url:'/login/login',
						data:{data:data.field},
						success:function(data){
							var data = JSON.parse(data);
							if(data.code == 1){
								layer.msg(data.msg, {icon: 1});
							setTimeout(function () {
								location.href = data.url;
							},1000);
							}else{
								layer.msg(data.msg, {icon: 2});
							  }
						}
					});
                return false;
              });
            });
        })
    </script>
    <!-- 底部结束 -->
</body>
</html>