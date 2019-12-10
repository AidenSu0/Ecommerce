<?php
	header("Cache-Control: no-cache, post-check=0, pre-check=0");
	header("Content-type:text/html;charset=gb2312");
	session_start();
	if($_SESSION['usertype'] != "1")
	{
		die("<script>javasript:top.location.href='sellerlogin.html'</script>");
	}
	if(!isset($_FILES["uploadfile"]))
	{
		die("<script>javasript:top.location.href='add_product.html'</script>");
	}
	$file=$_FILES["uploadfile"];
	//将文件名设置为商品id
	$con = mysql_connect("localhost","root","sql");
    mysql_select_db("qingzhou", $con);
    mysql_query("set names gb2312");
	
	$sql="select max(productcode) from t_product";
	$max=mysql_query($sql);
	$max=mysql_result($max,0);
	$filename=strval($max+1);//等会儿再看这儿
	if($file['error']!=0)
	{
		echo '<p>文件上传失败，请重新上传</p>';
		sleep(2);
		die("<script>javasript:top.location.href='add_product.html'</script>");
		return;
	}
	$exts=explode(".",$file['name']);
	$ext=end($exts);
	$filename='./images2/'.$filename.'.'.$ext;
	if (!move_uploaded_file($file['tmp_name'], $filename))
	{
		echo '<p>文件上传失败，请重新上传</P>';
		sleep(2);
		die("<script>javasript:top.location.href='add_product.html'</script>");
		return;
	}
	
	//存储到数据库
	$sql1="insert into t_product (productname,sellercode,price,stocknumber,productimage) "; 
	$sql1=$sql1."values('".$_POST['productname']."','".$_SESSION['userid']."','".$_POST['productprice']."','".$_POST['productstocknumber']."','".$filename."')";
	mysql_query($sql1);
	mysql_close($con);
	$SQL=NULL;
	$con=NULL;
	
	echo "<p>新商品已入库，即将返回！</p>";
	sleep(2);
	header("location:sellercenter.php");
?>