<?php
$host = "localhost";
$user = "root";
$pass = "shree@2005";
$db   = "server";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("Database connection failed");
}
?>
