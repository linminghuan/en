<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<head>
	<meta charset="UTF-8">
	<title>新增栏目</title>
	<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/Public/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/Css/common.css">
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="/Public/jquery/jquery-3.2.1.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
	<script src="/Public/jquery-validation/lib/jquery.js"></script>
	<script src="/Public/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="/Application/Common/Ueditor/ueditor.parse.js"></script>
	<script src="/Public/Admin/Js/common.js"></script>
</head>
</head>
<body>
	<div class="container-fluid">
		<div class="row" id="header">
	<div class="col-xs-8 col-sm-8 col-md-4 col-lg-2">
		<a href="/index.php/Home/Index/index.html"><h2>资环招生网站首页</h2></a>
	</div>
	<div class="col-xs-0 col-sm-0 col-md-6 col-lg-8""></div>
	<div class="col-xs-4 col-sm-4 col-md-2 col-lg-1 col-lg-offset-1">
		<span>admin</span>
		<a href="/index.php/Auth/quit" class="btn btn-danger">退出</a>
	</div>
</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2" id="left_nav">
	<ul class="nav nav-pills nav-stacked">
		<li id="l_index"><a href="/Admin/Index/index">首页</a></li>
		<li id="l_downfile"><a href="/Admin/Category/index">栏目管理</a></li>
		<li id="l_article"><a href="/Admin/Article/index">文章管理</a></li>
		<li id="l_photo"><a href="/Admin/Photo/index">图片管理</a></li>
		<li id="l_video"><a href="/Admin/Video/index">视频管理</a></li>
	</ul>
</div>
			<div class="col-xs-10 col-sm-10 col-md-9 col-lg-9">
				<div class="panel panel-default">
		   			<div class="panel-body">
						<div class="row">
							<ol class="breadcrumb">
							    <li><a href="/Admin/Index/index">首页</a></li>
							    <li><a href="/Admin/Category/index">栏目管理</a></li>
							    <li>新增栏目</li>
							</ol>
						</div>
						<div class="row">
							<form class="form-horizontal" name="category_form" role="form" method="post" action="/index.php/Admin/Category/insert"> 
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">栏目名</label>
								<div class="col-sm-10">
								<input type="text" class="form-control" id="name" name="name" placeholder="请输入栏目名">
								</div>
							</div>
							<div class="form-group">
								<label for="pid" class="col-sm-2 control-label">父级栏目</label>
								<div class="col-sm-10">
								<input type="text" class="form-control" id="pid" name="pid" value="<?php echo ($pid); ?>" style="display:none;">
								<input type="text" class="form-control" value="<?php echo ($pname); ?>" disabled="true">
								</div>
							</div>
							<div class="form-group">
								<label for="sort" class="col-sm-2 control-label">排序</label>
								<div class="col-sm-10">
								<input type="number" class="form-control" id="sort" name="sort" placeholder="请输入排序">
								</div>
							</div>
							<div class="form-group">
								<label for="homepage" class="col-sm-2 control-label">是否导航</label>
								<div class="col-sm-2">
									<label>
										<input type="radio" name="homepage" id="homepage1" value="1" checked> 显示
									</label>
									<label>
										<input type="radio" name="homepage" id="homepage2" value="0">不显示
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="status" class="col-sm-2 control-label">是否显示</label>
								<div class="col-sm-2">
									<label>
										<input type="radio" name="status" id="status1" value="1" checked> 显示
									</label>
									<label>
										<input type="radio" name="status" id="status2" value="0">不显示
									</label>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">保存</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</body>
</html>
<script type="text/javascript">
	// InitRadio($("input[name='status']"),"<?php echo ($data["status"]); ?>");
	InitNav($('#left_nav li'),"<?php echo ($category); ?>");
	//InitCategory($('#category')[0].options,"<?php echo ($data["category"]); ?>");
	$(function (){
		$("#category_form").validate({
	    	rules:{
	    		name:{
	    			required:true,
	    			maxlength:255
	    		},/*
	    		author:{
	    			required:true,
	    			maxlength:255
	    		},*/
	    		status:"required",
	    	},
	    	messages:{
	    		name:{
	    			required:"请填写图片描述",
	    			maxlength:255
	    		},/*
	    		author:{
	    			required:"请填写作者",
	    			maxlength:255
	    		},*/
	    		status:"请设置是否显示",
	    	},
	    });
	});
</script>