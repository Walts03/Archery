<?php
include 'db_connect.php';

$session_id = $_GET['session_id'];

$totalScoreQuery = $conn->query("SELECT SUM(Arrow1 + Arrow2 + Arrow3 + Arrow4 + Arrow5 + Arrow6) AS total_score FROM End WHERE ShootingSessionId = '$session_id'");
$totalScoreRow = $totalScoreQuery->fetch_assoc();

echo json_encode(['total_score' => $totalScoreRow['total_score']]);

$conn->close();
