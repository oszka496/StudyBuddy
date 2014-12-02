<?php
	require_once 'inc/functions.php';
	if(!isSessionSet())
		throw new Exception("Session wasn't set.");

	if(filled($_GET['cid'])){
		$cid = s($_GET['cid']);
		
		try {
			Course::deleteCourse($cid);
		}
		catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
?>