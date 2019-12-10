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
		die("<script>javasript:top.location.href='mainpage.php'</script>");
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
		$sql1="update t_product set productname='".$_POST['productname']."',price='".$_POST['productprice']."',stocknumber='".$_POST['productstocknumber']."' where productcode=".$_POST['productcode'];
	}
	$exts=explode(".",$file['name']);
	$ext=end($exts);
	$filename='./images2/'.$filename.'.'.$ext;
	if (!move_uploaded_file($file['tmp_name'], $filename))
	{
		$sql1="update t_product set productname='".$_POST['productname']."',price='".$_POST['productprice']."',stocknumber='".$_POST['productstocknumber']."' where productcode=".$_POST['productcode'];
	}
	else
	{
		$sql1="update t_product set productname='".$_POST['productname']."',price='".$_POST['productprice']."',stocknumber='".$_POST['productstocknumber']."',productimage='".$filename."' where productcode=".$_POST['productcode'];
	}
	//存储到数据库
	
	mysql_query($sql1);
	mysql_close($con);
	$SQL=NULL;
	$con=NULL;
?>


<html>
<head>
	<title>成功</title>
</head>
	<body>
		<div>
			<p>商品修改成功，点击<a href="sellercenter.php">这里</a>返回</p>
		</div>
	</body>
</html>