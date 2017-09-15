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
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row" id="header">
	<div class="col-xs-8 col-sm-8 col-md-4 col-lg-2">
		<a href="/index.php/Home/Index/index.html"><h2>资环英文网站首页</h2></a>
	</div>
	<div class="col-xs-0 col-sm-0 col-md-6 col-lg-8""></div>
	<div class="col-xs-4 col-sm-4 col-md-2 col-lg-1 col-lg-offset-1">
		<span>当前用户：<?php echo $_SESSION['name']; ?></span>
		<a href="/index.php/Auth/quit" class="btn btn-danger">退出</a>
	</div>
</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2" id="left_nav">
	<ul class="nav nav-pills nav-stacked">
		<li id="l_index"><a href="/Admin/Index/index">首页</a></li>
		<li id="l_category"><a href="/Admin/Category/index">栏目管理</a></li>
		<li id="l_article"><a href="/Admin/Article/index">文章管理</a></li>
		<li id="l_photo"><a href="/Admin/Photo/index">图片管理</a></li>
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
								<div id="category" style="margin-left:36px;">
									<div class="row" style="height:25px;margin-top: 5 px;border-bottom:2px solid #666;">
										<span class="col-xs-1">序号</span>
										<span class="col-xs-3">分类名称</span>
										<span class="col-xs-1">排序</span>
										<div class="col-xs-3">
											<span class="col-xs-6">是否导航</span>
											<span class="col-xs-6">是否显示</span>
										</div>
										<div class="col-xs-4">
											<span class="col-xs-6">新增子栏目</span>
											<span class="col-xs-3">编辑</span>
											<span class="col-xs-3">删除</span>
										</div>
									</div>
									<?php
 rend($data); ?>
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
	
</script>
<?php
 function rend($params) { rendCategory($params); } function rendCategory($params, $t = -10) { $translate = ['是', '否']; foreach($params as $key => $value){ $tmp = 'margin-left:'.$t.'px;'; echo "<div class='row' style='height:36px;".$tmp."margin-top: 10px;border-bottom:2px solid #20D181;border-left: 1px solid #20D181;'>"; echo "<span class='col-xs-1'>".$value['id']."</span>"; echo "<span class='col-xs-3'>".$value['name']."</span>"; echo "<span class='col-xs-1'>".$value['sort']."</span>"; echo "<div class='col-xs-3'>"; echo "<span class='col-xs-6'>".$translate[$value['homepage']]."</span>"; echo "<span class='col-xs-6'>".$translate[$value['status']]."</span>"; echo '</div>'; echo "<div class='col-xs-4'>"; echo "<span class='col-xs-6'><a href='/index.php/Admin/Category/create/pid/".$value['id']."' class='btn btn-success btn-xs'><i class='fa fa-plus'></i></a></span>"; echo "<span class='col-xs-3'><a href='/index.php/Admin/Category/edit/pid/".$value['pid']."/id/".$value['id']."' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a></span>"; echo "<span class='col-xs-3'><a href='/index.php/Admin/Category/delete/pid/".$value['pid']."/id/".$value['id']."' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></span>"; echo '</div>'; echo '</div>'; if(null != $value['next']){ $t += 20; rendCategory($value['next'], $t); } $t = -10; } } ?>