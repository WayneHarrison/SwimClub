<?php
session_start();
  if(ISSET($_POST['deleteSwimmer'])){
    require 'dbh.inc.php';
    $id = $_GET['ID'];

    $sql = "UPDATE users SET cID = NULL WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../myswimmers.php?error=SQLError");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $id);
      mysqli_stmt_execute($stmt);
      header("Location: ../myswimmers.php?delete=success");
      exit();
    }

  }
  elseif(ISSET($_POST['deleteChild'])){
    require 'dbh.inc.php';
    $id = $_GET['ID'];

    $sql ="DELETE users, laps, race FROM users LEFT JOIN laps on users.id = laps.uid LEFT join race on users.id = race.userID where users.id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../child.php?error=SQLError");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $id);
      mysqli_stmt_execute($stmt);
      header("Location: ../child.php?delete=success");
      exit();
    }
  }
  elseif(ISSET($_POST['deleteUser'])){
    require 'dbh.inc.php';
    $id = $_GET['ID'];

    $sql ="DELETE users, laps, race FROM users LEFT JOIN laps on users.id = laps.uid LEFT join race on users.id = race.userID where users.id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../users.php?error=SQLError");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $id);
      mysqli_stmt_execute($stmt);
      header("Location: ../users.php?delete=success");
      exit();
    }
  }
  else{
    header("Location: ../index.php");
    exit();
  }

 ?>
