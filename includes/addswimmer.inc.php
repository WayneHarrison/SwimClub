<?php
  session_start();
  if (isset($_POST['addSwimmer'])) {

    require 'dbh.inc.php';

    $uID = $_SESSION['usersID'];
    $swimmerID = $_GET['ID'];



      $sql = "UPDATE users SET cID = ? WHERE id = $swimmerID";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../myswimmers.php?error=SQLError");
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt, "s", $uID);
        mysqli_stmt_execute($stmt);
        header("Location: ../myswimmers.php?submit=success".$uID.$swimmerID);
        exit();
      }


  }
  else {
    header("Location: ../profilecoach.php");
    exit();
  }

?>
