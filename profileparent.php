<?php
$title="Profile";
include("includes/header.php");
if($_SESSION['usersAcc'] != "Parent"){
  header("Location:index.php?error=notauth");
}

include("includes/dbh.inc.php");

$uID = $_SESSION['usersID'];
//selects Results
  $sql = "SELECT * FROM users WHERE id='$uID'";
  $result= mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)) {
    $userResult = mysqli_fetch_array($result);
  }
  //selects Results
  ?>

  <div class="jumbotron-fluid centerjumbo">
    <div aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
      </ol>
    </div>
    <div class="container">
      <h4 class="title">Your Profile</h4>
      <p class="description">Welcome <?php echo $userResult['userName'];?>.</p>
    </br>
      <div class="row">
        <div class="col">
          <h5 class="title listAlign">Your Info</h5>
          <ul class="listAlign">
            <li>Name: <?php echo $userResult['name'];?></li>
            <li>Address: <?php echo $userResult['address'];?></li>
            <li>Postcode: <?php echo $userResult['postcode']; ?> </li>
            <li>Phone: <?php echo $userResult['phone']; ?></li>
            <li>Date of Birth: <?php echo $userResult['dob'];?></li>
            <li>Account Type: <?php echo $userResult['accountType'];?></li>
            </br>
            <a href="profileedit.php" class="btn btn-outline-dark my-2 my-sm-0">Edit Details</a>
          </ul>
        </div>
        <div class="col">
          <h5 class="title listAlign">This Weeks Laps (Sunday - Saturday)</h5>
          <ul class="listAlign">
            <?php
            $sql2 = "SELECT * FROM laps WHERE uid='$uID' AND YEARWEEK(lapDate) = YEARWEEK(NOW())";
            $result2 = mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2)>0) :
              while($lapResult = mysqli_fetch_array($result2)):
            ?>
            <li>Time: <?php echo $lapResult['lapTime'];?> seconds.  Date: <?php echo $lapResult['lapDate'];?>  </li>
            <?php endwhile;
          else: echo '<p>No recent laps.</p>';
          endif;?>
          </ul>
        </div>
      </div>
    </div>
  </div>
<?php include("includes/footer.php");?>
