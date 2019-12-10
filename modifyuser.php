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
	<title>资料修改</title>
	<script>
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
		function check()
		{
			if(document.getElementById('mobilenumber').value.length!=11)
			{
				document.getElementById("visualspan").innerHTML="*电话号码位数不正确！<br/>";
				return false;
			}
			else
			{
				xmlHttp=GetXmlHttpObject()
				if (xmlHttp==null)
				{
					alert ("Browser does not support HTTP Request")
					return
				} 
				var url="gethint.php";
				url=url+"?username="+document.getElementById("username").value;
				url=url+"&mobile="+document.getElementById("mobilenumber").value;
				
				if('0'==<?php echo $_SESSION['usertype']; ?>)
				{
					url=url+"&type=0";
				}
				else
				{
					url=url+"&type=1";
				}
				
				url=url+"&check=modify";
				url=url+"&sid="+Math.random()
				xmlHttp.onreadystatechange=stateChanged ;
				xmlHttp.open("GET",url,true)
				xmlHttp.send(null)
			}
			return false;
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
				document.getElementById("visualspan").innerHTML=xmlHttp.responseText+'<br/>';				
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
			<form action="modify.php" id="modify" name=modify method=post onsubmit="return check()">
				<br/>
				<p style="text-align:left;font-weight:bold;color:black">用户名:</p>
				<input class="register-input" id="username" name=username value=<?php echo $RS['username'] ?> /><br/>
				<br/>
				<p style="text-align:left;font-weight:bold;color:black">电话号码:</P>
				<input class="register-input" id="mobilenumber" name=mobilenumber value=<?php echo $RS['usermobile'] ?> />	<br/>
				<br/>
				<br/>
				<input class="register-button" type=button style="background:green;float:left" value="修改密码" onclick="javascript: window.open('modifypassword.php')" /><br/>
				<span id=visualspan name=visualspan><br/><br/></span>
				<input class="register-button" style="float:right" type=submit value="确认修改" />
			</form>
		</div>
	</body>
</html>
<?php 
mysql_close($con);
$RS=NULL;
$Con =NULL;
?>