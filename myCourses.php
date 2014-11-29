<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}
	$query = "CALL show_my_courses($id);";
	$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

	if(mysqli_num_rows($result) == 0) { // No universities yet
			echo "You have no courses yet";
	} else {
		echo "<ul id='userCourses'>";
		while ($fetch = mysqli_fetch_row($result)){
			$name = $fetch[0];
			echo "<li>".$name."</li>";
		}
		echo "</ul>";
	}
?>