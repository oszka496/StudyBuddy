<?php
require_once 'inc/functions.php';
$autho = User::authenticate("admin@test.com", "$2y$10$7o3BEqjEAA9kASxI2xzx3uY9BVlJEWwSnSoh.W0Pv6naeM/O5aoHO");
echo $autho;
?>