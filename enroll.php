<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}
	if(isset($_GET['cid'])){
		$cid = s($_GET['cid']);
		$query = "CALL choose_course('$id','$cid');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	}
?>