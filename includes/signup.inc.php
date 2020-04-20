<?php
if (isset($_POST['registerButton'])) {

  require 'dbh.inc.php';

  $uname = $_POST['uname'];
  $name = $_POST['name'];
  $address = $_POST['address'];
  $postcode = $_POST['postcode'];
  $dob = $_POST['dob'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $accType = $_POST['accType'];

  $_age = floor((time() - strtotime($dob)) / 31556926);

  //error handlers
    if (empty($uname) ||empty($name) || empty($address) || empty($postcode) || empty($dob) || empty($phone) || empty($email) || empty($password) || empty($cpassword) || empty($accType)){
        header("Location: ../register.php?error=emptyfields&uname".$uname."&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
        exit();
      }
          else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          header("Location: ../register.php?error=invalidmail&name=".$name."&address".$address."&postcode".$postcode);
          exit();
          }
            else if (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
            header("Location: ../register.php?error=invalidname&address="."&address".$address."&postcode".$postcode."&email".$email);
            exit();
            }
            else if ($_age < 18){
              header("Location: ../register.php?error=young&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
              exit();
            }
            else if (!preg_match("/^[-0-9]*$/", $dob)){
              header("Location: ../register.php?error=incorrectdob&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
              exit();
            }
              else if (!preg_match("/^[0-9]*$/", $phone)){
                header("Location: ../register.php?error=incorrectphone&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
                exit();
              }
                else if ($password !== $cpassword) {
                  header("Location: ../register.php?error=passwordcheck&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
                  exit();
                }
  else {

      $sql = "SELECT email FROM users WHERE email=?";
      $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../register.php?error=SQLError");
          exit();
        }
        else {
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
              header("Location: ../register.php?error=EmailTaken");
              exit();
            }
            else {
              $sql = "SELECT username FROM users WHERE username=?";
              $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                  header("Location: ../register.php?error=SQLError");
                  exit();
                }
                else {
                  mysqli_stmt_bind_param($stmt, "s", $uname);
                  mysqli_stmt_execute($stmt);
                  mysqli_stmt_store_result($stmt);
                  $resultCheck = mysqli_stmt_num_rows($stmt);
                    if ($resultCheck > 0) {
                      header("Location: ../register.php?error=UserNameTaken");
                      exit();
                    }
                    else {
                      $sql = "INSERT INTO users (username, name, dob, address, phone, postcode, email, password, accountType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                      $stmt = mysqli_stmt_init($conn);
                      if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../register.php?error=SQLError2");
                        exit();
                      }
                      else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($stmt, "sssssssss",$uname, $name, $dob, $address, $phone, $postcode, $email, $hashedPassword, $accType);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../register.php?signup=success");
                        exit();
                      }
                    }
            }

          }
        }
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
      }
    }
else {
  header("Location: ../register.php");
  exit();
}
