 <?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");
session_start();
if (!isset($_SESSION['userid']))
{
	die("<script>javasript:top.location.href='mainpage.php'</script>");
}

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

if($_SESSION['usertype']=='0')
{
	$SQL="delete from php_admin where userid='".$_SESSION['userid']."' and usertype='0'";
	mysql_query($SQL, $con);
	$SQL="select * from t_order0 where userid='".$_SESSION['userid']."'";
	$RS0=mysql_query($SQL, $con);
	while($RS=mysql_fetch_array($RS0))
	{
		if($RS['ispay']==0)
		{
			$SQL1="select * from t_product where productcode=".$RS['productcode'];
			$RS3=mysql_query($SQL1, $con);
			$RSS=mysql_fetch_array($RS3);
			$stnumber=$RS['purchasenumber']+$RSS['stocknumber'];
			$SQL2="update t_product set stocknumber=".$stnumber." where productcode=".$RS['productcode'];
			mysql_query($SQL2, $con);
		}
	}
	$SQL="delete from t_order0 where userid='".$_SESSION['userid']."'";
	mysql_query($SQL, $con);
	$SQL="delete from purchasecar where userid='".$_SESSION['userid']."'";
	mysql_query($SQL, $con);
}
else if($_SESSION['usertype']=='1')
{
	$SQL="delete from php_admin where userid='".$_SESSION['userid']."' and usertype='1'";
	mysql_query($SQL, $con);
	$SQL="delete from t_product where sellercode='".$_SESSION['userid']."'";
	mysql_query($SQL, $con);
	$SQL="select * from t_order0 where sellercode='".$_SESSION['userid']."'";
	$RS0=mysql_query($SQL, $con);
	while($RS=mysql_fetch_array($RS0))
	{
		if($RS['ispay']==0)
		{
			$SQL="delete from t_order0 where sellercode='".$_SESSION['userid']."'";
			mysql_query($SQL, $con);
		}
	}
}
header("Location:logout.php");
?>


<html>
<head>
	<title>账户注销</title>
</head>
	<body>
		<div >
			<p><?php echo "账户已注销！点击";?><a href="mainpage.php">这里</a><?php echo "返回！"?> </p>
		</div>
	</body>
</html>

<?php 
mysql_close($con);
$RS=NULL;
$Con =NULL;
?>