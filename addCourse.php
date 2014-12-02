<?php
	require_once 'inc/functions.php';
	
	if(!isset($_SESSION['id']))
		die("Unable to add course.");
	if (!arePostFilled(['courseName', 'courseAddress', 'uniId']))
		die("Unable to add course.");

	$id = s($_SESSION['id']);

	$name = s($_POST['courseName']);
	$adr = s($_POST['courseAddress']);
	$uni = s($_POST['uniId']);
	
	$starts = '0000-00-00';
	$ends = '0000-00-00';
	
	//TO DO: getting dates
	try 
	{
		Course::createCourse($name, $adr, $uni, $starts, $ends);
	}
	catch (Exception $e)
	{
		die($e->getMessage());
	}
?>