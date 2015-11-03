<?php
  //$time_start = microtime_float();
header("Content-type: text/html; charset=utf-8"); 
#当当网
$keywords='php　核心技术';
function zhuanma($str)
{
	return 	mb_convert_encoding($str, "UTF-8", "GB2312");
}
function dangdang ($keywords)
{
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
	mb_convert_encoding($str, 'utf-8', 'GBK,UTF-8,ASCII');
	preg_match_all("/<a title=.*/",$dl_page,$matches_all);
	//var_dump($matches_all);
	 mb_convert_encoding( $dl_page, 'utf-8','gb2312' );
	$num= count($matches_all[0]);
	for($count=0;$count<$num;$count++)
	{
		echo $count.'<br>';
		preg_match_all("/\btitle\b=\"([^\"]*)\"\s*\bclass\b/",$matches_all[0][$count],$matches_title);
		echo(zhuanma($matches_title[1][0]));
		echo '<br>';
		preg_match_all("/\bhttp\b\:\/\/img.*\bjpg\b/",$matches_all[0][$count],$matches_img);
		echo ('<img src="'.$matches_img[0][0].'">');
		echo '<br>';
		preg_match_all("/\bhttp\b([^A]*)\bA\b/",$matches_all[0][$count],$matches_url);
		echo($matches_url[0][0]);
		echo '<br>';
		preg_match_all("/\bhttp\b\:\/\/\bcomm\b([^\"]*)/",$matches_all[0][$count],$matches_plurl);
		//preg_match_all("/<a\s*\bhref\b=\"([^\"]*)\"/",$matches_all[0][$count],$matches_plurl);
		//var_dump($matches_plurl);//评论url
		echo($matches_plurl[0][0]);
		echo '<br>';
		preg_match_all("/\bdetail\b\"\s*\>([^\<]*)\</",$matches_all[0][$count],$matches_jianjie);
		echo mb_convert_encoding($matches_jianjie[1][0], "UTF-8", "GB2312"); 
		//echo($matches_jianjie[1][0]);
		echo '<br>';
		preg_match_all("/\&\byen\b\;\d+\.\d\d/",$matches_all[0][$count],$matches_price);
		preg_match_all("/\d+\.\d\d/",$matches_price[0][0],$matches_price);
		echo($matches_price[0][0]);
		//echo($matches_price[0][0]);
		echo '<br>';
		preg_match_all("/num\b\"\>\d*/",$matches_all[0][$count],$matches_pinglun);
		preg_match_all("/\d+/",$matches_pinglun[0][0],$matches_pinglun);
		echo(zhuanma($matches_pinglun[0][0]));
		echo '<br>';
		preg_match_all("/\btitle\b=\'([^\']*)\'/",$matches_all[0][$count],$matches_price);
		echo(zhuanma($matches_price[1][0]));
		echo '<br>';
	}
}
function amazon ($keywords) {
	//header("Content-type: text/html; charset=utf-8"); 
	$keywords=mb_convert_encoding($keywords, "gb2312", "utf-8");
	$keywords=urlencode($keywords);
	$urls='http://www.amazon.cn/s/ref=sr_il_ti_stripbooks?rh=n%3A658390051%2Ck%3Aphp&keywords='.$keywords.'&ie=UTF8&qid=1416017842&lo=stripbooks/';
	//echo $urls;
	$st=curl_init();
	curl_setopt($st, CURLOPT_URL, $urls);
	curl_setopt($st, CURLOPT_RETURNTRANSFER,1);//返回内容为字符串
	curl_setopt($st,CURLOPT_FOLLOWLOCATION,TRUE);
	//curl_setopt($st, CURLOPT_HEADER, 0); //设置不返回头信息
	curl_setopt($st,CURLOPT_MAXREDIRS,2);//设置重定向最大两次
	curl_setopt($st,CURLOPT_TIMEOUT,100);//等待时间不超过五秒
	//$header = FormatHeader($urls,'10.1.11.1');
	$dl_page=curl_exec($st);
	$info_arr=curl_getinfo($st);
	$num=0;
	//preg_match_all('/<div \s*\bid\b=\"\bresult_'.$num.'\b\"\s*\bclass\b=\"\bfstRow\b\s*\bprod\b\s*\bcelwidget\b\"\s*\bname\b=\".*\>([^\<\/\bdiv\b\>]*)\<\/\bdiv\b\>/',$dl_page,$matches_all);
	//preg_match_all("/\<\ba\b\s*\bhref\b=\"\bhttp\b.*\<\/\bdiv\b\>/",$dl_page,$matches_all);
	//echo $dl_page;
	preg_match_all("/\<\bli\b\s+\bid\b=\"result_[0-9]*.*([.\n]*)\\n.*\\n.*\\n[\\s\| ]*.*/",$dl_page,$matches_all);
	//var_dump($matches_all);
	$num= count($matches_all[0]);
	echo $num.'<br>';
	if($num>16)
	$num=16;
	for($count=0;$count<$num;$count++)
	{
		echo $count.'<br>';
		preg_match_all("/\<h2([^\>]*)\>([^\<]*)\</",$matches_all[0][$count],$matches_name);//书名
		echo $matches_name[2][0];
		echo '<br>';
		//var_dump($matches_name);
		preg_match_all("/\<a([^\>]*)\>/",$matches_all[0][$count],$matches_a);//获取ａ标签中的内容
		//var_dump($matches_a);
		preg_match_all("/\bhref\b=\"([^\"]*)\"/",$matches_a[0][0],$matches_ahref);
		echo $matches_ahref[1][0];                         //书的详情页
		echo '<br>';
		preg_match_all("/\bhref\b=\"([^\"]*)\"/",$matches_a[0][6],$matches_ahref);
		//var_dump($matches_ahref);
		echo $matches_ahref[1][0];                         //书的评论页面
		echo '<br>';
		preg_match_all("/\bsrc\b=\"([^\"]*)\"/",$matches_all[0][$count],$matches_img);//获取书籍图片地址
		echo $matches_img[1][0];
		echo ('<img src="'.$matches_img[1][0].'">');
		echo '<br>';
		preg_match_all("/\>\d+\<\/a\>/",$matches_all[0][$count],$matches_pl);//获取评论数量
		preg_match_all("/\d+/",$matches_pl[0][0],$matches_plnum);
		echo $matches_plnum[0][0];
		//var_dump( $matches_plnum);
		echo '<br>';
		preg_match_all("/\￥\d+\.\d+/",$matches_all[0][$count],$matches_pr);//获取价格
		preg_match_all("/\d+\.\d+/",$matches_pr[0][0],$matches_price);
		//var_dump($matches_price);
		echo $matches_price[0][0];
		preg_match_all("/\>([^\<]+)\</",$matches_all[0][$count],$matches_nc);
		echo $matches_nc[1][2];
		for($au=2;!strpos($matches_nc[1][$au],'、')===false;)
		{echo $matches_nc[1][++$au];}
		//var_dump($matches_nc);
		//echo $matches_all[0][0];
		//echo $matches_name[1][3];
		echo '<br>';
	}
	//echo $matches_all[0][0];
}
function jingdong ($keywords) {

$urls='http://search.jd.com/Search?keyword='.$keywords.'&enc=utf-8&book=y/';
//$header = FormatHeader($urls,'10.1.11.1');
//echo $urls;
$st=curl_init();
curl_setopt($st, CURLOPT_URL, $urls);
curl_setopt($st, CURLOPT_RETURNTRANSFER,1);//返回内容为字符串
curl_setopt($st,CURLOPT_FOLLOWLOCATION,TRUE);
//curl_setopt($st, CURLOPT_HEADER, 0); //设置不返回头信息
curl_setopt($st,CURLOPT_MAXREDIRS,2);//设置重定向最大两次
curl_setopt($st,CURLOPT_TIMEOUT,100);//等待时间不超过五秒
curl_setopt($st,CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)"); 
$dl_page=curl_exec($st);
$info_arr=curl_getinfo($st);
$num=0;
//preg_match_all('/<div \s*\bid\b=\"\bresult_'.$num.'\b\"\s*\bclass\b=\"\bfstRow\b\s*\bprod\b\s*\bcelwidget\b\"\s*\bname\b=\".*\>([^\<\/\bdiv\b\>]*)\<\/\bdiv\b\>/',$dl_page,$matches_all);
//preg_match_all("/\<\ba\b\s*\bhref\b=\"\bhttp\b.*\<\/\bdiv\b\>/",$dl_page,$matches_all);
//echo $dl_page;
$dl_page=preg_replace("/\\n/","",$dl_page); 
preg_match_all("/\<\\bdiv\b\s+\bclass\b=\"\bitem\b\"\>([^\!]*)/",$dl_page,$matches_all);
preg_match_all("/\bdata-lazyload\b=\"([^\"]*)\"/",$dl_page,$matches_allimg);
//var_dump($matches_allimg);
//var_dump($matches_all);
$num= count($matches_all[0]);
for($count=0;$count<$num;$count++)
{
	echo $count.'<br>';
preg_match_all("/\bp-name\b\"\>([^\>]*)\>([^\<]*)/",$matches_all[0][$count],$matches_a);//获取图书名ａ标签
echo $matches_a[2][0];
echo '<br>';
preg_match_all("/\bhref\b=\"([^\"]*)/",$matches_a[0][0],$matches_ahref);//图书链接
echo $matches_ahref[1][0];
echo '<br>';
$matches_pl=$matches_ahref[1][0].'#comment';//评论链接
echo $matches_pl;
echo '<br>';
echo $matches_allimg[1][$count];//图片地址
echo '<br>';
preg_match_all("/comment\"\>([^\<]*)/",$matches_all[0][$count],$matches_plnum);//评论数量
preg_match_all("/\d+/",$matches_plnum[0][0],$matches_plnum);
echo($matches_plnum[0][0]);
echo '<br>';
preg_match_all("/author=([^\>]*)\>([^\<]*)/",$matches_all[0][$count],$matches_aut);//作者名字
//var_dump($matches_aut);
$autnum= count($matches_aut[2]);
for($auti=0;$auti<$autnum;$auti++)
echo($matches_aut[2][$auti]);
echo '<br>';
preg_match_all("/\￥\d+\.\d+/",$matches_all[0][$count],$matches_price);//定价
preg_match_all("/\d+\.\d+/",$matches_price[0][$count],$matches_price);
//var_dump($matches_price);
//echo '<br>';
preg_match_all("/discount\"\>([^\<]*)/",$matches_all[0][$count],$matches_count);//折扣
preg_match_all("/\d+\.\d+/",$matches_count[0][0],$matches_count);
//var_dump($matches_count);
echo $matches_count[0][0]*$matches_price[0][0]/10;
echo '<br>';
//echo $dl_page;
}
}
function douban ($keywords) {
//header("Content-type: text/html; charset=utf-8"); 
$urls='http://book.douban.com/subject_search?search_text='.$keywords.'&cat=1001/';
//echo $urls;
//$header = FormatHeader($urls,'10.1.11.1');
$st=curl_init();
curl_setopt($st, CURLOPT_URL, $urls);
curl_setopt($st, CURLOPT_RETURNTRANSFER,1);//返回内容为字符串
curl_setopt($st,CURLOPT_FOLLOWLOCATION,TRUE);
//curl_setopt($st, CURLOPT_HEADER, 0); //设置不返回头信息
curl_setopt($st,CURLOPT_MAXREDIRS,2);//设置重定向最大两次
curl_setopt($st,CURLOPT_TIMEOUT,100);//等待时间不超过五秒
curl_setopt($st,CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)"); 
$dl_page=curl_exec($st);
$info_arr=curl_getinfo($st);
$num=0;
//preg_match_all('/<div \s*\bid\b=\"\bresult_'.$num.'\b\"\s*\bclass\b=\"\bfstRow\b\s*\bprod\b\s*\bcelwidget\b\"\s*\bname\b=\".*\>([^\<\/\bdiv\b\>]*)\<\/\bdiv\b\>/',$dl_page,$matches_all);
//preg_match_all("/\<\ba\b\s*\bhref\b=\"\bhttp\b.*\<\/\bdiv\b\>/",$dl_page,$matches_all);
//echo $dl_page;

preg_match_all("/\<a\s+href=\"http\:\/\/book\.douban\.com\/subject\/\d+\/\".*/",$dl_page,$matches_a);//获取书籍名称和地址
$dl_page=preg_replace("/\\n/","",$dl_page); //去除空行
preg_match_all("/pl\"\>([^\<]*)/",$dl_page,$matches_pl);
preg_match_all("/pub\"\>\s+([^\<]*)/",$dl_page,$matches_pub);
$num= count($matches_a[0]);
//var_dump($matches_a);
preg_match_all("/\<img\s+class=\"\"\s+src=\"([^\"]*)/",$dl_page,$matches_img);
for($count=0;$count<$num;$count++)
{
	echo $count.'<br>';
	preg_match_all("/href=\"([^\"]*)/",$matches_a[0][$count],$matches_href);
echo $matches_href[1][0];
echo '<br>';
preg_match_all("/title=\"([^\"]*)/",$matches_a[0][$count],$matches_name);
echo $matches_name[1][0];
echo '<br>';

echo $matches_img[1][$count];
echo '<br>';

preg_match("/([^\/]*)/",$matches_pub[1][$count],$matches_aut);
echo $matches_aut[0];
echo '<br>';

preg_match("/\d+/",$matches_pl[0][$count],$matches_plnum);
echo $matches_plnum[0];
echo '<br>';
}
}

//curl_close($st);
douban($keywords);
jingdong($keywords);
dangdang($keywords);
amazon($keywords);
?>
