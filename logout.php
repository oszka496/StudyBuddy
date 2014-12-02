<?php
require_once dirname(__FILE__).'/../functions.php';
User::logout();
header('Location: index.php');
?>