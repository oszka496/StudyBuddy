<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");

	if(!isset($_GET['cid'])){
		return;
	}
	$msg = "";
	try {
		$cid = s($_GET['cid']);
		$msg = Course::enrollToCourse(Course::getAdressById($cid));
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}
	switch ($msg){
		case Course::$COURSE_NOT_FOUND:
			echo "Error: Course not founds";
			break;
		case Course::$ALREADY_ENROLLED:
			echo "Error: You have already enrolled to the course";
			break;
		case Course::$COURSE_JOINED:
			echo "Success: Course joined";
			break;
	}
?>