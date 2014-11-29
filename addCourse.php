<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {
		header('Location: index.php');
	}

	if(isset($_POST['courseName']) && isset($_POST['courseAddress'])){
		$name = s($_POST['courseName']);
		$adr = s($_POST['courseAddress']);
		$query = "CALL check_course('$adr');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		if(mysqli_fetch_row($result) == 0){
			$result->close();
			$mysqli->next_result();
			$query = "CALL insert_course('$name','$adr');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}
		$result->close();
		$mysqli->next_result();
		$query = "CALL check_course('$adr');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$fetch = mysqli_fetch_row($result);
		$cid = $fetch[0];

		if(isset($_POST[courseStart]) && isset($_POST[courseEnd])){
			$starts = s($_POST[courseStart]);
			$ends = s($_POST[courseEnd]);
			$result->close();
			$mysqli->next_result();
			$query = "insert_dates('$cid', '$starts', '$ends');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}

		$result->close();
		$mysqli->next_result();
		$query = "CALL get_status('$id');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$fetch = mysqli_fetch_row($result);
		$stat = $fetch[0];
		if($stat == 1){
			$result->close();
			$mysqli->next_result();
			$query = "CALL insert_lecturer('$cid','$id');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}

	}
?>