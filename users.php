<?php
$title="Users";
include('includes/header.php');
if($_SESSION['usersAcc'] != "Official"){
  header("Location:index.php?error=notauth");
}

include('includes/dbh.inc.php');

$uID = $_SESSION['usersID'];

?>
<div class="jumbotron-fluid">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
  </div>
  <div class="container">
    <div class="row">
      <div class="col">
        <form action="searchofficial.php" method="post">
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
    <h2>All Users</h2>
    <?php
    if (isset($_GET['signup'])) {
      echo '<p class="signupsuccess">Sign up successful!</p>';
    }
    else if(isset($_GET['delete'])){
      echo '<p class="signupsuccess">Successfully deleted user!</p>';
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
      <?php
      $sql2 = "SELECT * FROM users where id != $uID";
      $result2 = mysqli_query($conn, $sql2);
      if(mysqli_num_rows($result2)>0):
        while ($coachResult = mysqli_fetch_array($result2)):

      ?>
      <tbody>
        <tr>
          <th scope="row"><?php echo $coachResult['name'];?></th>
          <td><?php echo $coachResult['dob'];?></td>
          <td><form method="post" action="includes/remove.inc.php?ID=<?php echo $coachResult['id']; ?>">
                <button class="btn btn-outline-dark my-2 my-sm-0" name="deleteUser" type="submit" onclick="return confirm('Are you sure?');">Delete</button></li>
              </form>
          </td>
          <td><a href="addrace.php?ID=<?php echo $coachResult['id'];?>" class="btn btn-outline-dark my-2 my-sm-0" name="addRace" type="submit">Add Results</a></td>
          <td><a href="viewofficial.php?ID=<?php echo $coachResult['id'];?>&p=u" class="btn btn-outline-dark my-2 my-sm-0" name="addRace" type="submit">View</a></td>
        </tr>



      <?php endwhile;
    else: echo '<p>No users.</p>';
    endif;?>
  </tbody>
  </table>
  </div>
</div>
<?php
  include('includes/footer.php');
?>
