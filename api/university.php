<?php
require_once dirname(__FILE__).'/../inc/functions.php';
class University {

	public static $UNI_EXISTS = 2;
	public static $UNI_NOT_EXISTING = 3;
	public static $ADD_UNI_SUCCESS = 4;
	public static $DELETE_UNI_SUCCESS = 5;
	public static $EDIT_UNI_SUCCESS = 6;

	//Function to create university
	public static function createUniversity($uniName, $uniAddress, $tags, $mail) {
		global $mysqli;
		$uniName = s($uniName);
		$uniAddress = s($uniAddress);
		$tags = s($tags);
		$mail = s($mail);
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		$id = s($_SESSION['id']);
		if(s($_SESSION['uType']) != 0) 
			return User::$INSUFFICIENT_PRIVILEGE;

		$query = "CALL check_uni('$uniAddress')";
		$result = mysqli_query($mysqli, $query) or die(__FILE__.' @'.__LINE__.mysqli_error($mysqli));
		if(mysqli_fetch_row($result) != 0){
			mysqli_free_result($result);
			mysqli_next_result($mysqli);
			return University::$UNI_EXISTS;
		}
		mysqli_free_result($result);
		mysqli_next_result($mysqli);

		$query = "CALL insert_uni('$uniName','$uniAddress', '$tags')";
		$result = mysqli_query($mysqli, $query) or die(__FILE__.' @'.__LINE__.mysqli_error($mysqli));
		mysqli_next_result($mysqli);
		return University::$ADD_UNI_SUCCESS;
	}

	public static function deleteUniversity($universityId){
		global $mysqli;
		$universityId = s($universityId);
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		$id = s($_SESSION['id']);
		if(!filled($universityId)) 
			return User::$INVALID_DATA;
		if(checkStatus($id) != 0) 
			return User::$INSUFFICIENT_PRIVILEGE;

		$query = "CALL delete_uni('$universityId')";
		$result = mysqli_query($mysqli, $query) or die(__FILE__.' @'.__LINE__.mysqli_error($mysqli));
		//mysqli_free_result($result);
		mysqli_next_result($mysqli);
		return University::$DELETE_UNI_SUCCESS;
	}

	public static function editUniversity($uniId, $uniName = "", $uniAddress = "", $tags = "", $mail = ""){
		global $mysqli;
		$uniId = s($uniId);
		$uniName = s($uniName);
		$uniAddress = s($uniAddress);
		$tags = s($tags);
		$mail = s($mail);
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");
		$id = s($_SESSION['id']);
		if(!filled($universityId)) 
			return User::$INVALID_DATA;
		if(checkStatus($id) != 0) 
			return User::$INSUFFICIENT_PRIVILEGE;
		
		updateField("name", $uniId, $uniName);
		updateField("address", $uniId, $uniAddress);
		updateField("tags", $uniId, $tags);
		updateField("tags", $uniId, $mail);
		return University::$EDIT_UNI_SUCCESS;
	}

	private static function updateField($field, $uniId, $value){
		global $mysqli;
		$field = s($field);
		$uniId = s($uniId);
		$value = s($value);
		if(!isSessionSet()) 
			throw new Exception("Session wasn't set.");

		if(!(filled($field)&&filled($uniId)&&filled($value))) 
			return User::$INVALID_DATA;

		$query = "CALL change_uni_".$field."('$uniId', '$value')";
		$result = mysqli_query($mysqli, $query) or die(__FILE__.' @'.__LINE__.mysqli_error($mysqli));
		mysqli_free_result($result);
		mysqli_next_result($mysqli);
		return University::$UPDATE_FIELD_SUCCESS;
	}

}
?>