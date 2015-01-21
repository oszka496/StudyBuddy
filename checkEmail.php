<?php
	include 'inc/functions.php';
	$output = 'true';
	if(!filled($_GET['email'])) return;
	$email = s($_GET['email']);
	$query = "CALL get_user('$email')";
	$result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
	if(mysqli_num_rows($result) != 0) { //email not unique
		$fetch = mysqli_fetch_row($result);
		if($fetch[5]==1)
			$status = False;
	}
	mysqli_free_result($result);
	mysqli_next_result($mysqli);
	echo $output;
?>