<?php
	require_once 'inc/functions.php';
	if(!arePostFilled(['uniName','uniAddress'])){
		echo("Unable to add University.");
		exit();
	}
	$name = s($_POST['uniName']);
	$adr = s($_POST['uniAddress']);
	$tags = $name;
	$tags = $tags.s($_POST['tags']);
	$msg = "";
	try {
		$msg = University::createUniversity($name, $adr, $tags);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}

	switch ($msg){
		case User::$INSUFFICIENT_PRIVILEGE: 
			echo "Error: You don't have enough privileges";
			break;
		case University::$UNI_EXISTS:
			echo "Error: University already exists";
			break;
		case University::$ADD_UNI_SUCCESS:
			echo "Success: University added";
			break;
	}
	
?>