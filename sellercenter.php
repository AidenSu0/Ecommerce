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

$SQL = "select * from t_product where sellercode='".$_SESSION['userid']."'";
//echo $sql1; die();
$RS0 = mysql_query($SQL, $con);
//print_r(mysql_fetch_array($RS0));
?>

<HTML>
	<HEAD>
		<link rel="stylesheet" type="text/css" href="inputboxes.css" />
	</HEAD>
	<TITLE>��������</TITLE>
	<body style="background-color:darkred">
		<div class="main_header" >
			<ul>
				<li style="display:inline-block">
					<a href="mainpage.php">�̲Ĺ㳡</a>
				</li>
				<li style="display:inline-block">
					<a href="myTout.php">�������</a>
				</li>
				<li style="display:inline-block">
					<a href="checkOrder.php" >�����ɶ���</a>
				</li>
				<li style="display:inline-block">
					<a href="add_product.html">�����Ʒ</a>
				</li>
				<li style="display:inline-block;float:right;padding-right:60px" >
					<a href="logout.php">�˳���¼</a>
				</li>
			</ul>
		</div>
		<br/><br/>
		<table class="mytable" ID="OrderTable" border=1 width=100% cellpadding=0 cellspacing=1>
			<tr align=center>
				<td>��Ʒ����</td>
				<td>��Ʒ�۸�</td>
				<td>��Ʒ���</td>
				<td>��ƷͼƬ</td>
			</tr>
			<?php while($RS=mysql_fetch_array($RS0)){?>
			<tr align=center>
				<td><?php echo strval($RS["productname"])?></td>
				<td><?php echo strval($RS["price"])?></td>
				<td><?php echo strval($RS["stocknumber"])?></td>
				<td><?php echo "<img height=200px width=200px src=" . strval($RS["productimage"]).">"?></td>
				<td>
					<form id="modify_product" action="modifyProduct.php" method=post >
						<input type="hidden" name=productcode value=<?php echo $RS['productcode'] ?> />
						<input class="register-button" type=submit value="�޸���Ʒ" />
					</form>
					<form id="modify_product" action="deleteProduct.php" method=post >
						<input type="hidden" name=productcode value=<?php echo $RS['productcode'] ?> />
						<input class="register-button" type=submit value="ɾ����Ʒ" />
					</form>
				</td>
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
