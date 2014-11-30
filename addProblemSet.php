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

		if(filled($_POST['dyear'])){
			$deadline = s($_POST['dyear']);
			if(filled($_POST['dmonth'])){
				$deadline = $deadline."-".s($_POST['dmonth']);
			} else {
				$deadline = $deadline."-01";
			}
			if(filled($_POST['dday'])){
				$deadline = $deadline."-".s($_POST['dday']);
			} else {
				$deadline = $deadline."-01";
			}
			
		} else {
			$deadline = "0000-00-00";
		}
		if(filled($_POST['psName'])){
			$name = s($_POST['psName']);
		} else {
			$name = "";
		}
		addProblemSet($name, $cid, $deadline, $psadr);
		header("Location: index.php");
	}
?>