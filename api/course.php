<?php
class Course 
{
	public static $COURSE_ADDED = 1;
	public static $COURSE_ALREADY_EXISTS = 2;
	public static $COURSE_NOT_FOUND = 3;
	public static $COURSE_DELETED = 4;
	public static $COURSE_JOINED = 5;
	public static $COURSE_LEAVED = 6;

	public static function addCourse($name, $address, $universityId, $startDate, $endDate)
	{
		global $mysqli;
		$name = s($name);
		$address = s($address);
		$universityId = s($universityId);
		$startDate = s($startDate);
		$endDate = s($endDate);
		if (!isSessionSet())
			throw new Exception("Session wasn't set.");

		$id = s($_SESSION['id']);
		$query = "CALL check_course('$address');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		if(mysqli_fetch_row($result) != 0){		 
			return Course::$COURSE_ALREADY_EXISTS;
		}
		$result->close();
		$mysqli->next_result();

		$query = "CALL insert_course('$name', '$startDate', '$endDate', '$address', '$universityId');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$cid = $mysqli->insert_id;
		
		Course::addLecturer($id, $cid);
		return Course::$COURSE_ADDED;
	}

	public static function deleteCourse($courseId)
	{
		global $mysqli;
		$courseId = s($courseId);
		if (!isSessionSet())
			throw new Exception("Session wasn't set.");

		$id = s($_SESSION['id']);
		if(checkStatus($id) == 0){
			$query = "CALL delete_course('$courseId');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		} else 
			return User::$INSUFFICIENT_PRIVILEGE;

		return Course::$COURSE_DELETED;
	}

	private static function updateField($field, $cid, $value)
	{
		global $mysqli;
		if(!(filled($field)&&filled($psid)&&filled($value)))
			return User::$INVALID_DATA;

		$query = "CALL change_".$field."('$cid','$value');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$result->close();
		$mysqli->next_result();
	}

	public static function editCourse($courseId, $lecturerId = "", $courseName = "", $courseStart = "",
														$courseEnd = "", $courseAdress = "", $uniId = ""){
		if(!isSessionSet())
			throw new Exception("Session wasn't set.");
		
		$id = s($_SESSION['id']);
		$utype = s($_SESSION['uType']);

		$courseId = s($courseId);
		$lecturerId = s($lecturerId);
		$courseName = s($courseName);
		$courseEnd = s($courseEnd);
		$courseAdress = s($courseAdress);
		$uniId = s($uniId);

		if($utype == 2){
			return User::$INSUFFICIENT_PRIVILEGE;
		}
		if($id == $lecturerId || $utype == 0){
			Course::updateField("name", $cid, $courseName);
			Course::updateField("start_date", $cid, $courseStart);
			Course::updateField("end_date", $cid, $courseEnd);
			Course::updateField("address", $cid, $courseAddress);
			Course::updateField("uni", $cid, $uniId);
		}
	}

	public static function getAdressById($cid){
		global $mysqli;
		$cid = s($cid);

		$query = "CALL get_course('$cid');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		
		if(mysqli_num_rows($result) == 0) 
			return Course::$COURSE_NOT_FOUND;
		
		$out = mysqli_fetch_row($result)[5];
		$mysqli->next_result();
		$result->close();
		return $out;
	}

	//Function for students to enroll to the courses
	public static function enrollToCourse($courseAddress){
		global $mysqli;
		$courseAddress = s($courseAddress);
		if(!isSessionSet())
			throw new Exception("Session wasn't set.");
		
		$query = "CALL check_course('$courseAddress');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		
		if(mysqli_num_rows($result) == 0) 
			return Course::$COURSE_NOT_FOUND;
		
		$courseId = mysqli_fetch_row($result)[0];
		$userId = s($_SESSION['id']);
		
		$mysqli->next_result();
		$result->close();
		$query = "CALL choose_course('$userId', '$courseId');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		return Course::$COURSE_JOINED;
	}

	private static function addLecturer($id, $cid){
		global $mysqli;
		$stat = checkStatus($id);
		if($stat == 1){
			$query = "CALL change_lecturer('$cid','$id');";
			$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
			$result->close();
			$mysqli->next_result();
		}
	}

	public static function resignFromCourse($cid){
		global $mysqli;
		if(!isSessionSet())
			throw new Exception("Session wasn't set.");
		$id = s($_SESSION['id']);
		$cid = s($cid);
		$query = "CALL resign_from_course('$id', '$cid');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		return Course::$COURSE_LEAVED;
	}
}
?>