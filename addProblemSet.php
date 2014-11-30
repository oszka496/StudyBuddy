<?php
	require_once 'inc/functions.php';
	if(isset($_SESSION['id'])){
		$id = s($_SESSION['id']);
	} else {								//User not logged in
		header('Location: index.php');
	}

	if(filled($_POST['psAddress']) && filled($_POST['courseId'])){
		$psadr = s($_POST['psAddress']);
		$cid = s($_POST['courseId']);

		if(filled($_POST['dday']) && filled($_POST['dmonth']) && filled($_POST['dyear'])){
			$deadline = s($_POST['dyear'])."-".s($_POST['dmonth'])."-".s($_POST['dday']);
		} else {
			$deadline = "0000-00-00";
		}
		addProblemSet($cid, $deadline, $psadr);
		header("Location: index.php");
	}
?>