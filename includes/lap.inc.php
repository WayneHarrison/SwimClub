<?php
  session_start();
  if (isset($_POST['timeButton'])) {

    require 'dbh.inc.php';

    $uID = $_SESSION['usersID'];

    $time = $_POST['timeField'];
    $date = $_POST['dateField'];

    if(empty($time) || empty($date)){
      header("Location: ../stats.php?error=missingfields");
      exit();
    }
    else {
      $sql = "INSERT INTO laps(uid, lapTime, lapDate) VALUES (?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../stats.php?error=SQLError");
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt, "sss", $uID, $time, $date);
        mysqli_stmt_execute($stmt);
        header("Location: ../stats.php?submit=success".$uID.$time.$date);
        exit();
      }
    }


  }
  else {
    header("Location: ../stats.php");
    exit();
  }

?>
