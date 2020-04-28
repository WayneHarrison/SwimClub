<?php
$title = "Profile";
include("includes/header.php");
if (!ISSET($_SESSION['usersID']) && $_SESSION['usersAcc'] == "Official"){
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

  <div class="jumbotron-fluid" align="center">
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
            <?php if ($_SESSION['usersAcc'] != "Child"){
              echo'<a href="profileedit.php"><button class="btn btn-outline-dark my-2 my-sm-0">Edit Details</button></a>';
            } ?>
          </ul>

        </div>
        <div class="col" align="center">
          <h5 class="title">Recent race results.</h5>
          <table class="table">
            <thead>
              <th scope="col">Total Time</th>
              <th scope="col">Date</th>
              <th scope="col">Laps</th>
              <th scope="col">Fastest Lap</th>
              <th scope="col"></th>
            </thead>
            <?php
            $sql2 = "SELECT * FROM race WHERE YEARWEEK(rdate) = YEARWEEK(NOW())";
            $result2 = mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2)>0) :
              while($lapResult2 = mysqli_fetch_array($result2)):
            ?>
            <tbody>
              <tr>
                <td><?php echo $lapResult2['rtime'];?> seconds.</td>
                <td><?php echo $lapResult2['rdate'];?></td>
                <td><?php echo $lapResult2['laps'];?> laps.</td>
                <td><?php echo $lapResult2['fastest'];?> seconds.</td>
                <td><a href="viewofficial.php?ID=<?php echo $lapResult2['userID'];?>&p=pfo"><button class="btn btn-outline-dark my-2 my-sm-0" name="addRace" type="submit">View User</button></a></td>
              </tr>
            <?php endwhile;
          else: echo '<td>No recent races.</td>';
          endif;?>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
<?php include("includes/footer.php");?>
