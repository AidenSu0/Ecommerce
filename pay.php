<?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");

session_start();
if(!isset($_POST['orderid']))
{
	die("<script>javasript:top.location.href='mainpage.php'</script>");
}
$orderid=$_POST['orderid'];
$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

$SQL="update t_order0 set ispay=1 where orderid=".$orderid;
mysql_query($SQL,$con);
?>


<html>
<head>
	<title>��Ҹ���</title>
</head>
	<body>
		<div >
			<p><?php echo "����ɹ������";?><a href="mainpage.php">����</a><?php echo "���أ�"?> </p>
		</div>
	</body>
</html>