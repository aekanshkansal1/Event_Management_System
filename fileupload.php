<?php
@require 'conf.inc.php';
if(isset($_POST['sb']))
{
	if(getimagesize($_FILES['img']['tmp_name'])==FALSE)
	{
		echo 'please select an image';
	}
	else
	{
		$image=addslashes($_FILES['img']['tmp_name']);
		$name=addslashes($_FILES['img']['name']);
		$image=file_get_contents($image);
		$image=base64_encode($image);
		saveimage($name,$image);
	}
}
		displayimage();

function saveimage($name,$image)
{
	$result=mysql_query("insert into imgplay(name,image) values('$name','$image')");
	if($result)
	{
		echo "<br/>image uploaded";
	}
	else
	{
		echo "<br/>Image not uploaded";
	}
	header('Location:fileupload.php');
}
function displayimage()
{
	$result=mysql_query("select * from imgplay");
	while($row=mysql_fetch_array($result))
	{
		echo '<img height="300px" width="100%" src="data:image;base64,'.$row[2].'">';
	}
}
?>
<html>
<head>
</head>
<body>
<form method="POST" action="fileupload.php" enctype="multipart/form-data">
Image<input type="file" name="img" required><br/>
<input type="submit" name="sb" value="upload">
</form>
</html>