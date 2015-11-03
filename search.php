<?php

$wz=$_GET['type'];
$search = $_GET['search'];
function convertEncode ($str) {
	return 	mb_convert_encoding($str, "UTF-8", "GB2312");
}
function dangdang($keywords) {
	if (!$keywords) {
		return 0;
		# code...
	}
	//$keywords="java";//搜索关键词
	$keywords=mb_convert_encoding($keywords, "gb2312", "utf-8");
	$keywords=rawurlencode($keywords);
	$urls='http://search.dangdang.com/?key='.$keywords.'&category_path=01.00.00.00.00.00&type=01.00.00.00.00.00/';
	//echo $urls;
	$st=curl_init();
	curl_setopt($st, CURLOPT_URL, $urls);
	curl_setopt($st, CURLOPT_RETURNTRANSFER,1);//返回内容为字符串
	curl_setopt($st,CURLOPT_FOLLOWLOCATION,TRUE);
	//curl_setopt($st, CURLOPT_HEADER, 0); //设置不返回头信息
	curl_setopt($st,CURLOPT_MAXREDIRS,2);//设置重定向最大两次
	curl_setopt($st,CURLOPT_TIMEOUT,100);//等待时间不超过五秒
	$dl_page=curl_exec($st);
	$info_arr=curl_getinfo($st);
	//var_dump($info_arr);
	//mb_convert_encoding($str, 'utf-8', 'GBK,UTF-8,ASCII');
	preg_match_all("/<a title=.*/",$dl_page,$matches_all);
	//var_dump($matches_all);
	 mb_convert_encoding( $dl_page, 'utf-8','gb2312' );
	$num= count($matches_all[0]);

	for($count=0;$count<$num;$count++)
	{
		//echo $count.'<br>';
		//echo $matches_all[0][$count];
		//preg_match_all("/\btitle\b=\"([^\"]*)\"\s*\bclass\b/",$matches_all[0][$count],$matches_title);
		preg_match_all("/\btitle\b=\"([^\"]*)/",$matches_all[0][$count],$matches_title);
		
		$title = convertEncode($matches_title[1][0]);
		//var_dump($matches_title);
	
		preg_match_all("/\bhttp\b\:\/\/img.*\bjpg\b/",$matches_all[0][$count],$matches_img);
		$imgurl= $matches_img[0][0];

		preg_match_all("/\bhttp\b([^\"]*)/",$matches_all[0][$count],$matches_url);
		$url = $matches_url[0][0];

		preg_match_all("/\bhttp\b\:\/\/\bcomm\b([^\"]*)/",$matches_all[0][$count],$matches_plurl);
		preg_match_all("/<a\s*\bhref\b=\"([^\"]*)\"/",$matches_all[0][$count],$matches_plurl);
		//var_dump($matches_plurl);//评论url
		//echo($matches_plurl[0][0]);

		preg_match_all("/\bdetail\b\"\s*\>([^\<]*)\</",$matches_all[0][$count],$matches_jianjie);
		$jianjie= mb_convert_encoding($matches_jianjie[1][0], "UTF-8", "GB2312"); 
		//echo($matches_jianjie[1][0]);

		preg_match_all("/\&\byen\b\;\d+\.\d\d/",$matches_all[0][$count],$matches_price);
		preg_match_all("/\d+\.\d\d/",$matches_price[0][0],$matches_price);
		$price = $matches_price[0][0];
	
		//preg_match_all("/num\b\"\>\d*/",$matches_all[0][$count],$matches_pinglun);
		preg_match_all("/num:\d*\">\d*/",$matches_all[0][$count],$matches_pinglun);
		if (isset($matches_pinglun[0][0])) {
			preg_match_all("/\d+/",$matches_pinglun[0][0],$matches_pinglun);
		$pinglun = convertEncode($matches_pinglun[0][0]);
		}else{
			$pinglun='';
		}
		

		preg_match_all("/\btitle\b=\'([^\']*)\'/",$matches_all[0][$count],$matches_price);
		 $author = convertEncode($matches_price[1][0]);

echo '	<div class="row" style="padding-top:40px;">
			<div class="col-md-12 col-lg-12 ">
			<div class="col-md-2 col-lg-2 imgs pull-left">
				<img class="img-rounded img-responsive" src="'.$imgurl.'">
			</div>
				<div class="col-md-10 col-lg-10 pull-left">
					<h3> <a target="blank" href="'.$url.'"> '.$title.'</a></h3>
					<p >作者：<span class="text-warning">'.$author.'</span></p>
					<p>评论：'.$jianjie.'</p>
					<p  class="danger">价格：<span class="text-success">'.$price.'</span> 评论数：<span class="text-danger">'.$pinglun.'</span></p>
				</div>
			</div> <!-- /.col-lg-8 -->
			

		</div> <!-- /row --> <hr/>';

		
	}
}


//exit(0);

?>



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
    <style>
    .imgs{
    	padding-top: 20px;
    }
    .row .pull-left{
    	/*background-color: #ccc;*/
    }
    .row a{
    	text-decoration: none;
    }
    </style>
</head>

<body>

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
		//if($_GET['type'] == "video") {
		//	echo "<script>$('.option-video').addClass('h5-select');</script>";
		//} else {
			echo "<script>$('.option-book').addClass('h5-select');</script>";
		//}
	?>
	<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"3","bdPos":"right","bdTop":"56.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
	</script>

		<!-- Row of columns -->
	<div class="search-beach">
		<div class="col-lg-6"style="padding-left:0;padding-right:0;">
				<div class="col-lg-6" align="center">
				<img title="Z坐标" alt="Z坐标" src="images/logo.png" height="101" /><br /><br />
				<form action="search.php" > 
				<div class="input-group" align="center" style="width: 80%">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<?php echo  "图书"; ?><span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="index.php?type=book">图书</a></li>
							<li><a href="index.php?type=video">当当</a></li>
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
		</div> <!-- /.col-lg-6 -->
	</div> <!-- /.search-beach -->

	<div class="container" class="clearfix" style="min-height:500px;height:100%;">
	<?php dangdang($search);?>

	

		<footer>
			<hr>
			<center>
				<p>© Z坐标 2015</p>
			</center>
		</footer>
	</div> <!-- /container -->

</body>
</html>
