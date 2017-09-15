<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<head>
	<meta charset="UTF-8">
	<title>栏目管理</title>
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
	<style type="text/css">
		#category span{

		}
	</style>
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
							    <li>栏目管理</li>
							</ol>
						</div>
						<div class="row">
							<div class="row">
								<div class="col-md-1 pull-right">
									<a href="/index.php/Admin/Category/create" class="btn btn-success">新增</a>
								</div>
							</div>
							<div class="row" style="width:95%;">
							<?php echo ($data); ?>
								<div id="category" style="margin-left:36px;">
									<div class="row" style="height:25px;margin-top: 5 px;border-bottom:2px solid #666;">
										<span class="col-md-1">序号</span>
										<span class="col-md-5">分类名称</span>
										<span class="col-md-1">排序</span>
										<span class="col-md-1">是否导航</span>
										<span class="col-md-1">是否显示</span>
										<span class="col-md-1">新增子栏目</span>
										<span class="col-md-1">编辑</span>
										<span class="col-md-1">删除</span>
									</div>
									<div class="row" style="height:36px;margin-top: 10px;border-bottom:2px solid #666;">
										<span class="col-md-1">1</span>
										<span class="col-md-5">通知公告</span>
										<span class="col-md-1">1</span>
										<span class="col-md-1">否</span>
										<span class="col-md-1">是</span>
										<span class="col-md-1"><a href="/index.php/Admin/Category/create" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a></span>
										<span class="col-md-1"><a href="/index.php/Admin/Category/edit/id/<?php echo ($photo["id"]); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a></span>
										<span class="col-md-1"><a href="/index.php/Admin/Category/delete/id/<?php echo ($photo["id"]); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(function(){
		console.log($('#category'));
	});
</script>