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

		$date = parseDate(s($_POST['psdate']));
		$msg = ProblemSet::addProblemSet($name, $cid, $date, $psadr);
		switch ($msg){
			case Course::$COURSE_NOT_FOUND: 
				echo "Error: Course doesn't exist";
				break;
			case ProblemSet::$PS_EXISTS:
				echo "Error: Problem set already exists";
				break;
			case ProblemSet::$ADD_PS_SUCCESS:
				echo "Success: Problem set added";
				break;
		}
	}
?>