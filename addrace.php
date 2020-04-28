<?php
$title = 'Add Race';
include("includes/header.php");
if($_SESSION['usersAcc'] != "Coach" || $_SESSION['usersAcc'] != "Official"){
  header("Location ../index.php?error=notauth");
}

include("includes/dbh.inc.php");
$uID = $_GET['ID'];?>
<div class="jumbotron-fluid" align="center">
    <div aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <?php
          if($_SESSION['usersAcc'] == "Coach"){
            echo '<li class="breadcrumb-item"><a href="MySwimmers.php">Swimmers</a></li>';
          }
          else {
            echo '<li class="breadcrumb-item"><a href="users.php">Users</a></li>';
          }
         ?>

        <li class="breadcrumb-item active" aria-current="page">Add Race</li>
      </ol>
    </div>
  <div class="container">
    <div class="row">
      <div class="col">
        <h5 class="title">Add race times</h5>
        </br>
      <?php  if(isset($_GET['error'])){
          if ($_GET['error'] == "missingfields"){
            echo '<p class="signuperror">Missing fields!</p>';
          }
          else if ($_GET['error'] == "SQLError"){
            echo '<p class="signuperror">Error Try Again!</p>';
          }
        }
        else if(isset($_GET['submit'])){
          echo '<p class="signupsuccess">Successfully submitted time!</p>';
        }
          ?>
        <form action="includes/race.inc.php?ID=<?php echo $uID?>" method="post">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="material-icons">
                  pool
                </i>
              </span>
            </div>
            <input type="number" name="lapField" id="lapField" placeholder="Total Laps" class="form-control" aria-label="Laps" aria-describedby="basic-addon1">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="material-icons">
                  alarm
                </i>
              </span>
            </div>
            <input type="number" name="timeField" id="timeField" placeholder="Total Time" class="form-control" aria-label="Time" aria-describedby="basic-addon1">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="material-icons">
                  speed
                </i>
              </span>
            </div>
            <input type="number" name="speedField" id="speedField" placeholder="Fastest Lap" class="form-control" aria-label="Speed" aria-describedby="basic-addon1">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="material-icons">
                  calendar_today
                </i>
              </span>
            </div>
            <input type="text" id="dateField" name="dateField" class="form-control" placeholder="Date" onfocus="(this.type='date')" onblur="(this.type='text')">
          </div>
          </br>
          <div>
            <button class="btn btn-outline-dark my-2 my-sm-0" name="timeButton" type="submit">Add Time</button>
          </div>
        </form>
      </div>
  </div>
  </div>
</div>
<?php include("includes/footer.php");?>
