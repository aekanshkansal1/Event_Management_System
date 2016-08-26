<?php
@require 'conf.inc.php';
session_start();
$societyid=checklogin();
//Giving status on successful submission
if(isset($_GET['success']) && $_GET['success']==1)
{
	echo 'event successfully created';
}
//Inserting event details in database
if(isset($_POST['sbevent']))
{
	$evname=$_POST['evname'];  //GEtting all the values in variables
	$evdesc=$_POST['evdesc'];
	$evstdt=$_POST['evstdt'];
	$evsttm=$_POST['evsttm'];
	$evendtm=$_POST['evendtm'];
	$evvenue=$_POST['evvenue'];
	if(!($evname=='' ||$evdesc=='' ||$evstdt=='' ||$evsttm=='' ||$evendtm==''))
	{
	if(getimagesize($_FILES['evimg']['tmp_name'])==FALSE)
	{
		echo 'please select an image';      //No image found
	}
	else
	{
		$image=addslashes($_FILES['evimg']['tmp_name']);      //getting image
	//	$name=addslashes($_FILES['img']['name']); //getting name of image
		$image=file_get_contents($image);
		$image=base64_encode($image);
		$societynm=getsociety($societyid);
		savedata($evname,$evdesc,$societyid,$societynm,$image,$evstdt,$evsttm,$evendtm,$evvenue);          //storing image with data

	}
	}
	else
	{
		echo 'please fill out required fields';
	}
//calling display function
//		displayimage();
}
function checklogin()
{
//For checking unauthorized access
	if(!isset($_SESSION['societyid']))
	{
		header("Location:index.php?t=0");       //no login found
	}
	else
	{
	return $_SESSION['societyid'];
	}
}
//get Societyname
function getsociety($societyid)
{
	if($result=mysql_query("Select username from eventlogin where id='".$societyid."'"))
	{
		return mysql_result($result,0,'username');
	}
}

function savedata($evname,$evdesc,$societyid,$societynm,$image,$evstdt,$evsttm,$evendtm,$evvenue)
{
	$result=mysql_query("insert into eventall values('','$evname','$evdesc','$societyid','$societynm','$image','$evstdt','$evsttm','$evendtm','$evvenue')");
	if($result)
	{
	header('Location:createevent.php?success=1');   //To avoid duplicacy on resubmission
	}
	else
	{
		echo "<br/>Event can't be created".mysql_error();
	}
}
/*To display image
function displayimage()
{
	$result=mysql_query("select * from imgplay");
	while($row=@mysql_fetch_array($result))
	{
		echo '<img height="300" width="100%" src="data:image;base64,'.$row[2].'">';
	}
}*/

?>
<html>
<head>
</head>
<body>
<a href="logout.php">logout</a>
<h3>Create Event</h3>
<pre>
<form method="POST" action="createevent.php" enctype="multipart/form-data">
Event Name<input type="text" name="evname" maxlength="50" required><br/>
Event Description<br/><textarea rows="10" cols="200" name="evdesc"></textarea><br/>
Cover Photo<input type="file" name="evimg" required><br/>
<!--Date and timing Here-->
Date<input type="date" name="evstdt" required>
<!--End Date<input type="date" name="dtend" required>-->
Start Timing<input type="time" name="evsttm" required>
End Timing<input type="time" name="evendtm" required>
Event Venue<input type="text" name="evvenue" maxlength="50" required><br/>
<input type="submit" name="sbevent">
</form>
</pre>
</html>