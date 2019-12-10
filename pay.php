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
	<title>买家付款</title>
</head>
	<body>
		<div >
			<p><?php echo "付款成功！点击";?><a href="mainpage.php">这里</a><?php echo "返回！"?> </p>
		</div>
	</body>
</html>
