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
	//���ļ�������Ϊ��Ʒid
	$con = mysql_connect("localhost","root","sql");
    mysql_select_db("qingzhou", $con);
    mysql_query("set names gb2312");
	
	$sql="select max(productcode) from t_product";
	$max=mysql_query($sql);
	$max=mysql_result($max,0);
	$filename=strval($max+1);//�Ȼ���ٿ����
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
	//�洢�����ݿ�
	
	mysql_query($sql1);
	mysql_close($con);
	$SQL=NULL;
	$con=NULL;
?>


<html>
<head>
	<title>�ɹ�</title>
</head>
	<body>
		<div>
			<p>��Ʒ�޸ĳɹ������<a href="sellercenter.php">����</a>����</p>
		</div>
	</body>
</html>