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
		echo '<p>�ļ��ϴ�ʧ�ܣ��������ϴ�</p>';
		sleep(2);
		die("<script>javasript:top.location.href='add_product.html'</script>");
		return;
	}
	$exts=explode(".",$file['name']);
	$ext=end($exts);
	$filename='./images2/'.$filename.'.'.$ext;
	if (!move_uploaded_file($file['tmp_name'], $filename))
	{
		echo '<p>�ļ��ϴ�ʧ�ܣ��������ϴ�</P>';
		sleep(2);
		die("<script>javasript:top.location.href='add_product.html'</script>");
		return;
	}
	
	//�洢�����ݿ�
	$sql1="insert into t_product (productname,sellercode,price,stocknumber,productimage) "; 
	$sql1=$sql1."values('".$_POST['productname']."','".$_SESSION['userid']."','".$_POST['productprice']."','".$_POST['productstocknumber']."','".$filename."')";
	mysql_query($sql1);
	mysql_close($con);
	$SQL=NULL;
	$con=NULL;
	
	echo "<p>����Ʒ����⣬�������أ�</p>";
	sleep(2);
	header("location:sellercenter.php");
?>