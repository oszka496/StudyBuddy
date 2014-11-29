<?php
	header('Content-type: text/html; charset=utf-8');
	require_once 'db_db4free.cfg.php';
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
	
	function getUser(){
		if(isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName'])){
			$tab[0] = $_SESSION['id'];
			$tab[1] = $_SESSION['firstName'];
			$tab[2] = $_SESSION['lastName'];
			return $tab;
		} else {
			return "None";
		}
	}
	
	function logout(){
		if(isset($_SESSION['id']) or isset($_SESSION['firstName']) or isset($_SESSION['lastName'])){
			session_destroy();
		} else {
			echo "Session can't be destroyed";
		}
	}
	
	//Function for teachers to create courses
	function createCourse($courseName,$start,$end,$courseAdress) {
		global $mysqli;
		if ( isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName']) ){
			//$query = "CALL insert_course('$courseName', '{$_SESSION['id']}', '$start', '$end', '$courseAdress');";
			$query = "INSERT INTO `courses` (`name`, `lecturerId`, `courseStart`, `courseEnd`, `courseAdress`) VALUES ('$courseName', '{$_SESSION['id']}', '$start', '$end', '$courseAdress')";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}
	}
	
	//Function for students to add courses they attend
	function addCourse($courseAdress){
		global $mysqli;
		if (isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName'])){
			//$query = "CALL check_course('$courseAdress');";
			$query = "SELECT `id` FROM `courses` WHERE `courseAdress` = '$courseAdress'";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			if(mysqli_num_rows($result) == 0) { // Course not found.
				echo "Podany kurs nie istnieje w bazie danych";
			} else {
				$fetch = mysqli_fetch_row($result);
				$courseId = $fetch[0];
				$userId = $_SESSION['id'];
				
				$mysqli->next_result();
				$result->close();
				//$query = "CALL choose_course(`studentId`, `courseId`);";
				$query = "INSERT INTO `enrolled`(`studentId`, `courseId`) VALUES ('$userId','$courseId')";
				$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			}
		}
	}
	
	function validate($email,$pass,$cpass,$fname,$lname, $utype){
			global $mysqli;
			//Checking password
			$status = True;
			if ($pass != $cpass){													//password different than confirmation
				$status = False;
			} else if (strlen($pass) < 8) {											//password too short
				$status = False;
			} else if (strlen($pass) > 32) {										//password too long
				$status = False;
			}
			
			//Checking name
			if (strlen($fname) == 0 or strlen($lname) == 0){						//empty first or last name
				$status = False;
			}
			
			//Checking email
			$query = "CALL get_user('$email');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			if(mysqli_num_rows($result) != 0) { 									//email not unique
				$status = False;
			}
			$result->close();
			$mysqli->next_result();
			// TODO: regex
			
			//Checking type
			if($utype != 0 and $utype != 1  and $utype != 2){
				$status = False;
			}
			
			return $status;
		}
?>