<?php
	include 'functions.php';
	$q = "CALL suggest('".s($_GET['input'])."');";
	$sql = mysqli_query($mysqli,$q) or die(__FILE__." (".__LINE__.")".": ".mysqli_error($mysqli));
	$i=0;
	$results = array();
	while ($r = mysqli_fetch_row($sql)) {
		$results[$i] = $r;
		$i++;
	}

	$input = strtolower( $_GET['input'] );
	$len = strlen($input);
	$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
	
	$aResults = array();
	$count = 0;
	
	if ($len)
	{
		for ($i=0;$i<count($results);$i++)
		{
			$count++;
			$aResults[] = array( "id"=>htmlspecialchars($results[$i][0]),
								"name"=>htmlspecialchars($results[$i][1]),
								"address"=>htmlspecialchars($results[$i][2]),
								"tags"=>htmlspecialchars($results[$i][3])
			);
			
			if ($limit && $count==$limit)
				break;
		}
	}
	
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
	
	
	
	if (isset($_REQUEST['json']))
	{
		header("Content-Type: application/json");
	
		echo "{\"results\": [";
		$arr = array();
		for ($i=0;$i<count($aResults);$i++)
		{
			$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"name\": \"".$aResults[$i]['name']."\", \"address\": \"".$aResults[$i]['address']."\", \"tags\": \"".$aResults[$i]['tags']."\"}";
		}
		echo implode(", ", $arr);
		echo "]}";
	}
	else
	{
		header("Content-Type: text/xml");
		echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		echo "<results>";
		for ($i=0;$i<count($aResults);$i++)
		{
			echo "<rs id=\"".$aResults[$i]['id']."\" address=\"".$aResults[$i]['address']."\" tags=\"".$aResults[$i]['tags']."\">".$aResults[$i]['name']."</rs>";
		}
		echo "</results>";
	}
?>