 <?php
header("Cache-Control: no-cache, post-check=0, pre-check=0");
header("Content-type:text/html;charset=gb2312");

session_start();
$con = mysql_connect("localhost","root","sql");
mysql_select_db("qingzhou", $con);
mysql_query("set names gb2312 ");

$username=$_POST["username"];
$password=$_POST["pwd"];
$type=$_POST["usertype"];

$sql="select * from php_admin where username='".$username."' and usertype='".$type."' and password='".$password."'";
$RSO=mysql_query($sql);

$RS=mysql_fetch_array($RSO);
$_SESSION['userid']=$RS['userid'];
$_SESSION['usertype']=$RS['usertype'];
mysql_close($con);
$RS=NULL;
$Con =NULL;
if($_SESSION['buying']==1)
{
	die("<script>javasript:top.location.href='addorder.php'</script>");
}
else if($type=='0')
{
	die("<script>javasript:top.location.href='myTout.php'</script>");
}
else if($type=='1')
{
	die("<script>javasript:top.location.href='sellercenter.php'</script>");
}

?>