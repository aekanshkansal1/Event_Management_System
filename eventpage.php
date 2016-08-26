<html>
<head>
	
</head>
<body>
<div style="width:100%;height:auto">
<?php
@require 'conf.inc.php';
if(isset($_GET['eventid']))
{
	$evid=$_GET['eventid'];
	showevent($evid);	
}
else
{
	die('Unauthorized access.Please go to index page and try again.');
}
function showevent($evid)
{
	if($result=mysql_query("Select * from eventall where evid='".$evid."'"))
	{
		$row=mysql_fetch_assoc($result);
		?>
	<div style="width:100%;height:400px;border:2px solid black;"><?php echo "<img width=100% height=390px src='data:image;base64,".$row['evcover']."'>"?></div>

<div style="width:25%;height:400px;float:left;border:2px solid black;">
<div style="width:80%;height:50px;margin:10% 10%;border:2px solid black;border-radius:10px;"><?php echo "<h3 style='text-align:center;'>".$row['evstdt']."</h3>"?></div>
<div style="width:80%;height:50px;margin:5% 10%;border:2px solid black;border-radius:10px;"><?php echo "<h3 style='text-align:center;'>".$row['evsttm']."-".$row['evendtm']."</h3>"?></div>
</div>

<div style="width:49.1%;height:400px;float:left;border:2px solid black;">
	<div style="width:80%;height:50px;margin:5% 10%;border:2px solid black"><?php echo "<h3 style='text-align:center;'>".$row['evname']."</h3>"?></div>
	<div style="width:80%;height:250px;margin:5% 10%;border:2px solid black"><h4 style="display:inline;margin:0% 0% 0% 4%;">Description</h4><?php echo "<p style='text-align:center;font-size:20px;'>".$row['evdesc']."</p>"?></div>
</div>

<div style="width:25%;height:400px;float:right;border:2px solid black;"></div>
</div>

<?php
	}
	else
	{
		echo 'No record found';
	}
}
?>

</body>
</html>