<?php
$title = 'Stats';
include("includes/header.php");
if (!ISSET($_SESSION['usersID'])){
  header("Location:index.php?error=notauth");
}

include("includes/dbh.inc.php");

$uID = $_SESSION['usersID'];?>
<div class="jumbotron-fluid centerjumbo">
    <div aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Statistics</li>
      </ol>
    </div>
  <div class="container">
    <div class="row">
      <div class="col">
        <h4>Compare</h4>
        <form action="searchcompare.php" method="post">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="material-icons">
                  search
                </i>
              </span>
            </div>
            <input type="text" name="search" class="form-control" placeholder="Search" aria-label="search" aria-describedby="basic-addon1">
            <button class="btn btn-outline-dark my-2 my-sm-0" name="submit-search" type="submit">Search</button>
          </div>
        </form>
      </div>
    </div>
  <br><br>
    <div class="row">
      <div class="col">
        <h5 class="title">Add a Lap</h5>
        <br>
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
        <form action="includes/lap.inc.php" method="post">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="material-icons">
                  alarm
                </i>
              </span>
            </div>
            <input type="number" name="timeField" id="timeField" placeholder="Seconds" class="form-control" aria-label="Time" aria-describedby="basic-addon1">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="material-icons">
                  calendar_today
                </i>
              </span>
            </div>
            <input type="text" id="dateField" name="dateField" class="form-control" placeholder="Date" onfocus="(this.type='date')" onblur="(this.type='text')">
          </div>
          <br>
          <div>
            <button class="btn btn-outline-dark my-2 my-sm-0" name="timeButton" type="submit">Add Time</button>
          </div>
        </form>
      </div>
      <div class="col">
        <h5 class="title">Last Weeks Lap Times (Sunday - Saturday)</h5>
        <?php
        $sql = "SELECT * FROM laps WHERE uid='$uID' AND YEARWEEK(lapDate) = YEARWEEK(NOW() - INTERVAL 1 WEEK)";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0):
                while($lapResult = mysqli_fetch_array($result)):
                ?>
                <li>Time: <?php echo $lapResult['lapTime'];?> seconds.  Date: <?php echo $lapResult['lapDate'];?>  </li>
                <?php endwhile;
              else: echo '<p>No laps in last week.</p>';
              endif;?>
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
  <div class="row">
    <div class="col centerjumbo">
      <h5 class="title">Race results.</h5>
      <table class="table">
        <thead>
          <th scope="col">Total Time</th>
          <th scope="col">Date</th>
          <th scope="col">Laps</th>
          <th scope="col">Fastest Lap</th>
        </thead>
        <?php
        $sql2 = "SELECT * FROM race WHERE userID=$uID";
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
