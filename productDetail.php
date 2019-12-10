
<?php
session_start();
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

if(!isset($_POST['productcode']))
{	
	die("<script>javasript:top.location.href='mainpage.php'</script>");
}
$productcode=$_POST['productcode'];
$SQL = "select * from t_product where productcode=".$productcode;

$RS0 = mysql_query($SQL, $con);
$RS=mysql_fetch_array($RS0);
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>商品详情</title>
	<style>
	</style>
	<script>
		function check_number()
		{
			var r = /^\+?[1-9][0-9]*$/;
			var domnumber=document.getElementById('number');
			var domstock=document.getElementById('stocknumber');
			
			if(!r.test(domnumber.value))
			{
				alert("请输入购买数量！");
				return false;
			}
			else if(domnumber.value - domstock.innerHTML >0){
				alert("库存不足，请减少购买量！");
				return false;
			}
			return true;
		}
		function copy()
		{
			document.getElementById('pnumber').value=document.getElementById('number').value;
			document.getElementById('paddress').value=document.getElementById('address').value;
			return true;
		}
	</script>
	<link rel="stylesheet" type="text/css" href="inputboxes.css" />
</head>
<body style="background:pink">
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
    <div style="text-align:center">
		<div>
			<img height=300px width=300px src=<?php echo strval($RS['productimage']) ?>>
		</div>
		<div>
			<span style="font-size:20px;font-weight:bold">商品描述：<?php echo strval($RS['productname'])?><br/></span>
			<span style="color:red;font-size:20px;font-weight:bold">教材价格：<?php echo strval($RS['price'])?><br/></span>
			<span style="font-size:20px;font-weight:bold" id='stocknumber'>教材库存：<?php echo strval($RS['stocknumber'])?></span>
		</div>
		<br/><br/>
		<form id="orderform" action="addorder.php" method="post" onsubmit="return check_number()">
			<label for="number">购买数量：</label><input class="search_input" type="text" id="number" name=number onkeyup="copy()" onblur="copy()"/>
			<input name=productcode value=<?php echo $productcode ?> type=hidden>
			<label for="address">收货地址：</label><input class="search_input" type=text name=address id=address onkeyup="copy()" onblur="copy()"/>
			<br/><br/><br/><input type="submit" class="register-button" style="float:left;margin-left:30%" value="购买">
		</form>
		<form id="carform" action="addpurchasecar.php" method="post" onsubmit="return check_number()">
			<input type=hidden id="pnumber" name=pnumber value="" />
			<input type=hidden id="paddress" name=paddress value="" />
			<input type=hidden name=productcode value=<?php echo $productcode ?> />
			<input type="submit" class="register-button" value="加入购物车">
		</form>
	</div>
</body>
</html>

<?php
mysql_close($con);
$RS=NULL;
$Con =NULL;
?>