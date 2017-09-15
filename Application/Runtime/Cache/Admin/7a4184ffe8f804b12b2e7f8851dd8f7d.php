<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<head>
	<meta charset="UTF-8">
	<title>文章管理</title>
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
							    <li>文章管理</li>
							</ol>
						</div>
						<div class="row">
							<div class="row">
								<form class="form-inline" role="form" action="/index.php/Admin/Article/index" method="get">
									<div class="col-md-3">
										<div class="form-group">
											<div class=" col-sm-6">
												<select class="form-control" name="category_id" id="category_id">
													<option value="">请选择栏目</option>
													<?php if(is_array($categories)): foreach($categories as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
												</select>
											</div>	
											<div class=" col-sm-6">
												
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<div class=" col-sm-8">
												<select class="form-control" name="status" id="status">
													<option value="">是否显示</option>
													<option value="1">显示</option>
													<option value="0">不显示</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-group">
						                    <input type="text" name="qText" class="form-control" placeholder="请输入标题">
						                    <span class="input-group-btn">
						                        <input class="btn btn-default" type="submit" value="搜索">
						                    </span>
						                </div>
									</div>
								</form>
								<div class="col-md-1 pull-right">
									<a href="/index.php/Admin/Article/create" class="btn btn-success">新增</a>
								</div>
							</div>
							<table class="table table-striped">
							<thead>
							<tr>
							<th width="10px">#</th>
							<th>标题</th>
							<th>作者</th>
							<th>编辑者</th>
							<th>栏目</th>
							<th>是否显示</th>
							<th>更新日期</th>
							<th>点击数</th>
							<th>操作</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><tr>
										<td><input class="checkbox-batch" name="checkbox" type="checkbox" data-group="articles" data-id="" value="<?php echo ($article["id"]); ?>"></td>

										<td><?php echo ($article["title"]); ?></td>
										<td><?php echo ($article["author"]); ?></td>
										<td><?php echo ($article["editor"]); ?></td>
										<td><?php echo ($article["cname"]); ?></td>
										<td>
											<?php if(($article["status"]) == "1"): ?>显示
											<?php else: ?>
											不显示<?php endif; ?>
										</td>
										<td><?php echo ($article["update_at"]); ?></td>
										<td><?php echo ($article["click"]); ?></td>
										<td>
											<a href="/index.php/Admin/Article/edit/id/<?php echo ($article["id"]); ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
											<a href="/index.php/Admin/Article/delete/id/<?php echo ($article["id"]); ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
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
		
	</div>
</body>
</html>
<script>
	// InitRadio($("input[name='status']"),"<?php echo ($data["status"]); ?>");
	InitNav($('#left_nav li'), "<?php echo ($category); ?>");
	// InitCategory($('#category')[0].options,"<?php echo ($data["category"]); ?>");
	//InitSubCategory($('#category'),$('#sub_category'));
	checkAll("#checkall");
	batchDel('#batchDelBtn', '/index.php/Admin/Article/batchDel');
</script>