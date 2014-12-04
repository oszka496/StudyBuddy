<?php
require_once dirname(__FILE__).'\..\inc\functions.php';
class University {

	public static $UNI_EXISTS = 2;
	public static $UNI_NOT_EXISTING = 3;
	public static $ADD_UNI_SUCCESS = 4;
	public static $DELETE_UNI_SUCCESS = 5;
	public static $EDIT_UNI_SUCCESS = 6;

	//Function to create university
	public static function createUniversity($uniName, $uniAddress, $tags, $mail) {
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		$id = s($_SESSION['id']);
		//if(checkStatus($id) != 0) return User::$INSUFFICIENT_PRIVILEGE;

		$query = "CALL check_uni('$uniAddress');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		if(mysqli_fetch_row($result) != 0){
			return University::$UNI_EXISTS;
		}
		$result->close();
		$mysqli->next_result();
		$query = "CALL insert_uni('$uniName','$uniAddress', '$tags', $mail);";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		return University::$ADD_UNI_SUCCESS;
	}

	public static function deleteUniversity($universityId){
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		$id = s($_SESSION['id']);
		if(!filled($universityId)) return User::$INVALID_DATA;
		//if(checkStatus($id) != 0) return User::$INSUFFICIENT_PRIVILEGE;

		$query = "CALL delete_uni('$universityId');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		return University::$DELETE_UNI_SUCCESS;
	}

	public static function editUniversity($uniId, $uniName, $uniAddress, $tags, $mail){
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		$id = s($_SESSION['id']);
		if(!filled($universityId)) return User::$INVALID_DATA;
		//if(checkStatus($id) != 0) return User::$INSUFFICIENT_PRIVILEGE;
		if(filled($uniName)) updateField("name", $uniId, $uniName);
		if(filled($uniAddress)) updateField("address", $uniId, $uniAddress);
		if(filled($tags)) updateField("tags", $uniId, $tags);
		if(filled($mail)) updateField("tags", $uniId, $mail);
		return University::$EDIT_UNI_SUCCESS;
	}

	private static function updateField($field, $uniId, $value){
		global $mysqli;
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");

		if(!(filled($field)&&filled($uniId)&&filled($value))) return User::$INVALID_DATA;

		$query = "CALL change_uni_".$field."('$uniId', '$value');";
		$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		$result->close();
		$mysqli->next_result();
		return University::$UPDATE_FIELD_SUCCESS;
	}

}
?>