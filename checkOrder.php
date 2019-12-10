 <?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");
session_start();
if (!isset($_SESSION['userid'])||$_SESSION['usertype']!='1')
{
	die("<script>javasript:top.location.href='sellerlogin.html'</script>");
}

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

$SQL = "select * from t_order0 where sellercode='".$_SESSION['userid']."' and ispay=0";
//echo $sql1; die();
$RS0 = mysql_query($SQL, $con);
//print_r(mysql_fetch_array($RS0));
?>

<HTML>
	<HEAD>
		<link rel="stylesheet" type="text/css" href="inputboxes.css" />
	</HEAD>
	<TITLE>订单中心</TITLE>
	<body>
		<div class="main_header" >
			<ul>
				<li style="display:inline-block">
					<a href="mainpage.php">教材广场</a>
				</li>
				<li style="display:inline-block">
					<a href="myTout.php">买家中心</a>
				</li>
				<li style="display:inline-block">
					<a href="add_product.html">添加商品</a>
				</li>
				<li style="display:inline-block;float:right;padding-right:60px" >
					<a href="logout.php">退出登录</a>
				</li>
			</ul>
		</div>
		<br/><br/>
		<table class="mytable" ID="OrderTable" border=1 width=100% cellpadding=0 cellspacing=1>
			<tr align=center>
				<td>商品图片</td>
				<td>商品总价</td>
				<td>购买数量</td>
				<td>配送地址</td>
			</tr>
			<?php while($RS=mysql_fetch_array($RS0)){?>
			<tr align=cneter>
				<td width=200px><?php echo "<img height=200px width=200px src=" . strval($RS["productimg"]).">"?></td>
				<td><?php echo strval($RS["orderprice"])?></td>
				<td><?php echo strval($RS["purchasenumber"])?></td>
				<td><?php echo strval($RS["address"])?></td>
				<?php if($RS['ispay']=='0') 
				{ ?>
				<td>
					<form id="modify_product" action="modifyprice.php" method=post >
						<input type="hidden" name=orderid value=<?php echo $RS['orderid'] ?> />
						<input type=submit class="register-button" value="修改价格" />
					</form>
				</td>
				<?php }?>
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
