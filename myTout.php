<?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");
session_start();
if (!isset($_SESSION['userid'])||$_SESSION['usertype']!='0')
{
	die("<script>javasript:top.location.href='userlogin.html'</script>");
}


$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

$SQL0 = "select * from  t_order0 where userid='".$_SESSION['userid']."' and ispay=0";
$SQL1 = "select * from  t_order0 where userid='".$_SESSION['userid']."' and ispay=1";
//echo $sql1; die();
$RS0 = mysql_query($SQL0, $con);
$RS1 = mysql_query($SQL1, $con);
//print_r(mysql_fetch_array($RS0));
?>

<HTML>
	<HEAD>
		<TITLE>您的订单</TITLE>
		<link rel="stylesheet" type="text/css" href="inputboxes.css" />
	</HEAD>
	
	<body style="background:rgb(200,50,50)">
		<div class="main_header" >
			<ul>
				<li style="display:inline-block">
					<a href="mainpage.php">教材广场</a>
				</li>
				<li style="display:inline-block">
					<a href="sellerlogin.html">卖家登录</a>
				</li>
				<li style="display:inline-block">
					<a href="purchasecar.php">购物车</a>
				</li>
				<li style="display:inline-block;float:right;padding-right:60px" >
					<a href="logout.php">退出登录</a>
				</li>
			</ul>
		</div>
		<div><br/></div>
		<div style="background:rgb(0,200,155)"></br></div>
		<div style="background:rgb(0,200,155);text-align:center">我的订单</div>
		<div style="background:rgb(0,200,155)"><br/></div>
		<table class="mytable" ID="OrderTable" border=1 width=100% cellpadding=0 cellspacing=1>
			<tr align=center>
				<td>商品图片</td>
				<td>订单编号</td>
				<td>订单价格</td>
				<td>购买数量</td>
			</tr>
			<?php 
			while(($RS = mysql_fetch_array($RS0))!=null)
			{
			?>

			<tr align=center>
				<td width=400px ><img height=200px width=200px src=<?php echo strval($RS["productimg"]) ?>></td>
				<td><?php echo strval($RS["ordercode"])?></td>
				<td><?php echo strval($RS["orderprice"])?></td>
				<td><?php echo strval($RS["purchasenumber"])?></td>
				<td>
					<form action="pay.php" method=post >
						<input type=hidden name=orderid value=<?php echo $RS['orderid']?> />
						<input class="register-button" type=submit value="支付" />
					</form>
					<form action="ordercancel.php" method=post >
						<input type=hidden name=orderid value=<?php echo $RS['orderid']?> />
						<input class="register-button" type=submit value="取消订单" />
					</form>
				</td>
			</tr>
			<?php
			}
			while(($RS = mysql_fetch_array($RS1))!=null)
			{
			?>
			<tr align=center>
				<td><img height=200px width=200px src=<?php echo strval($RS["productimg"]) ?>></td>
				<td><?php echo strval($RS["ordercode"])?></td>
				<td><?php echo strval($RS["orderprice"])?></td>
				<td><?php echo strval($RS["purchasenumber"])?></td>
			</tr>
			<?php 
			}
			mysql_close($con);
			$RS=NULL;
			$Con =NULL;
			?>

		</table>
	</body>
</html>
