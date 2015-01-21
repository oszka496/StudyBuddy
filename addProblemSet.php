<?php
	require_once 'inc/functions.php';
	if (!isSessionSet()) {
		if (isset($_POST['userid']) && isset($_POST['userlogin']))
		{
			$userid = s($_POST['userid']);
			$userlogin = s($_POST['userlogin']);
			$auth = User::authenticate($userlogin, $userid);
			if ($auth != User::$AUTHENTICATION_SUCCESS) {
				die("Malformed authentication data")
			}
		}
		else {
			die("Session not found");
		}
	}

	if(!arePostFilled(['psAddress','courseId','psName'])){
		echo("Unable to add Problem Set.");
		exit();
	}

	$psadr = s($_POST['psAddress']);
	$cid = s($_POST['courseId']);
	$name = s($_POST['psName']);



	$date = parseDate(s($_POST['psdate']));
	$msg = "";
	try{
		$msg = ProblemSet::addProblemSet($name, $cid, $date, $psadr);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}
	
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
?>