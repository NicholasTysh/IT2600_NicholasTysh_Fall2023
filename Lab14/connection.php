<!-- REMOVE HARD CODED PASS -->
<?php

$servername = "localhost";
$username = "root";
// Include your password here
$password = "e75if/T8]y2e(At3";
$dbname = "it1150";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
