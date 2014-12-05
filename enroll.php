<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");

	if(!isset($_GET['cid'])){
		header("Location: index.php");
		return;
	}

	try {
		$cid = s($_GET['cid']);
		Course::enrollToCourse(Course::getAdressById($cid));
		header("Location: index.php");
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}
?>