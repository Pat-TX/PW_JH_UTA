<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "company";

$connection = mysqli_connect($host, $username, $password, $dbname);

if (!$connection)
{
    die("Database connection failed: " . mysqli_connect_error());
}

?>