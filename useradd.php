 <?php
 header("Cache-Control:no-cache,post-check=0,pre-check=0");
 header("Content-type:text/html;charset=GB2312");
 
 $con=mysql_connect("localhost","root","sql");
 mysql_select_db("qingzhou",$con);
 mysql_query("set names gb2312");
 
 $username=$_POST["username"];
 $pwd=$_POST["pwd"];
 $mobile=$_POST["mobile"];
 $usertype=$_POST["usertype"];
 $sql="insert into php_admin(username,password,usermobile,usertype) values('$username','$pwd','$mobile','$usertype')";
 mysql_query($sql);
 ?>
<html>
	<head>
		<title>ע����</title>
		<script language="javascript">
			function startlogin()
			{
				<?php
				session_start();
				$_SESSION['userid'] = $userid;
				?>
				return true;
			}
		</script>
	</head>
	<body>
		<div>
			<p style='text-size:200'>�װ���<?php echo $username ?>,��ϲ��ע��ɹ�! �������<a <?php if($usertype=='0') {echo "href='myTout.php'";} else { echo "href='sellercenter.php'";}?>>��¼</a></p>
			<?php 
			mysql_close($con);
			$SQL=NULL;
			$con=NULL;
			?>
		</div>
	</body>
 </html>