<?php
	require_once 'inc/functions.php';
	if(!arePostFilled(['uniName','uniAddress']))
		die(header("Location: index.php"));
	$name = s($_POST['uniName']);
	$adr = s($_POST['uniAddress']);
	$tags = $name;
	$tags = $tags.s($_POST['tags']);
	createUniversity($name, $adr, $tags);
	
?>