<?php
	header('Content-type: text/html; charset=utf-8');
	require_once 'db_db4free.cfg.php';
	require_once dirname(__FILE__).'\..\api\user.php';
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
	
	//Function checking if the variable isn't empty
	function filled($variable)
	{
	  return isset($variable) && !empty($variable);
	}

	//Function to create university
	function createUniversity($uniName, $uniAddress, $tags) {
		global $mysqli;
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
		if (isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName']) ){
			$id = s($_SESSION['id']);
			//if(checkStatus($id) == 0){
				$query = "CALL delete_uni('$universityId');";
				$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			//}
		}
	}

	//Function to check user's status
	function checkStatus($id) {
		global $mysqli;
		$query = "CALL get_status('$id');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$fetch = mysqli_fetch_row($result);
		$stat = $fetch[0];
		return $stat;
	}

	//Function to create courses
	function createCourse($courseName,$start,$end,$courseAddress,$uniId) {
		global $mysqli;
		if ( isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName']) ){
			$id = s($_SESSION['id']);
			$query = "CALL check_course('$courseAddress');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			if(mysqli_fetch_row($result) != 0){		 //Course already exists
				return;
			}
			$result->close();
			$mysqli->next_result();

			$query = "CALL insert_course('$courseName', '$start', '$end', '$courseAddress', '$uniId');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			
			$query = "CALL check_course('$courseAddress');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			$fetch = mysqli_fetch_row($result);
			$cid = $fetch[0];
			$result->close();
			$mysqli->next_result();

			addLecturer($id, $cid);
				
		}
	}
	
	function deleteCourse($courseId){
		global $mysqli;
		if (isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName']) ){
			$id = s($_SESSION['id']);
			//if(checkStatus($id) == 0){
				$query = "CALL delete_course('$courseId');";
				$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			//}
		}
	}

	function editCourse($courseId, $lecturerId, $courseName, $courseStart, $courseEnd, $courseAdress, $uniId){
		global $mysqli;
		if (isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName']) and filled($courseId)){
			$id = s($_SESSION['id']);
			if(checkStatus($id) == 2){
				return;
			}
			//if($id == $lecturerId){
				if(filled($courseName)){
					$query = "CALL change_name('$cid','$courseName');";
					$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
					$result->close();
					$mysqli->next_result();
				} 
				if(filled($courseStart)){
					$query = "CALL change_start_date('$cid','$courseStart');";
					$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
					$result->close();
					$mysqli->next_result();
				}
				if(filled($courseEnd)){
					$query = "CALL change_end_date('$cid','$courseEnd');";
					$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
					$result->close();
					$mysqli->next_result();
				}
				if(filled($courseAddress)){
					$query = "CALL change_address('$cid','$courseAddress');";
					$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
					$result->close();
					$mysqli->next_result();
				}
				if(filled($uniId)){
					$query = "CALL change_uni('$cid','$uniId');";
					$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
					$result->close();
					$mysqli->next_result();
				}

			//}
		}
	}

	function addLecturer($id, $cid){
		global $mysqli;
		$stat = checkStatus($id);
			if($stat == 1){
				$query = "CALL change_lecturer('$cid','$id');";
				$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
				$result->close();
				$mysqli->next_result();
			}
	}

	//Function for students to enroll to the courses
	//Not used yet
	function enrollToCourse($courseAddress){
		global $mysqli;
		if (isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName'])){
			//$query = "CALL check_course('$courseAdress');";
			$query = "SELECT `id` FROM `courses` WHERE `courseAdress` = '$courseAddress'";
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
	
	function addProblemSet($name, $courseId, $deadline, $psAddress){
		global $mysqli;
		if (!(isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName']))) {
			return;
		}
		//TO DO:
		//Checking if the psAddress is on courseAddress website
		$query = "CALL get_course('$courseId');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		if(mysqli_num_rows($result) == 0) { // Course doesn't exist
				return;
		}
		$result->close();
		$mysqli->next_result();

		$query = "CALL check_ps('$psAddress');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		if(mysqli_num_rows($result) != 0) { // List already exists
				return;
		}
		$result->close();
		$mysqli->next_result();

		$query = "CALL insert_ps('$name', '$courseId', '$deadline', '$psAddress');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	}

	function editProblemSet($psid, $name, $courseId, $deadline, $psAddress){
		if (!(isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName']))){
			return;
		}
		$query = "CALL check_ps('$psAddress');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$result->close();
		$mysqli->next_result();

		if(mysqli_num_rows($result) == 0) { // List doesn't exists
				return;
		}
		if(filled($name)){
			$query = "CALL change_ps_name('$psid', '$name');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}
		if(filled($courseId)){
			$query = "CALL change_ps_course('$psid', '$courseId');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}
		if(filled($deadline)){
			$query = "CALL change_ps_deadline('$psid', '$deadline');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}
		if(filled($psAddress)){
			$query = "CALL change_ps_address('$psid', '$psAddress');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		}
	}

	function deleteProblemSet($psid,$cid){
		global $mysqli;
		if (!(isset($_SESSION['id']) and isset($_SESSION['firstName']) and isset($_SESSION['lastName']))){
			return;
		}
		$query = "CALL check_ps('$psAddress');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		if(mysqli_num_rows($result) == 0) { // List doesn't exists
				return;
		}
		$result->close();
		$mysqli->next_result();

		$id = s($_SESSION['id']);
		if(checkStatus($id) > 1) return;
		$query = "CALL delete_ps('$psid', '$cid');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
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