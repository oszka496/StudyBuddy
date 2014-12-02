<?php
	include 'inc/functions.php';
	$output = 'true';
	if(!filled($_GET['email'])) return;
	$email = s($_GET['email']);
	$query = "CALL get_user('$email');";
	$result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
	while($row = mysqli_fetch_array($result))
	{
		$output = 'false';
	}
	echo $output;
?>