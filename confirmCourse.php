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
		$msg = Course::addLecturer($_SESSION['id'],$cid);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}
	switch ($msg){
		case User::$INSUFFICIENT_PRIVILEGE:
			echo "Error: You don't have enough privileges";
			break;
		case Course::$LECTURER_CHANGED:
			echo "New lecturer successfully assigned";
			break;
	}
?>