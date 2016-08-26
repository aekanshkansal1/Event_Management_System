<?php
//FOR ANY REDIRECTION AS NOT LOGGED IN OR INVALID CREDENTIALS
@require 'conf.inc.php';
if(isset($_GET['t']))
{
	$infcode=$_GET['t'];
	if($infcode=="0")
	{
		echo 'Not Logged in.Login Please!';
	}
	if($infcode=="1")
	{
		echo 'Invalid login credentials';
	}
	if($infcode=="2")
	{
		echo 'Successfully log out';
	}
}
?>
<html>
<head>
</head>
<body>
<div style="width:100%;height:200px;border:2px solid black;">
<h3>Society Login</h3>
<pre>
<form method="POST" action="valid_login.php">     <!--Taking login credentials as input-->
Username<input type="text" name="user" placeholder="Society Username" maxlength="50" required><br/>
Password<input type="password" name="pass" placeholder="Society Password" maxlength="50" required><br/>
<input type="submit" name="sb">
</form>
</pre>
</div>
<div style="width:100%;height:400px;border:2px solid black;">
<?php
if($result=mysql_query('select evname,evid,soc_name,evstdt from eventall'))
{
if(mysql_num_rows($result)>=1)
{
while($row=mysql_fetch_array($result))        //return the row as array idex 0 store evname index 1 event id and so on
{
	$evname=$row['0'];
	$evid=$row['1'];
	$soc_name=$row['2'];
	$eventdate=$row['3'];
echo "<div style='width:100%;height:40px;border:1px solid black;'><a href='http://localhost/events/eventpage.php?eventid=$evid'>"."$soc_name organising <b>$evname</b> on $eventdate</a></div>";
}
}
}
else
	echo 'No Event Found'
?>
</div>
</pre>
</html>