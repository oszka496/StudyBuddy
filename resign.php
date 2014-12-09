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
		$msg = Course::resignFromCourse($cid);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}
	switch ($msg){
		case Course::$COURSE_LEAVED:
			echo "Success: You have left the course";
			break;
		case Course::$NOT_ENROLLED:
			echo "Error: You haven't enrolled to the course";
			break;
	}
?>