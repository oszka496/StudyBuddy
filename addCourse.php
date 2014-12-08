<?php
	require_once 'inc/functions.php';
	
	if (!isSessionSet())
		throw new Exception("Session wasn't set.");
	if (!arePostFilled(['courseName', 'courseAddress', 'uniId'])){
		echo("Unable to add course.");
		exit();
	}

	$id = s($_SESSION['id']);

	$name = s($_POST['courseName']);
	$adr = s($_POST['courseAddress']);
	$uni = s($_POST['uniId']);
	
	$starts = parseDate(s($_POST['sdate']));
	$ends = parseDate(s($_POST['edate']));
	$msg = "";
	try 
	{
		$msg = Course::addCourse($name, $adr, $uni, $starts, $ends);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}

	switch ($msg){
		case Course::$COURSE_ALREADY_EXISTS: 
			echo "Error: Course already exists";
			break;
		case Course::$COURSE_ADDED:
			echo "Success: Course added";
			break;
	}
?>