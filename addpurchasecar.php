<?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");
session_start();
if (!isset($_SESSION['userid'])||$_SESSION['usertype']!='0')
{
	die("<script>javasript:top.location.href='mainpage.php'</script>");
}

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

$number=$_POST['pnumber'];
$productcode=$_POST['productcode'];
$SQL="select * from t_product where productcode=".$productcode;
$RS0=mysql_query($SQL,$con);
$RS=mysql_fetch_array($RS0);
$price=$RS['price']*$number;
$SQL="insert into purchasecar(userid,orderprice,productcode,purchasenumber,productimg,address) values('".$_SESSION['userid']."','".$price."',".$productcode.",".$number.",'".$RS['productimage']."','".$_POST['paddress']."')";
mysql_query($SQL,$con);
?>


<html>
<head>
	<title>成功</title>
</head>
	<body>
		<div>
			<p>加入购物车成功，点击<a href="mainpage.php">这里</a>返回</p>
		</div>
	</body>
</html>

<?php 
mysql_close($con);
$RS=NULL;
$Con =NULL;
?>