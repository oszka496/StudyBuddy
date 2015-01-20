<?php
	require_once 'functions.php';
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
	header("Content-Type: application/x-javascript; charset=utf-8");
	if (!isSessionSet())
	{
		echo '{session: "none"}';
	}
	else
	{
		echo '{session: "'.$_SESSION['id'].'", name: "'.$_SESSION['name'].'", surname: "'.$_SESSION['surname'].'"}';
	}
?>