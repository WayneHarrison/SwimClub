<?php
$title = 'My Swimmers';
include("includes/header.php");
if($_SESSION['usersAcc'] != "Coach"){
  header("Location:index.php?error=notauth");
}
include("includes/dbh.inc.php");

$uID = $_SESSION['usersID'];?>
<div class="jumbotron-fluid">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">My Swimmers</li>
    </ol>
  </div>
  <div class="container">
    <div class="row">
      <div class="col">
        <h5 class="title">Your Swimmers</h5>
      <br>
        <?php  if(isset($_GET['error'])){
            if ($_GET['error'] == "SQLError"){
              echo '<p class="signuperror">Error Try Again!</p>';
            }
          }
          else if(isset($_GET['submit'])){
            echo '<p class="signupsuccess">Successfully added swimmer!</p>';
          }
          else if(isset($_GET['delete'])){
            echo '<p class="signupsuccess">Successfully removed swimmer!</p>';
          }
            ?><br>
        <table class="table">
          <thead>
            <th scope="col">Name</th>
            <th scope="col">DOB</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </thead>
          <tbody>
          <?php
          $sql2 = "SELECT * FROM users WHERE cID='$uID'";
          $result2 = mysqli_query($conn, $sql2);
          if(mysqli_num_rows($result2)>0):
            while ($coachResult = mysqli_fetch_array($result2)):

          ?>
            <tr>
              <td><?php echo $coachResult['name'];?></td>
              <td><?php echo $coachResult['dob'];?></td>
              <td><form method="post" action="includes/remove.inc.php?ID=<?php echo $coachResult['id']; ?>">
                    <button class="btn btn-outline-dark my-2 my-sm-0" name="deleteSwimmer" type="submit">Delete</button></li>
                  </form>
              </td>
              <td><a href="addrace.php?ID=<?php echo $coachResult['id']; ?>" class="btn btn-outline-dark my-2 my-sm-0" name="addRace" type="submit">Add Results</a></td>
              <td><a href="view.php?ID=<?php echo $coachResult['id'];?>&p=ms" class="btn btn-outline-dark my-2 my-sm-0" name="addRace" type="submit">View</a></td>
            </tr>



          <?php endwhile;
        else: echo '<td>No registered swimmers.</td>';
        endif;?>
      </tbody>
      </table>
        <div class="centerjumbo">
          <a href="swimmers.php" class="btn btn-outline-dark my-2 my-sm-0">Add Swimmer</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("includes/footer.php");?>
