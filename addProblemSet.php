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
		echo $_POST['psdate'];
		/*if(filled($_POST['dyear'])){
						
		} else {
			$deadline = "0000-00-00";
		}*/
		if(filled($_POST['psName'])){
			$name = s($_POST['psName']);
		} else {
			$name = "";
		}
		//problemSet::addProblemSet($name, $cid, $deadline, $psadr);
		//header("Location: index.php");
	}
?>