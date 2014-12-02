<?php
	header('Content-type: text/html; charset=utf-8');
	require_once 'db_db4free.cfg.php';
	require_once dirname(__FILE__).'\..\api\user.php';
	require_once dirname(__FILE__).'\..\api\course.php';
	require_once dirname(__FILE__).'\..\api\problemSet.php';
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		session_name("study-buddy");
	}

	function s($in) {
		global $mysqli;
		$out = trim($in);
		$out = stripslashes($out);
		$out = htmlspecialchars($out);
		$out = strip_tags($out);
		$out = mysqli_real_escape_string($mysqli, $out);
		return $out;
	}

	function isSessionSet(){
		if(filled($_SESSION['id']) and filled($_SESSION['firstName']) and filled($_SESSION['lastName']))
			return true;
		return false;
	}

	function arePostFilled($fields)
	{
		foreach ($fields as &$field)
			if (!filled($_POST[$field]))
				return false;
		return true;
	}

	function sql_multi_parse($file)
	{
		global $mysqli;
		if (mysqli_connect_errno()) {
			printf("Unable to connect: %s\n", mysqli_connect_error());
			exit();
		}

		$query = file_get_contents($file);

		$i = 1;
		/* execute multi query */
		if ($mysqli->multi_query($query)) {
		    do {
		        /* store first result set */
		        printf("<p class='ok'>Processing %d in %s...\n</p>", $i, $file);
		        if ($result = $mysqli->store_result()) {
		            while ($row = $result->fetch_row()) {
		                printf("\t%s\n<br>", $row[0]);
		            }
		            $result->free();
		        }
		        /* print divider */
		        if (!$mysqli->more_results()) {
		        	echo "<p class='ok'><br></p>";
		        }
		        $i += 1;
		    } while ($mysqli->next_result());
		}
		else 
		{
			echo "<p class='fail'>Failed to execute query in ".$file." (Procedure: ".$i.", error no:" . $mysqli->errno . "):</p>";
			echo "<p class='fail'>" . $mysqli->error."</p>";
		}
	}
	
	//Function checking if the variable isn't empty
	function filled($variable)
	{
	  return isset($variable) && !empty($variable);
	}

	//Function to create university
	function createUniversity($uniName, $uniAddress, $tags) {
		global $mysqli;
		if(!isSessionSet()) return;
		$query = "CALL check_uni('$uniAddress');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		if(mysqli_fetch_row($result) != 0){
			return;
		}
		$result->close();
		$mysqli->next_result();
		$query = "CALL insert_uni('$uniName','$uniAddress', '$tags');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	}

	function deleteUniversity($universityId){
		global $mysqli;
		if(!isSessionSet()) return;
		$id = s($_SESSION['id']);
		//if(checkStatus($id) == 0){
			$query = "CALL delete_uni('$universityId');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		//}
	}

	//Function to check user's status
	function checkStatus($id) {
		global $mysqli;
		if(!isSessionSet()) return;
		$query = "CALL get_status('$id');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$fetch = mysqli_fetch_row($result);
		$stat = $fetch[0];
		return $stat;
	}
?>