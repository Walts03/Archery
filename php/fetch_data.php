<?php
include 'db_connect.php';

$type = $_GET['type'];
$data = [];

switch ($type) {
  case 'archers':
    $result = $conn->query("SELECT Id AS value, Name AS text FROM Archer");
    break;
  case 'competitions':
    $result = $conn->query("SELECT Id AS value, Name AS text FROM Competition");
    break;
  case 'rounds':
    $result = $conn->query("SELECT Name AS value, Name AS text FROM Round");
    break;
  case 'divisions':
    $result = $conn->query("SELECT ACR AS value, Name AS text FROM Division");
    break;
  case 'classes':
    $result = $conn->query("SELECT Name AS value, Name AS text FROM Class");
    break;
  case 'sessions':
    $result = $conn->query("SELECT Id AS value, Id AS text FROM ShootingSession");
    break;
  case 'distances':
    $result = $conn->query("SELECT Dist AS value, Dist AS text FROM Distance");
    break;
  case 'shootingRanges':
    $result = $conn->query("SELECT EndNo AS value, EndNo AS text FROM ShootingRange");
    break;
  default:
    $result = null;
}

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

echo json_encode($data);

$conn->close();
