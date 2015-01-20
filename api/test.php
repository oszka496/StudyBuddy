<?php
	$arr = json_decode('{"credentials":{"login":"admin","hash":"1234"},"request":{"type":"delete","content":{"email":"abc"}}}', true);
	var_dump($arr);
?>