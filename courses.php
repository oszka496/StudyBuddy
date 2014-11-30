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
			echo "<table id='courseList'>";
			while ($fetch = mysqli_fetch_row($result)){
				$cid = $fetch[0];
				$name = $fetch[1];
				$lid = $fetch[2];
				$cstart = $fetch[3];
				$cend = $fetch[4];
				$address = $fetch[5];
				echo "<tr>";
				echo "<td>".$name."</td>";
				echo "<td>".$address."</td>";
				echo "<td><a href='enroll.php?cid=".$cid."''>Enroll</a></td>";
				echo "<td><a href='deleteCourse.php?cid=".$cid."''>Delete</a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		include('addCourseForm.php');
	}
?>