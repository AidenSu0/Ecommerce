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

$SQL0 = "select * from  purchasecar where userid='".$_SESSION['userid']."'";
//echo $sql1; die();
$RS0 = mysql_query($SQL0, $con);
//print_r(mysql_fetch_array($RS0));
?>

<HTML>
	<HEAD>
		<TITLE>您的订单</TITLE>
		<script>
			function deal()
			{
				var box=document.getElementsByName('checkedbox');
				
				for(var i=0;i<box.length;i++)
				{
					if(box[i].checked)
					{
						document.getElementById('checkedproduct').value+=String(box[i].value)+',';
					}
				}
				return true;
			}
		</script>
		
		<link rel="stylesheet" type="text/css" href="inputboxes.css" />
	</HEAD>
	
	<body style="background:rgb(200,50,50)">
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
		<div><br/></div>
		<div style="background:rgb(0,200,155)"></br></div>
		<div style="background:rgb(0,200,155);text-align:center">我的购物车</div>
		<div style="background:rgb(0,200,155)"><br/></div>
		<table class="mytable" ID="OrderTable" border=1 width=100% cellpadding=0 cellspacing=1>
			<tr align=center>
				<td>商品图片</td>
				<td>订单价格</td>
				<td>购买数量</td>
				<td>选择</td>
			</tr>
			<?php 
			while(($RS = mysql_fetch_array($RS0))!=null)
			{
			?>

			<tr align=center>
				<td width=400px ><img height=200px width=200px src=<?php echo strval($RS["productimg"]) ?>></td>
				<td><?php echo strval($RS["orderprice"])?></td>
				<td><?php echo strval($RS["purchasenumber"])?></td>
				<td><input type="checkbox" name=checkedbox value=<?php echo $RS['orderid'] ?> /></td>
			</tr>	
			<?php 
			}
			mysql_close($con);
			$RS=NULL;
			$Con =NULL;
			?>

		</table>
		<form action="oppurchasecar.php" method=post onsubmit="return deal()">
			<input type=hidden value='' id=checkedproduct name=checkedproduct />
			<input type=hidden value='' id=operate name=operate />
			<input class="register-button" style="background-color:darkgreen" type=submit value="删除" onclick="javascript:document.getElementById('operate').value=0" />
			<input class="register-button" style="background-color:darkgreen" type=submit value="下单" onclick="javascript:document.getElementById('operate').value=1" />
		</form>
	</body>
</html>
