<?php
global $mysqli;
if (isset($_ENV['OPENSHIFT_DB_HOST']))
{
	$mysqli = mysqli_connect($_ENV['OPENSHIFT_DB_HOST'], $_ENV['OPENSHIFT_DB_USERNAME'], $_ENV['OPENSHIFT_DB_PASSWORD'],
			  $_ENV['OPENSHIFT_APP_NAME']) or die("<div class=\"label label-info\">".mysqli_connect_error()."</div>");
}
else
{
	$mysqli = mysqli_connect('db4free.net', 'adminer', 'axis!69', 'studybuddy') or die("<div class=\"label label-info\">".mysqli_connect_error()."</div>");
}
?>