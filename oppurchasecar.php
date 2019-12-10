<?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");
session_start();
if (!isset($_SESSION['userid'])||$_SESSION['usertype']!='0'||!isset($_POST['checkedproduct']))
{
	die("<script>javasript:top.location.href='userlogin.html'</script>");
}

?>
<html>
<head>
	<title>下单</title>
</head>
	<body>
		<div >
		<?php

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");


$checkedproduct=$_POST['checkedproduct'];
$operate=$_POST['operate'];
$orderids=explode(',',$checkedproduct,1000000);

for($i=0;$i<count($orderids);$i++)
{
	if($operate==0)
	{
		$SQL="delete from purchasecar where orderid=".$orderids[$i];
		mysql_query($SQL, $con);
	}
	else if($operate==1)
	{
		date_default_timezone_set("Asia/Shanghai");
		$ordercode= date("ymdhis",time());
		$SQLxx="select * from purchasecar where orderid='".$orderids[$i]."'";
		$RRS0=mysql_query($SQLxx, $con);
		$RRS=mysql_fetch_array($RRS0);
		
		$SQL="select * from t_product where productcode='".$RRS['productcode']."'";
		$RS0=mysql_query($SQL, $con);
		$RS = mysql_fetch_array($RS0);
		if($RS['stocknumber']<$RRS['purchasenumber'])
		{
			?>
			<p>商品<?php echo $RS['productname'] ?>库存不足</p>
			<?php
			continue;
		}
		else
		{
			
			$productcode=$RRS['productcode'];
			$stocknumber=$RS['stocknumber']-$RRS['purchasenumber'];
			$SQL="update t_product set stocknumber=$stocknumber where productcode=".$RRS['productcode'];
			mysql_query($SQL, $con);
			$orderprice=$RRS['orderprice'];
			$SQL = 'insert into t_order0(ordercode,productcode,orderprice,productimg,purchasenumber,sellercode,address,userid,ispay) values';
			$SQL =$SQL."('".$ordercode."','".$productcode."',".$orderprice.",'".$RS['productimage']."',".$RRS['purchasenumber'].",'".$RS['sellercode']."','".$RRS['address']."','".$_SESSION['userid']."','0')";
			mysql_query($SQL, $con);
			$SQL="delete from purchasecar where orderid=".$orderids[$i];
			mysql_query($SQL, $con);
		}
	}
}
//echo $sql1; die();
//print_r(mysql_fetch_array($RS0));
?>
			<p><?php if($operate==1){ echo "订单已生成！点击<a href='myTout.php'>这里</a>前往付款！";} else { echo "删除成功！点击<a href='myTout.php'>返回</a>！";} ?> </p>
		</div>
	</body>
</html>