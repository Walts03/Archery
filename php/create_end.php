<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $session = $_POST['session'];
  $distance = $_POST['distance'];
  $shootingRange = $_POST['shootingRange'];
  $arrow1 = $_POST['arrow1'];
  $arrow2 = $_POST['arrow2'];
  $arrow3 = $_POST['arrow3'];
  $arrow4 = $_POST['arrow4'];
  $arrow5 = $_POST['arrow5'];
  $arrow6 = $_POST['arrow6'];

  $scores = [$arrow1, $arrow2, $arrow3, $arrow4, $arrow5, $arrow6];
  for ($i = 0; $i < count($scores) - 1; $i++) {
    if ($scores[$i] < $scores[$i + 1]) {
      die('Scores must be entered in descending order.');
    }
  }

  $sql = "INSERT INTO End (ShootingSessionId, Dist, ShootingRange, Arrow1, Arrow2, Arrow3, Arrow4, Arrow5, Arrow6) 
          VALUES ('$session', '$distance', '$shootingRange', '$arrow1', '$arrow2', '$arrow3', '$arrow4', '$arrow5', '$arrow6')";

  if ($conn->query($sql) === TRUE) {
    // Calculate total score
    $totalScoreQuery = $conn->query("SELECT SUM(Arrow1 + Arrow2 + Arrow3 + Arrow4 + Arrow5 + Arrow6) AS total_score FROM End WHERE ShootingSessionId = '$session'");
    $totalScoreRow = $totalScoreQuery->fetch_assoc();
    $totalScore = $totalScoreRow['total_score'];

    header("Location: ../create_end.html?session_id=$session&archer_id={$_POST['archer']}&total_score=$totalScore");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
