<?php
require_once dirname(__FILE__).'/inc/functions.php';
User::logout();
header('Location: index.php');
?>