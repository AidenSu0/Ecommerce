<?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");

session_start();
if(!isset($_POST['orderid'])||$_SESSION['usertype']!='1')
{
	die("<script>javasript:top.location.href='mainpage.php'</script>");
}
$orderid=$_POST['orderid'];

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

$SQL="update t_order0 set orderprice=".$_POST['price']." where orderid=".$orderid;
mysql_query($SQL,$con);
?>


<html>
<head>
	<title>�޸ļ۸�</title>
</head>
	<body>
		<div >
			<p><?php echo "�۸��޸ĳɹ������";?><a href="checkOrder.php">����</a><?php echo "���أ�"?> </p>
		</div>
	</body>
</html>
