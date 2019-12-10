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

$SQL="select * from php_admin where userid=".$_SESSION['userid'];
$RS0=mysql_query($SQL,$con);
$RS=mysql_fetch_array($RS0);
?>


<html>
<head>
	<title>密码修改</title>
	<script language="javascript">
		var xmlHttp;
		function GetXmlHttpObject()
		{
			var xmlHttp=null;
			try
			{
				// Firefox, Opera 8.0+, Safari
				xmlHttp=new XMLHttpRequest();
			}
			catch (e)
			{
			// Internet Explorer
				try
				{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e)
				{
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
			}
			return xmlHttp;
		}
		function ck_orpwd()
		{
			if(ck_pwd())
			{
				
				xmlHttp=GetXmlHttpObject();
				if (xmlHttp==null)
				{
					alert ("Browser does not support HTTP Request");
					return;
				} 
				
				var url="gethint.php";
				url=url+"?username="+"<?php echo $RS['username']; ?>";
				url=url+"&password="+document.getElementById("original").value;
				if('0'==<?php echo $_SESSION['usertype']; ?>)
				{
					
					url=url+"&type=0";
				}
				else
				{
					url=url+"&type=1";
				}
				
				url=url+"&check=loginInfo";
				url=url+"&sid="+Math.random();
				xmlHttp.onreadystatechange=stateChanged;
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);
			}
			return false;
		}
		function ck_pwd()
		{
			if(document.getElementById('new').value!=document.getElementById('newagain').value)
			{
				document.getElementById('visualspan').innerHTML='*密码不一致<br/>';
				return false;
			}
			else if(document.getElementById('new').value.length==0)
			{
				document.getElementById('visualspan').innerHTML='*新密码不能为空<br/>';
				return false;
			}
			return true;
		}
		function stateChanged() 
		{ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{ 
				if(xmlHttp.responseText=="ok<br/>")
				{
					document.getElementById("modify").submit();
					return;
				}	
				else 
				{
					document.getElementById("visualspan").innerHTML="*原始密码错误！<br/>";
					return;
				}
			} 
			return;
		}
	</script> 
	<link rel="stylesheet" type="text/css" href="inputboxes.css" />
</head>
	<body class="background">
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
		<div class="register-box">
			<form action="passwordsave.php" id="modify" name=modify method=post onsubmit="return ck_orpwd()">
			<p style="text-align:left;font-weight:bold;color:black">输入原始密码：</p>
			<input class="register-input" type="password" id="original" name=origianl  /><br/>
			<p style="text-align:left;font-weight:bold;color:black">输入新密码：</p> 
			<input class="register-input" type="password" id="new" name=new  /><br/>	
			<p style="text-align:left;font-weight:bold;color:black">再次输入新密码：</p>
			<input class="register-input" type="password" id="newagain" name=newagain onblur="ck_pwd()"/><br/>
			<span id="visualspan" name=visualspan><br/></span><br/>
			<input class="register-button" type=submit value="确认修改" />
		</div>
	</body>
</html>
<?php 
mysql_close($con);
$RS=NULL;
$Con =NULL;
?>