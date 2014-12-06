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

		default:
			# code...
			break;
	}

?>