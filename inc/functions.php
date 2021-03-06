<?php
	header('Content-type: text/html; charset=utf-8');
	require_once 'db_interoperate.cfg.php';
	define("PATH", str_replace("\\", "/", dirname(__FILE__)));
	define("LINK", str_replace("\\", "/", dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")));
	require_once PATH.'/../inc/password_compat-master/lib/password.php';
	require_once PATH.'/../api/user.php';
	require_once PATH.'/../api/university.php';
	require_once PATH.'/../api/course.php';
	require_once PATH.'/../api/problemSet.php';
	if (session_status() == PHP_SESSION_NONE) {
		header('P3P: CP="CAO PSA OUR"');
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
		            mysqli_free_result($result);
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

	//Function to check user's status
	function checkStatus($id) {
		global $mysqli;
		if(!isSessionSet()) return;
		$query = "CALL get_status('$id')";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$fetch = mysqli_fetch_row($result);
		$stat = $fetch[0];
		mysqli_free_result($result);
		mysqli_next_result($mysqli);
		return $stat;
	}

	function parseDate($date){
		$date = s($date);
		if(!filled($date)){
			return "0000-00-00";
		}
		$h = explode('/',$date);
		return $h[2]."-".$h[1]."-".$h[0];
	}


?>
