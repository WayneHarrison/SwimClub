<?php

if(isset($_POST['loginButton'])) {

  require 'dbh.inc.php';

  $email = $_POST['emailField'];
  $password = $_POST['passwordField'];

  if (empty($email)) {
    header("Location: ../index.php?error=missingemail");
    exit();
  }
  else if (empty($password)) {
    header("Location: ../index.php?error=missingpassword");
    exit();
  }
    else{
      $sql ="SELECT * FROM users WHERE email=?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=SQLError");
        exit();
      }
      else {

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $pwdCheck = password_verify($password, $row['password']);
            if ($pwdCheck == false) {
              header("Location: ../index.php?error=WrongPassword");
              exit();
            }
            else if ($pwdCheck == true) {
              session_start();
              $_SESSION['usersID'] = $row['id'];
              $_SESSION['usersName'] = $row['name'];
              $_SESSION['usersAcc'] = $row['accountType'];

              header("Location: ../index.php?login=success");
              exit();
            }
            else {
              header("Location: ../index.php?error=WrongPassword");
              exit();
            }
        }
        else {
          header("Location: ../index.php?error=NoUser");
          exit();
        }

      }
    }
}
else {
  header("Location: ../index.php");
  exit();
}
