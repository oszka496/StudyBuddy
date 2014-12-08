<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");

	if(filled($_GET['cid'])){
		echo("Unable to delete course.");
		exit();
	}
	
	$cid = s($_GET['cid']);
	$msg = "";
	try {
		$msg = Course::deleteCourse($cid);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}

	switch ($msg){
	case User::$INSUFFICIENT_PRIVILEGE: 
		echo "Error: You don't have enough privileges";
		break;
	case Course::$COURSE_DELETED:
		echo "Success: Course deleted";
		break;
	}
	
?>