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
	<title>�ɹ�</title>
</head>
	<body>
		<div>
			<p>�����޸ĳɹ������<a href="modifyuser.php">����</a>����</p>
		</div>
	</body>
</html>

<?php 
mysql_close($con);
$RS=NULL;
$Con =NULL;
?>