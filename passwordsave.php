<?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");
session_start();
if (!isset($_SESSION['userid']))
{
	die("<script>javasript:top.location.href='mainpage.php'</script>");
}

$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

$newpassword=$_POST['new'];

$SQL="update php_admin set password='".$newpassword."' where userid=".$_SESSION['userid'];
mysql_query($SQL,$con);
?>


<html>
<head>
	<title>成功</title>
</head>
	<body>
		<div>
			<p>密码修改成功，点击<a href="modifyuser.php">这里</a>返回</p>
		</div>
	</body>
</html>

<?php 
mysql_close($con);
$RS=NULL;
$Con =NULL;
?>