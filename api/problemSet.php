<?php
require_once dirname(__FILE__).'/../inc/functions.php';
class ProblemSet {

	public static $PS_EXISTS = 2;
	public static $PS_NOT_FOUND = 3;
	public static $UPDATE_FIELD_SUCCESS = 4;
	public static $UPDATE_PS_SUCCESS = 5;
	public static $ADD_PS_SUCCESS = 6;
	public static $DELETE_PS_SUCCESS = 7;

	private static function checkPS($psAddress){
		global $mysqli;
		$query = "CALL check_ps('$psAddress');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$out = mysqli_num_rows($result);
		$result->close();
		$mysqli->next_result();
		return $out;
	}

	private static function updateField($field, $psid, $value){
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");

		if(!(filled($field)&&filled($psid)&&filled($value)))
			return User::$INVALID_DATA;

		$query = "CALL change_ps_".$field."('$psid', '$value');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$result->close();
		$mysqli->next_result();
		return ProblemSet::$UPDATE_FIELD_SUCCESS;
	}

	public static function addProblemSet($name, $courseId, $deadline, $psAddress){
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		$name = s($name);
		$courseId = s($courseId);
		$deadline = s($deadline);
		$psAddress = s($psAddress);
		//TO DO:
		//Checking if the psAddress is on courseAddress website
		$query = "CALL get_course('$courseId');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		if(mysqli_num_rows($result) == 0) { // Course doesn't exist
				return Course::$COURSE_NOT_FOUND;
		}
		$result->close();
		$mysqli->next_result();
		if(ProblemSet::checkPS($psAddress) != 0)
			return ProblemSet::$PS_EXISTS;
		$query = "CALL insert_ps('$name', '$courseId', '$deadline', '$psAddress');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		return ProblemSet::$ADD_PS_SUCCESS;
	}

	public static function editProblemSet($psid, $name = "", $courseId = "", $deadline = "", $psAddress = ""){
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		$psid = s($psid);
		$name = s($name);
		$courseId = s($courseId);
		$deadline = s($deadline);
		$psAddress = s($psAddress);

		if(ProblemSet::checkPS() == 0) 
			return ProblemSet::$PS_NOT_FOUND;
		updateField("name", $psid, $name);
		updateField("course", $psid, $courseId);
		updateField("deadline", $psid, $deadline);
		updateField("address", $psid, $psAddress);
		return ProblemSet::$UPDATE_PS_SUCCESS;
	}

	public static function deleteProblemSet($psid,$cid){
		global $mysqli;
		$psid = s($psid);
		$cid = s($cid);
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		if(ProblemSet::checkPS() == 0) 
			return ProblemSet::$PS_NOT_FOUND;

		$id = s($_SESSION['id']);
		if(checkStatus($id) > 1) 
			return User::$INSUFICIENT_PRIVIILEGE;
		$query = "CALL delete_ps('$psid', '$cid');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		return ProblemSet::$DELETE_PS_SUCCESS;
	}
}

?>