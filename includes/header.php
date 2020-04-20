<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
  <head>
      <title><?php echo $title ?></title>
      <!--Scaling-->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui">
      <!-- Google Fonts -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
      <!--Icons-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!-- CSS Reset -->
      <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
      <!--CSS minified -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="css/main.css" type="text/css">
      <!-- Scripts -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </head>
  <body>
    <header>
      <!--Navigation-->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Swimclub</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Opening Times</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact Us</a>
            </li>
          </ul>
          <?php
            if (isset($_SESSION['usersID'])&& $_SESSION['usersAcc'] == "Swimmer" ){
              echo '<ul class="navbar-nav">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Account
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDD">
                          <a class="dropdown-item" href="profile.php">My Account</a>
                          <a class="dropdown-item" href="stats.php">Statistics</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="includes/logout.inc.php">Logout</a>
                        </div>
                      </li>
                    </ul>';
                    }
                    elseif (isset($_SESSION['usersID'])&& $_SESSION['usersAcc'] == "Parent"){
                      echo '<ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Account
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDD">
                                  <a class="dropdown-item" href="profileparent.php">My Account</a>
                                  <a class="dropdown-item" href="stats.php">Statistics</a>
                                  <a class="dropdown-item" href="child.php">Children</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="includes/logout.inc.php">Logout</a>
                                </div>
                              </li>
                            </ul>';
                    }
                    elseif (isset($_SESSION['usersID'])&& $_SESSION['usersAcc'] == "Coach"){
                      echo '<ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Account
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDD">
                                  <a class="dropdown-item" href="profilecoach.php">My Account</a>
                                  <a class="dropdown-item" href="stats.php">Statistics</a>
                                  <a class="dropdown-item" href="myswimmers.php">Swimmers</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="includes/logout.inc.php">Logout</a>
                                </div>
                              </li>
                            </ul>';
                    }
                    elseif (isset($_SESSION['usersID'])&& $_SESSION['usersAcc'] == "Child" ){
                      echo '<ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Account
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDD">
                                  <a class="dropdown-item" href="profile.php">My Account</a>
                                  <a class="dropdown-item" href="stats.php">Statistics</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="includes/logout.inc.php">Logout</a>
                                </div>
                              </li>
                            </ul>';
                            }
                            elseif (isset($_SESSION['usersID'])&& $_SESSION['usersAcc'] == "Official" ){
                              echo '<ul class="navbar-nav">
                                      <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Account
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDD">
                                          <a class="dropdown-item" href="profileofficial.php">My Account</a>
                                          <a class="dropdown-item" href="stats.php">Statistics</a>
                                          <a class="dropdown-item" href="users.php">Users</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="includes/logout.inc.php">Logout</a>
                                        </div>
                                      </li>
                                    </ul>';
                                    }
            else {
              echo '<form action="includes/login.inc.php" method="post" class="form-inline my-2 my-lg-0">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                      <i class="material-icons">
                        perm_identity
                      </i>
                    </span>
                  </div>
                  <input type="text" name="emailField" id="emailField" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                      <i class="material-icons">
                        security
                      </i>
                    </span>
                  </div>
                  <input type="password" name="passwordField" id="passwordField" style="margin-right: 1%" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                </div>
                <div>
                  <button class="btn btn-outline-light my-2 my-sm-0" name="loginButton" type="submit" value="Login">Login</button>
                  <a type="button" class="btn btn-outline-light my-2 my-sm-0" type="submit" href="register.php">Register</a>
                </div>
              </form>';
            }
            ?>
        </div>
      </nav>
    </header>
    <section>
