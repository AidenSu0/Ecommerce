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

$SQL = "select * from t_order0 where orderid=".$_POST['orderid'];
//echo $sql1; die();
$RS0 = mysql_query($SQL, $con);
$RS=mysql_fetch_array($RS0);
//print_r(mysql_fetch_array($RS0));
?>

<html>
	<head>
		<title>��Ʒ�޸�</title>
		<!--script src="add_product.js"></script-->
		<script>
			function check_price()
			{
				var r = /^[+]?(0|([1-9]\d*))(\.\d+)?$/g;
				var domnumber=document.getElementById('price');
			
				if(!r.test(domnumber.value))
				{
					alert("������۸�");
					return false;
				}
				return true;
			}
		</script>
		<link rel="stylesheet" type="text/css" href="inputboxes.css" />
	</head>
	<body>
	<div class="main_header" >
			<ul>
				<li style="display:inline-block">
					<a href="mainpage.php">�̲Ĺ㳡</a>
				</li>
				<li style="display:inline-block">
					<a href="myTout.php">�������</a>
				</li>
				<li style="display:inline-block">
					<a href="add_product.html">�����Ʒ</a>
				</li>
				<li style="display:inline-block;float:right;padding-right:60px" >
					<a href="logout.php">�˳���¼</a>
				</li>
			</ul>
		</div>
		<table class="mytable" ID="OrderTable" border=1 width=100% cellpadding=0 cellspacing=1>
			<tr align=center>
				<td>������</td>
				<td>�����۸�</td>
				<td>��������</td>
				<td>��ƷͼƬ</td>
			</tr>
			<tr aligen=center>
				<td><?php echo $RS['orderid'] ?></td>
				<td><?php echo $RS['orderprice'] ?></td>
				<td><?php echo $RS['purchasenumber'] ?></td>
				<td><img height=200px width=200px src=<?php echo $RS['productimg'] ?> /></td>
			</tr>
		</table>
		<form action="confirmModifyPrice.php" method=post onsubmit="check_price()">
			<input class="search_input" type=text id=price name=price value=<?php echo $RS['orderprice'] ?> />
			<input type=hidden name=orderid value=<?php echo $RS['orderid'] ?> />
			<input class="register-button" type=submit value="�޸�" />
		</form>	
	</body>
</html>
<?php 
mysql_close($con);
$RS=NULL;
$Con =NULL;
?>