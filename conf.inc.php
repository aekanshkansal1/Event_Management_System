<?php
if(!@mysql_connect('localhost','root','') || !@mysql_select_db('events'))
{
	die('Error In Database Connection Contact Admin.');
}
?>