<?php
	require_once '../inc/functions.php';
	if (!isset($_POST['request']))
		header('HTTP/1.1 400 Missing data', true, 400);

	function respond($responseCode, $response)
	{
		$json = json_encode(array('responseCode' => $responseCode, 'response' => $response));
		echo $json;
		exit();
	}

	function auth($login, $hash)
	{
		$authentication = User::login($login, $hash);
		if ($authentication == User::$AUTHENTICATION_FAILURE)
		{
			respond("-1", "Failed to authenticate.");
		}
	}

	$requestVar = s($_POST['request']);
	$requestData = json_decode($requestVar, true);
	$request = $requestData["request"];
	$requestType = $request["type"];
	$requestContent = $request["content"];

	

	switch ($requestType) {
		case 'login':
			$result = User::login($requestContent["login"], $requestContent["password"], true);
			respond($result[0], $result[1]);
			break;
		
		case 'register':
			$result = User::register($requestContent["email"], $requestContent["password"], $requestContent["password2"],
					$requestContent["firstname"], $requestContent["lastname"], $requestContent["usertype"]);
			respond($result, "");
			break;

		case 'userdelete':
			$credentials = $requestData["credentials"];
			auth($credentials['login'], $credentials['hash']);
			try
			{
				$result = User::deleteUser($requestContent["email"]);
				respond($result, "");
			}
			catch (Exception $e)
			{
				respond("-1", "EXCEPTION: ".$e->getMessage());
			}
			break;

		case 'addcourse':
			$credentials = $requestData["credentials"];
			auth($credentials['login'], $credentials['hash']);
			try
			{
				$result = Course::addCourse($requestContent["name"], $requestContent["address"],
					$requestContent["universityid"], $requestContent["startdate"], $requestContent["enddate"]);
				respond($result, "");
			}
			catch (Exception $e)
			{
				respond("-1", "EXCEPTION: ".$e->getMessage());
			}
			break;

		case 'deletecourse':
			$credentials = $requestData["credentials"];
			auth($credentials['login'], $credentials['hash']);
			try
			{
				$result = Course::deleteCourse($requestContent["courseid"]);
				respond($result, "");
			}
			catch (Exception $e)
			{
				respond("-1", "EXCEPTION: ".$e->getMessage());
			}
			break;


		case 'updatefield':
			$credentials = $requestData["credentials"];
			auth($credentials['login'], $credentials['hash']);
			try
			{
				$result = Course::updateField($requestContent["field"], $requestContent["courseid"],
					$requestContent["value"]);
				respond($result, "");
			}
			catch (Exception $e)
			{
				respond("-1", "EXCEPTION: ".$e->getMessage());
			}
			break;

		case 'editcourse':
			$credentials = $requestData["credentials"];
			auth($credentials['login'], $credentials['hash']);
			try
			{
				$result = Course::editCourse($requestContent["courseid"], $requestContent["lecturerid"],
					$requestContent["coursename"], $requestContent["coursestart"], $requestContent["courseend"],
					$requestContent["courseaddress"], $requestContent["universityid"]);
				respond($result, "");
			}
			catch (Exception $e)
			{
				respond("-1", "EXCEPTION: ".$e->getMessage());
			}
			break;

		case 'getaddressbyid':
			$credentials = $requestData["credentials"];
			auth($credentials['login'], $credentials['hash']);
			try
			{
				$result = Course::getAdressById($requestContent["courseid"]);
				respond($result, "");
			}
			catch (Exception $e)
			{
				respond("-1", "EXCEPTION: ".$e->getMessage());
			}
			break;

		case 'enrolltocourse':
			$credentials = $requestData["credentials"];
			auth($credentials['login'], $credentials['hash']);
			try
			{
				$result = Course::enrollToCourse($requestContent["courseaddress"]);
				respond($result, "");
			}
			catch (Exception $e)
			{
				respond("-1", "EXCEPTION: ".$e->getMessage());
			}
			break;

		case 'createuniversity':
			$credentials = $requestData["credentials"];
			auth($credentials['login'], $credentials['hash']);
			try
			{
				$result = Course::createUniversity($requestContent["universityname"],
					$requestContent["universityaddress"], $requestContent["tags"],
					$requestContent["universitymail"]);
				respond($result, "");
			}
			catch (Exception $e)
			{
				respond("-1", "EXCEPTION: ".$e->getMessage());
			}
			break;

		case 'deleteuniversity':
			$credentials = $requestData["credentials"];
			auth($credentials['login'], $credentials['hash']);
			try
			{
				$result = Course::deleteUniversity($requestContent["universityid"]);
				respond($result, "");
			}
			catch (Exception $e)
			{
				respond("-1", "EXCEPTION: ".$e->getMessage());
			}
			break;

		case 'edituniversity':
			$credentials = $requestData["credentials"];
			auth($credentials['login'], $credentials['hash']);
			try
			{
				$result = Course::editUniversity($requestContent["universityid"].
					$requestContent["universityname"], $requestContent["universityaddress"],
					$requestContent["tags"], $requestContent["universitymail"]);
				respond($result, "");
			}
			catch (Exception $e)
			{
				respond("-1", "EXCEPTION: ".$e->getMessage());
			}
			break;

		default:
			# code...
			break;
	}

?>