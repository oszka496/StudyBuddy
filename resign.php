<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");

	if(!isset($_GET['cid'])){
		header("Location: index.php");
		return;
	}

	$msg = "";
	try {
		$cid = s($_GET['cid']);
		$msg = Course::resignFromCourse($cid);
		header("Location: index.php");
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}
?>