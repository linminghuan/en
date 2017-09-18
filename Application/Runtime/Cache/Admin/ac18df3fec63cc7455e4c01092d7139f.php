<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<head>
	<meta charset="UTF-8">
	<title>新增文章</title>
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
							    <li><a href="/Admin/Article/index">文章管理</a></li>
							    <li>新增文章</li>
							</ol>
						</div>
						<div class="row">
							<form class="form-horizontal" id="article_form" role="form" method="post" action="/index.php/Admin/Article/insert"> 
							<div class="form-group">
								<label for="title" class="col-sm-2 control-label">标题</label>
								<div class="col-sm-10">
								<input type="text" class="form-control" id="title" name="title" placeholder="请输入标题">
								</div>
							</div>
							<div class="form-group">
								<label for="author" class="col-sm-2 control-label" name="author">作者</label>
								<div class="col-sm-10">
								<input type="text" class="form-control" id="author" name="author" placeholder="请输入作者">
								</div>
							</div>
							<div class="form-group">
								<label for="editor" class="col-sm-2 control-label" name="editor">编辑者</label>
								<div class="col-sm-10">
								<input type="text" class="form-control" id="editor" name="editor" placeholder="请输入编辑者">
								</div>
							</div>
							<div class="form-group">
								<label for="sort" class="col-sm-2 control-label" name="sort">排序</label>
								<div class="col-sm-10">
								<input type="text" class="form-control" id="sort" name="sort" placeholder="请输入排序">
								</div>
							</div>
							<div class="form-group">
								<label for="category_id" class="col-sm-2 control-label">文章类型</label>
								<div class=" col-sm-2">
									<select class="form-control" name="category_id" id="category_id">
									<option value="">请选择文章类型</option>
									<?php if(is_array($data)): foreach($data as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
									</select>
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
								<label class="col-sm-2 control-label">正文</label>
								<!-- 加载编辑器的容器 -->
							    <textarea id="ue_container" name="content" type="text/plain" class="col-sm-9" style="height:490px; overflow:auto; "></textarea>
							    <!-- 配置文件 -->
							    <script type="text/javascript" src="/Application/Common/Ueditor/ueditor.config.js"></script>
							    <!-- 编辑器源码文件 -->
							    <script type="text/javascript" src="/Application/Common/Ueditor/ueditor.all.js"></script>
							    <!-- 实例化编辑器 -->
							    <script type="text/javascript">
							        var ue = UE.getEditor('ue_container',{toolbars: [[
							        	'undo', 
							        	'redo', 
							        	'bold',
							        	'indent', //首行缩进
								        'italic', //斜体
								        'underline', //下划线
								        'strikethrough', //删除线
								        'formatmatch', //格式刷
								        'source', //源代码
								        'selectall', //全选
								        'removeformat', //清除格式
								        'cleardoc', //清空文档
								        'fontfamily', //字体
								        'fontsize', //字号
								        'paragraph', //段落格式
								        'simpleupload', //单图上传
								        'insertimage', //多图上传
								        'emotion', //表情
								        'searchreplace', //查询替换
								        'justifyleft', //居左对齐
								        'justifyright', //居右对齐
								        'justifycenter', //居中对齐
								        'justifyjustify', //两端对齐
								        'forecolor', //字体颜色
								        'backcolor', //背景色
							        	]],
							        	autoHeightEnabled: false,
							        	
							        });
							        uParse('.ue_container', {
									    rootPath: '../'
									});
							    </script>
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
		<div class="row" id="footer">
			
</div>
	</div>
</body>
</html>
<script type="text/javascript">
	/*InitRadio($("input[name='status']"),"<?php echo ($data["status"]); ?>");*/
	InitNav($('#left_nav li'), "<?php echo ($category); ?>");
	$(function (){
		$("#article_form").validate({
	    	rules:{
	    		title:{
	    			required:true,
	    			maxlength:255
	    		},/*
	    		author:{
	    			required:true,
	    			maxlength:255
	    		},*/
	    		category:"required",
	    		status:"required",
	    		content:"required",
	    	},
	    	messages:{
	    		title:{
	    			required:"请填写标题",
	    			maxlength:255
	    		},/*
	    		author:{
	    			required:"请填写作者",
	    			maxlength:255
	    		},*/
	    		category:"请选着文章的类别",
	    		status:"请设置是否显示",
	    		content:"请填写文章内容",
	    	},
	    });
	});

</script>