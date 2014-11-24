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

	function sql_multi_parse($file) {
		global $mysqli;
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Unable to connect: %s\n", mysqli_connect_error());
			exit();
		}

		$query = file_get_contents($file);

		/* execute multi query */
		if (mysqli_multi_query($mysqli, $query))
			 echo "<span style='color: #060;'>Successfully executed query from file ".$file."</span><br>";
		else {
			 echo "<span style='color: #600;'>Failed to execute query in ".$file." (" . $mysqli->errno . "):<br><p>" . $mysqli->error."</p></span><br>";
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
			$query = "INSERT INTO `courses` (`name`, `lecturerId`, `courseStart`, `courseEnd`, `courseAdress`) VALUES ('$courseName', '{$_SESSION['id']}', '$start', '$end', '$courseAdress')";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}
	}
	
	//Function for students to add courses they attend
	function addCourse($courseAdress){
		global $mysqli;
		if (isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName'])){
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
				$query = "INSERT INTO `enrolled`(`studentId`, `courseId`) VALUES ('$userId','$courseId')";
				$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			}
		}
	}
	
	function createSalt()
	{
		$text = md5(uniqid(rand(), true));
		return substr($text, 0, 3);
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
			$query = "SELECT email FROM user WHERE email = '$email'";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			if(mysqli_num_rows($result) != 0) { 									//email not unique
				$status = False;
			}
			// TODO: regex
			
			//Checking type
			if($utype != "teacher" and $utype != "student"){
				$status = False;
			}
			
			return $status;
		}
?>