<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}
	if(isset($_POST['courseName']) && isset($_POST['courseAddress']) && isset($_POST['uniId'])){
		echo $_POST['courseName']."<br>";
		echo $_POST['courseAddress']."<br>";
		echo $_POST['uniId']."<br>";
	}
/*	if(isset($_POST['courseName']) && isset($_POST['courseAddress']) && isset($_POST['uniId'])){
		$name = s($_POST['courseName']);
		$adr = s($_POST['courseAddress']);
		$uni = s($_POST['uniId']);
		$query = "CALL check_course('$adr');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		if(mysqli_fetch_row($result) != 0){		 //Course already exists
			header('Location: index.php');
		}
		$result->close();
		$mysqli->next_result();

		$starts = '0000-00-00';
		$ends = '0000-00-00';
		if(isset($_POST['courseStart']) && isset($_POST['courseEnd'])){
			$starts = s($_POST['courseStart']);
			$ends = s($_POST['courseEnd']);
		}

		$query = "CALL insert_course('$name', '$starts', '$ends', '$adr', '$uni');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		//$result->close();
		//$mysqli->next_result();
		$query = "CALL check_course('$adr');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$fetch = mysqli_fetch_row($result);
		$cid = $fetch[0];

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

	}*/
?>