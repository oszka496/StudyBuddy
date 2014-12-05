<?php
global $mysqli;
$mysqli = mysqli_connect('localhost', 'root', 'jakieshaslo', 'studybuddy') or die(mysqli_error($mysqli));
?>