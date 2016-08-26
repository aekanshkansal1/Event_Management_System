<?php
@require 'conf.inc.php';
//CHECKING WHETHER SUBMIT IS CLICKED OR NOT
if(isset($_POST['sb']))
{
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	//LOGIN VALIDATION
	if($queryrun=mysql_query("SELECT id FROM eventlogin WHERE username='".$user."' AND password='".$pass."'"))//checking login credentials in database
	{
		if($societyid=mysql_result($queryrun,0,'id'))
		{
			session_start();
			$_SESSION['societyid']=$societyid;   //storing society identity in session
			header("Location:soc_home.php");      //Go to society home page
		}
		else
		{
			header("Location:index.php?t=1");   //wrong credentials
		}
	}
	else
	{
		die('Error in Login Contact Admin');   //query not working
	}
}
else
{
	header("Location:index.php?t=0");  //no login found
}
?>