<?php
  session_start();
  if (isset($_POST['addChildButton'])) {

    require 'dbh.inc.php';
    $pID = $_SESSION['usersID'];
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
          header("Location: ../addChild.php?error=emptyfields&uname".$uname."&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
          exit();
        }
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../addChild.php?error=invalidmail&name=".$name."&address".$address."&postcode".$postcode);
            exit();
            }
              else if (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
              header("Location: ../addChild.php?error=invalidname&address="."&address".$address."&postcode".$postcode."&email".$email);
              exit();
              }
              else if (!preg_match("/^[-0-9]*$/", $dob)){
                header("Location: ../addChild.php?error=incorrectdob&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
                exit();
              }
              else if ($_age > 18){
                header("Location: ../addChild.php?error=old&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
                exit();
              }
                else if (!preg_match("/^[0-9]*$/", $phone)){
                  header("Location: ../addChild.php?error=incorrectphone&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
                  exit();
                }
                  else if ($password !== $cpassword) {
                    header("Location: ../addChild.php?error=passwordcheck&name=".$name."&address".$address."&postcode".$postcode."&email".$email);
                    exit();
                  }
    else {

        $sql = "SELECT email FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../addChild.php?error=SQLError");
            exit();
          }
          else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
              if ($resultCheck > 0) {
                header("Location: ../addChild.php?error=EmailTaken");
                exit();
              }
              else {
                $sql = "INSERT INTO users (username, name, dob, address, phone, postcode, email, password, accountType, pID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                  header("Location: ../addChild.php?error=SQLError2");
                  exit();
                }
                else {
                  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                  mysqli_stmt_bind_param($stmt, "ssssssssss",$uname, $name, $dob, $address, $phone, $postcode, $email, $hashedPassword, $accType, $pID);
                  mysqli_stmt_execute($stmt);
                  header("Location: ../child.php?signup=success");
                  exit();
                }
              }
            }
          }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
          }
  else {
    header("Location: ../index.php");
    exit();
  }
