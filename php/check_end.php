<?php
include 'db_connect.php';

// This is a simplified example. Replace it with your own logic to check if more ends are needed.
$sessionId = $_GET['session_id'];
$maxEnds = 10;  // Assume each session requires a maximum of 10 ends.

$sql = "SELECT COUNT(*) AS end_count FROM End WHERE ShootingSessionId = $sessionId";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$endsNeeded = $row['end_count'] < $maxEnds;

echo json_encode(['ends_needed' => $endsNeeded]);

$conn->close();
