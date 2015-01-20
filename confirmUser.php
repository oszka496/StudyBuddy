<?php
	require_once 'inc/functions.php';
	
	if(!isset($_GET['conf'])){
		return;
	}
	$msg = "";
	try {
		$conf = s($_GET['conf']);
		$msg = User::confirmUser($conf);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}
	switch ($msg){
		case User::$CONFIRMATION_SUCCESS:
			echo "Now you can log in";
			break;
		default:
			echo "Oops";
	}
?>