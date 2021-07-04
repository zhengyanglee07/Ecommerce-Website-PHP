<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = 'noblephoenix';

$conn = @mysqli_connect($hostname, $username, $password,$database) OR
die ('Could not connect to MySQL: '.mysqli_connect_error());

?>