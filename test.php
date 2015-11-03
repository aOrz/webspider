    <?php  
	$time1= time();
     $ch = curl_init();  
     curl_setopt($ch, CURLOPT_URL, "http://book.douban.com/subject_search?search_text=php");  
     curl_setopt($ch, CURLOPT_HEADER, false);  
     //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把这行注释掉的话，就会直接输出  
     $result=curl_exec($ch);  
     curl_close($ch);  
	$time2= time();
echo "<script>alert({$time2}-{$time1});</script>";
?>  
