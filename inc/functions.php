<?php
	header('Content-type: text/html; charset=utf-8');
	
	if(!isset($_SESSION['id'])) {
	 	session_start();
	}
	
	function s($in) {
		$out = trim($in);
		$out = stripslashes($out);
		$out = htmlspecialchars($out);
		$out = strip_tags($out);
		$out = mysqli_real_escape_string($mysqli, $out);
		return $out;
	}
?>