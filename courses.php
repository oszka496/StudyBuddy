<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}

	if(isset($_GET['uid'])){
		$uid = s($_GET['uid']);
		$query = "CALL show_course('$uid');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		if(mysqli_num_rows($result) == 0) { // No universities yet
		} else {
			echo "<ul id='courses'>";
			while ($fetch = mysqli_fetch_row($result)){
				$cid = $fetch[0];
				$name = $fetch[1];
				$lid = $fetch[2];
				$cstart = $fetch[3];
				$cend = $fetch[4];
				$adress = $fetch[5];
				echo "<li>".$name."</li>";
			}
			echo "</ul>";
		}
		include('addCourseForm.php');
	}
?>