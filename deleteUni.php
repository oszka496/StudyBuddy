<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");

	if(!filled($_GET['uid'])){
		echo("Error: Unable to delete university.");
		exit();
	}
	
	$uid = s($_GET['uid']);
	$msg = "";
	try {
		$msg = University::deleteUniversity($uid);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}

	switch ($msg){
	case User::$INSUFFICIENT_PRIVILEGE: 
		echo "Error: You don't have enough privileges";
		break;
	case University::$DELETE_UNI_SUCCESS:
		echo "Success: University deleted";
		break;
	}
	
?>