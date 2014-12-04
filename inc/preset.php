<?php
	header('Content-Type: text/html; charset=utf-8');
	include 'functions.php';

	// echo User::register('student@test.com', 'teststudent', 'teststudent', 'Test', 'Student', 2);
	// echo User::register('teacher@test.com', 'testteacher', 'testteacher', 'Test', 'Teacher', 1);
	// echo User::register('admin@test.com', 'testadmin', 'testadmin', 'Test', 'Admin', 0);

	University::createUniversity('Politechnika Wrocławska', 'http://www.pwr.wroc.pl/index.dhtml', 'Politechnika, Wrocławska', '@pwr.edu.pl')
?>

