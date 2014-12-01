<?php
	require_once '../inc/functions.php';
	if (!isset($_POST['content']))
		die("Data wasn't sent.");

	$content = s($_POST['content']);
	$request = json_decode($content, true);

	switch($request['type'])
	{
		case "login":
			
			break;
	}
?>