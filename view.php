<?php
$title = 'View';
include("includes/header.php");
if (!ISSET($_SESSION['usersID'])){
  header("Location:index.php?error=notauth");
}

include("includes/dbh.inc.php");

$uID = $_SESSION['usersID'];
$compareID = intval($_GET['ID']);
$origin = $_GET['p'];
$sql3 = "SELECT * FROM users where id ='$compareID'";
$result3= mysqli_query($conn, $sql3);
if(mysqli_num_rows($result3)) {
  $userResult = mysqli_fetch_array($result3);
}?>
<div class="jumbotron-fluid">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <?php if($origin == "ms"){
        echo '<li class="breadcrumb-item"><a href="myswimmers.php">My Swimmers</a></li>';
      }
      elseif($origin == "c") {
        echo '<li class="breadcrumb-item"><a href="stats.php">Statistics</a></li>';
      }
      elseif($origin == "ch") {
        echo '<li class="breadcrumb-item"><a href="child.php">My Children</a></li>';
      }
      elseif($origin =="u"){
        echo '<li class="breadcrumb-item"><a href="users.php">Users</a></li>';
      }
       ?>

      <li class="breadcrumb-item active" aria-current="page">View</li>
    </ol>
  </div>
  <div class="row">
    <div class="col centerjumbo">
      <h4><?php echo $userResult['name'] ?>'s Info</h4>
      <ul>
        <li>Name: <?php echo $userResult['name'];?></li>
        <li>Email: <?php echo $userResult['email'];?></li>
        <li>Account Type: <?php echo $userResult['accountType'];?></li>
      </ul>
    <br />
    </div>
  </div>
  <div class="row">
    <div class="col">
      <h5 class="title centerjumbo"><?php echo $userResult['name']; ?>'s recent laps.</h5>
      <table class="table">
        <thead>
          <th scope="col">Time</th>
          <th scope="col">Date</th>
        </thead>
        <tbody>
        <?php
        $sql2 = "SELECT * FROM laps WHERE uid='$compareID' AND YEARWEEK(lapDate) = YEARWEEK(NOW())";
        $result2 = mysqli_query($conn, $sql2);
        if(mysqli_num_rows($result2)>0) :
          while($lapResult2 = mysqli_fetch_array($result2)):
        ?>

          <tr>
            <td><?php echo $lapResult2['lapTime'];?> seconds.</td>
            <td><?php echo $lapResult2['lapDate'];?></td>
          </tr>
        <?php endwhile;
      else: echo '<td>No recent laps.</td>';
      endif;?>
    </tbody>
  </table>
    </div>
      <div class="col">
        <h5 class="title centerjumbo"><?php echo $userResult['name']; ?>'s earlier laps.</h5>
        <table class="table">
          <thead>
            <th scope="col">Time</th>
            <th scope="col">Date</th>
          </thead>
          <tbody>
          <?php
          $sql2 = "SELECT * FROM laps WHERE uid='$compareID' AND YEARWEEK(lapDate) = YEARWEEK(NOW() - INTERVAL 1 WEEK)";
          $result2 = mysqli_query($conn, $sql2);
          if(mysqli_num_rows($result2)>0) :
            while($lapResult2 = mysqli_fetch_array($result2)):
          ?>

            <tr>
              <td><?php echo $lapResult2['lapTime'];?> seconds.</td>
              <td><?php echo $lapResult2['lapDate'];?></td>
            </tr>
          <?php endwhile;
        else: echo '<td>No recent laps.</td>';
        endif;?>
      </tbody>
    </table>
      </div>
    </div>
  <br>
    <div class="row">
      <div class="col centerjumbo">
        <h5 class="title"><?php echo $userResult['name']; ?>'s race results.</h5>
        <table class="table">
          <thead>
            <th scope="col">Total Time</th>
            <th scope="col">Date</th>
            <th scope="col">Laps</th>
            <th scope="col">Fastest Lap</th>
          </thead>
          <tbody>
          <?php
          $sql2 = "SELECT * FROM race WHERE userID=$compareID";
          $result2 = mysqli_query($conn, $sql2);
          if(mysqli_num_rows($result2)>0) :
            while($lapResult2 = mysqli_fetch_array($result2)):
          ?>
            <tr>
              <td><?php echo $lapResult2['rtime'];?> seconds.</td>
              <td><?php echo $lapResult2['rdate'];?></td>
              <td><?php echo $lapResult2['laps'];?> laps.</td>
              <td><?php echo $lapResult2['fastest'];?> seconds.</td>
            </tr>
          <?php endwhile;
        else: echo '<td>No recent races.</td>';
        endif;?>
        </tbody>
      </table>
      </div>
    </div>
</div>
<?php include("includes/footer.php");?>
