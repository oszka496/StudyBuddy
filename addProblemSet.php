<?php
	require_once 'inc/functions.php';
	if (!isSessionSet())
		throw new Exception("Session wasn't set.");

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