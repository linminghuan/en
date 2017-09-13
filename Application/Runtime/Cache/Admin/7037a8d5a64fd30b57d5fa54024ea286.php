<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登陆</title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="/Public/jquery/jquery-3.2.1.min.js"></script>
	 
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
	<script src="/Public/jquery-validation/lib/jquery.js"></script>
	<script src="/Public/jquery-validation/dist/jquery.validate.min.js"></script>
</head>
<body>
	<div class="container fluid">
		<div class="panel panel-default">
		    <div class="panel-body">
			    <h2 class="text-left col-sm-offset-2">资源环境招生网后台登陆</h2>
		    	<form class="form-horizontal" role="form" action="/index.php/Auth/login" id="login" method="post">
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">用户名</label>
					<div class="col-sm-6">
					<input type="text" class="form-control" id="name" name="name" placeholder="请输入用户名">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">密码</label>
					<div class="col-sm-6">
					<input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-6">
					<button type="submit" class="btn btn-default">登录</button>
					</div>
				</div>
				</form>
		    </div>
		</div>
	</div>
</body>
</html>
<script>
	$("#login").validate({
    	rules:{
    		name:{
	    			required:true,
	    			maxlength:255
	    		},
    		password:{
	    			required:true,
	    			maxlength:255
	    		}
    	},
    	messages:{
    		name:"请输入用户名",
    		password:"请输入密码",
    	},
    });
</script>