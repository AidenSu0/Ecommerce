<?php
session_start();
if(!isset($_SESSION['userid'])||$_SESSION['usertype']!='0')
{	
	
	$_SESSION['productcode']=$_POST['productcode'];
	$_SESSION['number']=$_POST['number'];
	$_SESSION['address']=$_POST['address'];
	$_SESSION['buying']=1;
	die("<script>javasript:top.location.href='userlogin.html'</script>");
}
if(isset($_SESSION['buying']))
{
	unset($_SESSION['buying']);
	$productcode=$_SESSION['productcode'];
	$number=$_SESSION['number'];
	$address=$_SESSION['address'];
}
else
{
	$productcode=$_POST['productcode'];
	$number=$_POST['number'];
	$address=$_POST['address'];
}
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");

//error_reporting(E_ALL);

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

date_default_timezone_set("Asia/Shanghai");
$ordercode= date("ymdhis",time());
//echo $ordercode; die();

$SQL="select * from t_product where productcode=$productcode";
$RS0=mysql_query($SQL, $con);
$RS = mysql_fetch_array($RS0);
$stocknumber=$RS['stocknumber']-$number;
$SQL="update t_product set stocknumber=$stocknumber where productcode=$productcode";
mysql_query($SQL, $con);
$orderprice=$RS['price']*$number;
$SQL = 'insert into t_order0(ordercode,productcode,orderprice,productimg,purchasenumber,sellercode,address,userid,ispay) values';
$SQL =$SQL."('".$ordercode."','".$productcode."',".$orderprice.",'".$RS['productimage']."',".$number.",'".$RS['sellercode']."','".$address."','".$_SESSION['userid']."','0')";
mysql_query($SQL, $con);
$SQL="select * from t_order0 where orderid=(select max(orderid) from t_order0)";
$RS0=mysql_query($SQL, $con);
$RS = mysql_fetch_array($RS0);
$orid=$RS['orderid'];
?>

<HTML>
	<HEAD>
	<link rel="stylesheet" type="text/css" href="inputboxes.css" />
	<TITLE>添加订单</TITLE>
	</HEAD>
	<BODY style="background:darkred">
		<div class="main_header" >
			<ul>
				<li style="display:inline-block">
					<a href="mainpage.php">教材广场</a>
				</li>
				<li style="display:inline-block">
					<a href="myTout.php">买家中心</a>
				</li>
				<li style="display:inline-block;float:right;padding-right:60px" >
					<a href="logout.php">退出登录</a>
				</li>
			</ul>
		</div>
<p></p>
<table class="mytable" ID="SrhTable" border=1 width=100% cellpadding=0 cellspacing=1>
<tr align=center>
<td>订单号</td>
<td>商品号</td>
<td>订单总额</td>
<td>购买数量</td>
<td>商品图片</td>
</tr>

<tr align=center>

<td><?php echo strval($RS['ordercode'])?></td>
<td><?php echo strval($RS['productcode'])?></td>
<td><?php echo strval($RS['orderprice'])?></td>
<td><?php echo strval($RS['purchasenumber'])?></td>
<td width=300px><?php echo "<img height=300px width=300px src=" . strval($RS["productimg"]).">"?></td>
</tr>

<?php 
mysql_close($con);
$RS=NULL;
$Con =NULL;
?>

</table>
<br/>
<form id=form1 name=form1 method=post action="pay.php">
	<input type=hidden name=orderid id=orderid value=<?php echo $orid;?> />
	<input class="register-button" style="background-color:darkgreen" type=submit value='购买' />
</form>
</html>
