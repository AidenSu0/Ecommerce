<?php

	header("Cache-Control: no-cache, post-check=0, pre-check=0");
	header("Content-type:text/html;charset=gb2312");
	session_start();
	session_destroy();
	header("location:mainpage.php")
?>