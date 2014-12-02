<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
	throw new Exception("Session wasn't set.");

	$query = "CALL show_uni();";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

	if(mysqli_num_rows($result) == 0) { // No universities yet
			echo "There are no universities in the database";
	} else {
		echo "<ul id='universityList' class='list-group'>";
		while ($fetch = mysqli_fetch_row($result)){
			$uid = $fetch[0];
			$name = $fetch[1];
			$address = $fetch[2];
			$tags = $fetch[3];
			$courses = "courses.php?uid=".$uid;
			echo "<li class='list-group-item'><a href=".$courses." class='listLink'>".$name."</a></li>";
		}
		echo "</ul>";
	}

?>