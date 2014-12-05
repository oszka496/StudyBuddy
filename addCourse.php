<?php
	require_once 'inc/functions.php';
	
	if (!isSessionSet())
		throw new Exception("Session wasn't set.");
	if (!arePostFilled(['courseName', 'courseAddress', 'uniId']))
		die("Unable to add course.");

	$id = s($_SESSION['id']);

	$name = s($_POST['courseName']);
	$adr = s($_POST['courseAddress']);
	$uni = s($_POST['uniId']);
	
	$starts = parseDate(s($_POST['sdate']));
	$ends = parseDate(s($_POST['edate']));
	try 
	{
		Course::addCourse($name, $adr, $uni, $starts, $ends);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}
?>