<?php
include 'inc/functions.php';
User::logout();
header('Location: index.php');
?>