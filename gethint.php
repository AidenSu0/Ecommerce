<?php
header("Cache-Control:no-cache,post-check=0,pre-check=0");
header("Content-type:text/html;charset=GB2312");
session_start();
$con=mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou",$con);
mysql_query("set names gb2312");

$check=$_GET['check'];
$type=$_GET['type'];
//echo $type;
//	die();
if(!strcmp($check,'loginInfo'))
{
	$username=$_GET["username"];
	$password=$_GET["password"];
	//echo $username;
	//die();
	$sql="select * from php_admin where username='$username' and usertype='$type' and password='$password'";
	$RSO=mysql_query($sql);
	if(mysql_fetch_array($RSO)==null)
	{
		echo '*用户名或密码错误<br/>';
	}
	else 
	{
		echo "ok<br/>";
	}
	mysql_close($con);
	$SQL=NULL;
	$con=NULL;
}
else if(!strcmp($check,'registerInfo'))
{
	$usermobile=$_GET["mobile"];
	$username=$_GET["username"];
	$sql="select * from php_admin where usermobile='$usermobile' and usertype='$type'";
	$RSO=mysql_query($sql);
	if($RS=mysql_fetch_array($RSO))
	{
		echo '号码已存在！<br/>';
	}
	$sql="select * from php_admin where username='$username' and usertype='$type'";
	$RSO=mysql_query($sql);
	if($RS=mysql_fetch_array($RSO))
	{
		echo '用户名已存在！<br/>';
	}
	mysql_close($con);
	$SQL=NULL;
	$con=NULL;
}
else if(!strcmp($check,'modify'))
{
	$usermobile=$_GET["mobile"];
	$username=$_GET["username"];
	$sql="select * from php_admin where usermobile='$usermobile' and usertype='$type'";
	$RSO=mysql_query($sql);
	if($RS=mysql_fetch_array($RSO))
	{
		if($RS['userid']!=$_SESSION['userid'])
		{
			echo '号码已存在！<br/>';
			return;
		}
		
	}
	$sql="select * from php_admin where username='$username' and usertype='$type'";
	$RSO=mysql_query($sql);
	if($RS=mysql_fetch_array($RSO))
	{
		if($RS['userid']!=$_SESSION['userid'])
		{
			echo '用户名已存在！<br/>';
			return;
		}
	}
	echo "ok<br/>";
	mysql_close($con);
	$SQL=NULL;
	$con=NULL;
}
else 
{
	$usermobile=$_GET["mobile"];
	$username=$_GET["username"];
	$test=0;
	$sql="select * from php_admin where usermobile='$usermobile' and usertype='$type'";
	$RSO=mysql_query($sql);
	if($RS=mysql_fetch_array($RSO))
	{
		echo '号码已存在！<br/>';
		$test=1;
	}
	$sql="select * from php_admin where username='$username' and usertype='$type'";
	$RSO=mysql_query($sql);
	if($RS=mysql_fetch_array($RSO))
	{
		echo '用户名已存在！<br/>';
		$test=1;
	}
	if($test==0)
	{
		echo 'ok<br/>';
	}
	mysql_close($con);
	$SQL=NULL;
	$con=NULL;
}
?>