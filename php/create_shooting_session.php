<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $archer = $_POST['archer'];
  $competition = $_POST['competition'];
  $round = $_POST['round'];
  $division = $_POST['division'];
  $class = $_POST['class'];

  // Fetch additional information for the redirect
  $archerNameQuery = $conn->query("SELECT Name FROM Archer WHERE Id = '$archer'");
  $archerNameRow = $archerNameQuery->fetch_assoc();
  $archerName = $archerNameRow['Name'];

  $competitionNameQuery = $conn->query("SELECT Name FROM Competition WHERE Id = '$competition'");
  $competitionNameRow = $competitionNameQuery->fetch_assoc();
  $competitionName = $competitionNameRow['Name'];

  $sql = "INSERT INTO ShootingSession (ArcherId, CompetitionId, RoundName, Division, Class) 
          VALUES ('$archer', '$competition', '$round', '$division', '$class')";

  if ($conn->query($sql) === TRUE) {
    $session_id = $conn->insert_id;
    header("Location: ../create_end.html?session_id=$session_id&archer_id=$archer&archer_name=$archerName&competition_name=$competitionName&round_name=$round&division_name=$division&class_name=$class");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
