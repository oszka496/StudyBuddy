<?php
require_once 'inc/functions.php';
User::logout();
header('Location: index.php');
?>