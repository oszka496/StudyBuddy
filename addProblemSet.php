<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}

	if(arePostFilled(['psAddress','courseId','psName'])){
		$psadr = s($_POST['psAddress']);
		$cid = s($_POST['courseId']);
		$name = s($_POST['psName']);

		$date = getDate(s($_POST['psdate']));
		echo problemSet::addProblemSet($name, $cid, $date, $psadr);
		//header("Location: index.php");
	}
?>