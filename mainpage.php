
<?php
session_start();
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

if(isset($_POST['keyword']))
	$productname = $_POST['keyword'];
else $productname='';
$SQL = "select * from t_product where productname like '%". $productname ."%'";
//echo $sql1; die();
$RS0 = mysql_query($SQL, $con);
//print_r(mysql_fetch_array($RS0));
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
	<!--link rel="stylesheet" type="text/css" href="mainpage.css" /--->
    <title>Tout</title>
	<link rel="stylesheet" type="text/css" href="inputboxes.css" />
	<script language=javascript>
		function detailhead(productcode)
		{
			document.getElementById("productcode").value=productcode;
			document.getElementById("sendclick").submit();
			return;
		}
		function confirmD()
		{
			
			var r=confirm("注销账号将会删除关于该账号的所有订单及入库商品，确认注销吗？");
			if(r)
			{
				return true;
			}
			else{
				return false;
			}
		}
	</script>
</head>
<body style="background:rgb(200,50,50)">
    <div class="main_header" >
        <ul>
            <li style="display:inline-block">
                <a href="myTout.php">个人中心</a>
            </li>
            <li style="display:inline-block">
                <a href="sellercenter.php">卖家中心</a>
            </li>
			<?php if(isset($_SESSION['userid'])){ ?>
			<li style="display:inline-block">
                <a href="modifyuser.php">修改资料</a> 
            </li>
			<li style="display:inline-block">
                <a href="destroyuser.php" onclick="return confirmD()">账号注销</a>
            </li>
			<?php } ?>
        </ul>
    </div>
	<div style="text-align:center;background:rgb(255,255,255)"><br/></div>
	<div style="text-align:center;background:rgb(255,255,255)">
		<form name="search_form" id="search_form" method="post">
			<input class="search_input" type="text" id="keyword" name="keyword" placeholder="关键词" />
			<input class="search_box" type="submit" value="搜索">
		</form>
	</div>
	<div style="text-align:center;background:rgb(255,255,255)"><br/></div>
	<div class="product_block" style="text-align:center;">
		<form id="sendclick" name="sendclick" action="productDetail.php" method="post">
			<input type=hidden id=productcode name=productcode value=0 />
		</form>
		<?php 
		$flag=0;
		while(1)
		{
			$i=0;
			 ?>
		<ul>
			<?php while($RS=mysql_fetch_array($RS0))
			{ 
				$i++;
			?>
			<div class="content_box">
				<div  onclick="detailhead(this.firstElementChild.value)">
					<input type="hidden" value=<?php echo $RS["productcode"] ?> />
					<div style="height:50px;line-height:40px;overflow:hidden"><?php echo strval($RS["productname"])?><br/></div>
					<?php echo "<img height=200px width=200px src=" . strval($RS["productimage"])." ><br/>"?>
					<span style="color:red;font-size:20px;font-weight:bold"><?php echo strval($RS["price"])?></span>
				</div>
			</div>
			<?php 
				if($i==3) break;} ?>
		</ul>
		<?php 
			if($RS==null) break;
			}
		mysql_close($con);
		$RS=NULL;
		$Con =NULL;
		?>
	</div>
</body>
</html>