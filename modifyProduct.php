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

$SQL = "select * from t_product where productcode=".$_POST['productcode'];
//echo $sql1; die();
$RS0 = mysql_query($SQL, $con);
$RS=mysql_fetch_array($RS0);
//print_r(mysql_fetch_array($RS0));
?>

<html>
	<head>
		<title>商品修改</title>
		<script src="add_product.js"></script>
		<link rel="stylesheet" type="text/css" href="inputboxes.css" />
	</head>
	<body style="background-color:darkred">
		<div class="main_header" >
			<ul>
				<li style="display:inline-block">
					<a href="mainpage.php">教材广场</a>
				</li>
				<li style="display:inline-block">
					<a href="sellercenter.php">卖家中心</a>
				</li>
				<li style="display:inline-block;float:right;padding-right:60px" >
					<a href="logout.php">退出登录</a>
				</li>
			</ul>
		</div>
	<div class="register-box" style="top:100px;right:50%" >
		<form id="form_addProduct" name="form_addProduct" method="post" enctype="multipart/form-data" action="confirmModifyProduct.php" onsubmit="return check_product()">
			<p style="text-align:left;font-weight:bold;color:black">商品名称：</p>
			<input class="register-input" type="text" id="productname" name="productname" value=<?php echo $RS['productname']?> placeholder="商品名称"/>
			<p style="text-align:left;font-weight:bold;color:black">商品价格：</p>
			<input class="register-input" type="text" id="productprice" name="productprice" value=<?php echo $RS['price']?> placeholder="商品价格" />
			<p style="text-align:left;font-weight:bold;color:black">商品库存：</p>
			<input class="register-input" type="text" id="productstocknumber" name="productstocknumber" value=<?php echo $RS['stocknumber'] ?> placeholder="商品库存" />
			<input type="hidden" id="imgname" name="imgname" />
			<input type="hidden" name=productcode value=<?php echo $_POST['productcode'] ?> />
			<p style="text-align:left;font-weight:bold;color:black">商品原图：</p>
			<img id=img height=200px width=200px id="orignalview" src=<?php echo $RS['productimage'] ?> />
			<p style="text-align:left;font-weight:bold;color:black">上传新图：</p>
			<img height=200px width=200px id="preview" src="" />
			<p style="text-align:left;font-weight:bold;color:black">上传图片</p>
			<input type="file" id="uploadfile" name="uploadfile" accept="image/*" onchange="imgvisual()"/><br/><br/>
			<input class="register-button" type="submit" id="submit" name="submit" value="修改"/>
		</form>
	</div>
</body>
</html>
<?php 
mysql_close($con);
$RS=NULL;
$Con =NULL;
?>