<?php
	header('Content-Type: text/html; charset=utf-8');
	include 'inc/functions.php';
	//sql_multi_parse('sql/user.sql');
	//sql_multi_parse('sql/university.sql');
	sql_multi_parse('sql/courses.sql');
	//sql_multi_parse('sql/enrolled.sql');
?>