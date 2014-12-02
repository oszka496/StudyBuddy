<?php
require_once dirname(__FILE__).'\..\inc\functions.php';
	class ProblemSet{
	$PS_EXISTS = 0;
	$PS_NOT_FOUND = 1;

	private static checkPS(){
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
		if(!(filled($field)&&filled($psid)&&filled($value))) return;

		$query = "CALL change_ps_".$field."('$psid', '$value');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$result->close();
		$mysqli->next_result();
		
	}
	public static function addProblemSet($name, $courseId, $deadline, $psAddress){
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		//TO DO:
		//Checking if the psAddress is on courseAddress website
		$query = "CALL get_course('$courseId');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		if(mysqli_num_rows($result) == 0) { // Course doesn't exist
				return;
		}
		$result->close();
		$mysqli->next_result();
		if(ProblemSet::checkPS() != 0) return $PS_EXISTS = 0;
		$query = "CALL insert_ps('$name', '$courseId', '$deadline', '$psAddress');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	}

	public static function editProblemSet($psid, $name, $courseId, $deadline, $psAddress){
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");

		if(ProblemSet::checkPS() == 0) return $PS_NOT_FOUND;
		updateField("name", $psid, $name);
		updateField("course", $psid, $courseId);
		updateField("deadline", $psid, $deadline);
		updateField("address", $psid, $psAddress);
	}

	function deleteProblemSet($psid,$cid){
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		if(ProblemSet::checkPS() == 0) return $PS_NOT_FOUND;

		$id = s($_SESSION['id']);
		if(checkStatus($id) > 1) return User::$INSUFICIENT_PRIVIILEGE;
		$query = "CALL delete_ps('$psid', '$cid');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	}
	}

?>