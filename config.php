<?php
$host = 'localhost';
$user = 'root';
$pass = 'password';
$db_name = 'test';
$site_name = 'my_site.loc:7000';
$link = mysqli_connect($host, $user, $pass, $db_name) or die(mysqli_error($link));
?>
