<?php
	include 'inc/functions.php';
	$output = 'true';
	$email = s($_GET['email']);
	//$query = "CALL get_user('$email');";
	$result = mysqli_query($mysqli,"SELECT `email` FROM `user` WHERE `email`='$email'") or die(mysqli_error($mysqli));
	while($row = mysqli_fetch_array($result))
	{
		$output = 'false';
	}
	echo $output;
?>