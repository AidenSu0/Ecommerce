<?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");

session_start();
if(!isset($_POST['productcode']))
{
	die("<script>javasript:top.location.href='mainpage.php'</script>");
}

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

$SQL="delete from t_order0 where productcode='".$_POST['productcode']."' and ispay='0'";
mysql_query($SQL,$con);
$SQL="delete from t_product where productcode='".$_POST['productcode']."'";
mysql_query($SQL,$con);
?>


<html>
<head>
	<title>买家付款</title>
</head>
	<body>
		<div >
			<p><?php echo "删除成功！点击";?><a href="sellercenter.php">这里</a><?php echo "返回！"?> </p>
		</div>
	</body>
</html>
