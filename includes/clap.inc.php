<?php
  session_start();
  if (isset($_POST['timeButton'])) {

    require 'dbh.inc.php';

    $uID = intval($_GET['ID']);

    $time = $_POST['timeField'];
    $date = $_POST['dateField'];

    if(empty($time) || empty($date)){
      header("Location: ../childinfo.php?error=missingfields&ID=".$uID);
      exit();
    }
    else {
      $sql = "INSERT INTO laps(uid, lapTime, lapDate) VALUES (?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../childinfo.php?error=SQLError&ID=".$uID);
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt, "sss", $uID, $time, $date);
        mysqli_stmt_execute($stmt);
        header("Location: ../childinfo.php?submit=success&ID=".$uID);
        exit();
      }
    }


  }
  else {
    header("Location: ../childinfo.php&ID=".$uID);
    exit();
  }

?>
