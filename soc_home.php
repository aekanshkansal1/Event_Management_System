<?php
//For checking unauthorized access
session_start();
if(!isset($_SESSION['societyid']))
{
	header("Location:index.php?t=0");       //no login found
}
?>
<html>
<head>
</head>
<body>
<a href="createevent.php">Create a new Event</a>
</body>
</html>