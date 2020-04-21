<?php
if (!ISSET($_SESSION['usersID'])){
  header("Location:index.php?error=notauth");
}
$title = 'Compare';
include("includes/header.php");
include("includes/dbh.inc.php");

$uID = $_SESSION['usersID'];
$compareID = intval($_GET['ID']);
$sql3 = "SELECT * FROM users where id ='$compareID'";
$result3= mysqli_query($conn, $sql3);
if(mysqli_num_rows($result3)) {
  $userResult = mysqli_fetch_array($result3);
}?>
<div class="jumbotron-fluid">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="stats.php">Statistics</a></li>
      <li class="breadcrumb-item active" aria-current="page">Compare</li>
    </ol>
  </div>
  <div class="container">
    <div class="row">
      <div class="col" align="center">
        <h3>Comparison</h3>
        <h4><?php echo $userResult['name'] ?>'s Info</h4>
        <ul>
          <li>Name: <?php echo $userResult['name'];?></li>
          <li>Email: <?php echo $userResult['email'];?></li>
          <li>Account Type: <?php echo $userResult['accountType'];?></li>
          </br>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h5 class="title listAlign">Your recent laps.</h5>
        <ul class="listAlign">
          <?php
          $sql = "SELECT * FROM laps WHERE uid='$uID' AND YEARWEEK(lapDate) = YEARWEEK(NOW())";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result)>0) :
            while($lapResult = mysqli_fetch_array($result)):
          ?>
          <li>Time: <?php echo $lapResult['lapTime'];?> seconds.  Date: <?php echo $lapResult['lapDate'];?>  </li>
          <?php endwhile;
        else: echo '<p>No recent laps.</p>';
        endif;?>
        </ul>
      </div>
      <div class="col">
        <h5 class="title listAlign"><?php echo $userResult['name']; ?>'s recent laps.</h5>
        <ul class="listAlign">
          <?php
          $sql2 = "SELECT * FROM laps WHERE uid='$compareID' AND YEARWEEK(lapDate) = YEARWEEK(NOW())";
          $result2 = mysqli_query($conn, $sql2);
          if(mysqli_num_rows($result2)>0) :
            while($lapResult2 = mysqli_fetch_array($result2)):
          ?>
          <li>Time: <?php echo $lapResult2['lapTime'];?> seconds.  Date: <?php echo $lapResult2['lapDate'];?>  </li>
          <?php endwhile;
        else: echo '<p>No recent laps.</p>';
        endif;?>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php include("includes/footer.php");?>
