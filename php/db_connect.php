<?php
$servername = "feenix-mariadb.swin.edu.au";
$username = "cos20031_48";
$password = "s4PPPEmpJM";
$dbname = "cos20031_48_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
