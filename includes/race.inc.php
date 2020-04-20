<?php
  session_start();
  if (isset($_POST['timeButton'])) {

    require 'dbh.inc.php';

    $uID = intval($_GET['ID']);

    $laps = $_POST['lapField'];
    $time = $_POST['timeField'];
    $fastest = $_POST['speedField'];
    $date = $_POST['dateField'];

    if(empty($time) || empty($date) || empty($fastest)|| empty($laps)){
      header("Location: ../addrace.php?error=missingfields&ID=$uID");
      exit();
    }
    else {
      $sql = "INSERT INTO race(userID, rtime, laps, fastest, rdate) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../addrace.php?error=SQLError&ID=$uID");
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt, "sssss", $uID, $time, $laps, $fastest, $date);
        mysqli_stmt_execute($stmt);
        header("Location: ../addrace.php?submit=success&ID=".$uID);
        exit();
      }
    }


  }
  else {
    header("Location: ../index.php");
    exit();
  }

?>
