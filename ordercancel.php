<?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");

session_start();
if(!isset($_POST['orderid'])||$_SESSION['usertype']!='0')
{
	die("<script>javasript:top.location.href='mainpage.php'</script>");
}
$orderid=$_POST['orderid'];

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

$SQL="select * from t_order0 where orderid='".$orderid."'";
$RS0=mysql_query($SQL,$con);
$RS=mysql_fetch_array($RS0);
$purchasenumber=$RS['purchasenumber'];
$SQL="select * from t_product where productcode=".$RS['productcode'];
$productcode=$RS['productcode'];
$RS0=mysql_query($SQL,$con);
$RS=mysql_fetch_array($RS0);
$stocknumber=$RS['stocknumber']+$purchasenumber;
$SQL="update t_product set stocknumber=".$stocknumber." where productcode=".$productcode;
mysql_query($SQL,$con);
$SQL="delete from t_order0 where orderid=".$orderid;
mysql_query($SQL,$con);
?>


<html>
<head>
	<title>买家付款</title>
</head>
	<body>
		<div >
			<p><?php echo "订单已取消！点击";?><a href="mainpage.php">这里</a><?php echo "返回！"?> </p>
		</div>
	</body>
</html>
