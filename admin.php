<!DOCTYPE html>
<html>
<head>
<style>
body {
	font-family: sans-serif;
	font-size: 11px;
}
p {
	margin: 3px 10px;
}
.ok {
	border-left: 4px solid #090;
	color: #0b0;
	padding: 3px;
	margin: 0;
}
.fail {
	border-left: 4px solid #900;
	color: #b00;
	padding: 3px;
	margin: 0;
}
</style>
</head>
<body>
<?php
	header('Content-Type: text/html; charset=utf-8');
	include 'inc/functions.php';
	//sql_multi_parse('sql/drops.sql');
	sql_multi_parse('sql/suggest.sql');
	sql_multi_parse('sql/user.sql');
	sql_multi_parse('sql/university.sql');
	sql_multi_parse('sql/courses.sql');
	sql_multi_parse('sql/enrolled.sql');
	sql_multi_parse('sql/problemset.sql');
?>
</body>
</html>