<?php
session_start();
if (isset($_POST['editButton'])){
  $uID = $_SESSION['usersID'];
  require 'dbh.inc.php';

  $address = $_POST['editAddress'];
  $postcode = $_POST['editPostcode'];
  $phone = $_POST['editPhone'];

  if (empty($address) || empty($postcode) || empty($phone)){
      header("Location: ../profileedit.php?error=emptyfields&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
      exit();
    }
    else if (!preg_match("/^[0-9]*$/", $phone)){
      header("Location: ../profileedit.php?error=incorrectphone");
      exit();
    }
    else {
      $sql = "UPDATE users SET address = ?, postcode = ?, phone = ? WHERE id = $uID";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../profileedit.php?error=SQLError&".$uID);
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "sss", $address, $postcode, $phone);
        mysqli_stmt_execute($stmt);
        header("Location: ../profileedit.php?edit=success");
        exit();
      }



    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
elseif(isset($_POST['childEditButton'])) {
  $uID = intval($_GET['ID']);
  require 'dbh.inc.php';

  $address = $_POST['editAddress'];
  $postcode = $_POST['editPostcode'];
  $phone = $_POST['editPhone'];
  $accType = $_POST['editAcc'];

  if (empty($address) || empty($postcode) || empty($phone)){
      header("Location: ../childedit.php?error=emptyfields&phone=".$phone."&address".$address."&postcode".$postcode);
      exit();
    }
    else if (!preg_match("/^[0-9]*$/", $phone)){
      header("Location: ../childedit.php?error=incorrectphone");
      exit();
    }
    else {
      $sql = "UPDATE users SET address = ?, postcode = ?, phone = ?, accountType WHERE id = $uID";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../childedit.php?error=SQLError&".$uID);
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssss", $address, $postcode, $phone, $accType);
        mysqli_stmt_execute($stmt);
        header("Location: ../childedit.php?edit=success");
        exit();
      }

    }
  }
else {
  header("Location: ../index.php");
}






?>
