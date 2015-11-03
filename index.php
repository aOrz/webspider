<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="favicon.ico">

<title>Z坐标 - 教育资源聚合推荐系统</title>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- Custom styles for this page -->
<link href="css/style.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/ie10-viewport-bug-workaround.js"></script>
<script src="assets/ie-emulation-modes-warning.js"></script>

<!-- Bootstrap core JavaScript
   ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body height="100%">

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php?type=book"><span class="h5 option-book">图书</span></a>
				<!-- <a class="navbar-brand" href="index.php?type=video"><span class="h5 option-video">视频</span></a> -->
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<!-- <a class="navbar-brand navbar-right" href="#" onclick="return false" style="margin-left: 5px;">
					<button type="submit" class="btn btn-warning btn-login" onclick="alert('123');">登录</button>
				</a>  -->
				<a class="navbar-brand navbar-right" href="javascript:void(0);" style="margin-left: 5px;">
					<span class="glyphicon glyphicon-qrcode"></span>
				</a>
			</div> <!--/.navbar-collapse -->
		</div>
	</nav>
	<script src="js/navbar.js"></script>
	<?php
	//	if($_GET['type'] == "video") {
		//	echo "<script>$('.option-video').addClass('h5-select');</script>";
		//} else {
			echo "<script>$('.option-book').addClass('h5-select');</script>";
		//}
	?>
	<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"3","bdPos":"right","bdTop":"56.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
	</script>

	<div class="container" style="min-height:400px;height:100%;">
		<!-- Row of columns -->
		<div class="row">
			<div class="col-lg-6" align="right">
				<div class="qr-code">
					<img class="qr-code-img img-responsive" src="images/qr-code.png"/>
				</div>
			</div> <!-- /.col-lg-6 -->
		</div> <!-- /.row -->

		<div class="row">
			<div class="col-lg-6" align="center">
				<img title="Z坐标" alt="Z坐标" src="images/logo.png" height="101" /><br /><br />
				<form action="search.php" > 
				<div class="input-group" align="center" style="width: 70%">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<?php echo  "图书"; ?><span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="index.php?type=book">图书</a></li>
							<!-- <li><a href="index.php?type=video">当当</a></li> -->
						</ul>
					</div> <!-- /btn-group -->
					<?php
						if(!isset($_GET['type'])){
							echo "<input name='type' id='type' input value=\"dangdang\" type=\"text\" class=\"form-control\" style=\"display:none\">";
						}else{
							echo "<input name='type' id='type' value=\"";
							echo $_GET['type'];
							echo "\" type=\"text\" class=\"form-control\" style=\"display:none\">";
						}

					?>
					<input id="search" name="search" type="text" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div> <!-- /.input-group -->
				</form>
			</div> <!-- /.col-lg-6 -->
		</div> <!-- /.row -->
		
		<div class="row">
			<div class="col-lg-6" align="center">
				
			</div> <!-- /.col-lg-6 -->
		</div> <!-- /.row -->

		<footer>
			<hr>
			<center>
				<p>© Z坐标 2015</p>
			</center>
		</footer>
	</div> <!-- /.container -->

</body>
</html>
