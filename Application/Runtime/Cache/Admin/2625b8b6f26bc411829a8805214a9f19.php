<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<head>
	<meta charset="UTF-8">
	<title>图片管理</title>
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
		<li id="l_downfile"><a href="/Admin/Category/index">栏目管理</a></li>
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
							    <li>图片管理</li>
							</ol>
						</div>
						<div class="row">
							<div class="row">
								<form class="form-inline" role="form" action="/index.php/Admin/Photo/index" method="get">
									<!-- <div class="col-md-3">
										<div class="form-group">
											<div class=" col-sm-5">
												<select class="form-control" name="category">
													<option value="">图片类型</option>
													<option value="student">学生风采</option>
													<option value="banner">banner轮播</option>
													<option value="famous">名师风采</option>
												</select>
											</div>
										</div>
									</div> -->
									<div class="col-md-3">
										<div class="form-group">
											<div class=" col-sm-12">
												<select class="form-control" name="status" id="status">
													<option value="">是否显示</option>
													<!-- <option value="2">首页显示</option> -->
													<option value="1">显示</option>
													<option value="0">不显示</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class=" col-sm-8">
												<input type="submit" class="btn btn-default" value="查询">
											</div>
										</div>
									</div>
								</form>
								<div class="col-md-1 pull-right">
									<a href="/index.php/Admin/Photo/create" class="btn btn-success">新增</a>
								</div>
							</div>
							<table class="table table-striped">
							<thead>
							<tr>
							<th width="10px">#</th>
							<th>描述</th>
							<th>编辑者</th>
							<!-- <th>图片类型</th> -->
							<th>是否显示</th>
							<th>更新日期</th>
							<th>操作</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$photo): $mod = ($i % 2 );++$i;?><tr>
										<td><input class="checkbox-batch" name="checkbox" type="checkbox" data-group="photos" value="<?php echo ($photo["id"]); ?>"></td>

										<td><?php echo ($photo["discription"]); ?></td>
										<td><?php echo ($photo["editor"]); ?></td>
										<!-- <td>
											<?php switch($photo["category"]): case "student": ?>学生风采<?php break;?>
											    <?php case "banner": ?>banner轮播<?php break;?>
											    <?php case "famous": ?>名师风采<?php break; endswitch;?>
										</td> -->
										<td>
											<!-- <?php if($photo["status"] == 2): ?>首页显示
											<?php elseif($photo["status"] == 1): ?>显示
											<?php else: ?>不显示<?php endif; ?> -->
											<?php if($photo["status"] == 1): ?>显示
											<?php else: ?>不显示<?php endif; ?>
										</td>
										<td><?php echo ($photo["update_at"]); ?></td>
										<td>
											<a href="/index.php/Admin/Photo/edit/id/<?php echo ($photo["id"]); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
											<a href="/index.php/Admin/Photo/delete/id/<?php echo ($photo["id"]); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
										</td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</tr>
							</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-4">
								<input id="checkall" class="checkbox-batch" name="checkbox" type="checkbox" value="">
								<button id="batchDelBtn" class="btn btn-danger" type="submit">批量删除</button>
							</div>
							<div class="result page" id="page"><?php echo ($page); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="footer">
			
</div>
	</div>
</body>
</html>
<script type="text/javascript">
	// InitRadio($("input[name='status']"),"<?php echo ($data["status"]); ?>");
	InitNav($('#left_nav li'),"<?php echo ($category); ?>");
	checkAll("#checkall");
	batchDel('#batchDelBtn', '/index.php/Admin/Photo/batchDel');
	// InitCategory($('#category')[0].options,"<?php echo ($data["category"]); ?>");
	//批量删除
	
</script>