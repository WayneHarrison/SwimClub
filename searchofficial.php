<?php
$title="Search";
include('includes/header.php');
if($_SESSION['usersAcc'] != "Official"){
  header("Location:index.php?error=notauth");
}

include('includes/dbh.inc.php');


$uID = $_SESSION['usersID'];
$searchterm = $_POST['search']?>
<div class="jumbotron-fluid centerjumbo">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="Users.php">Statistics</a></li>
      <li class="breadcrumb-item active" aria-current="page">Search</li>
    </ol>
  </div>
  <h1>Search Results</h1>
  <table class="table">
    <thead>
      <th scope="col">Name</th>
      <th scope="col">DOB</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </thead>
  <?php
  $search = mysqli_real_escape_string($conn, $searchterm );
  $sql = "SELECT * FROM users WHERE name LIKE '%$search%' AND id !='$uID'";
  $result= mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)>0):
    while($userResult = mysqli_fetch_array($result)):?>
    <tbody>
      <tr>
        <td><?php echo $userResult['name'];?></td>
        <td><?php echo $userResult['dob'];?></td>
        <td><form method="post" action="includes/remove.inc.php?ID=<?php echo $userResult['id']; ?>">
              <button class="btn btn-outline-dark my-2 my-sm-0" onclick="return confirm('Are you sure?');" name="deleteUser" type="submit">Delete</button>
            </form>
        </td>
        <td><a href="addrace.php?ID=<?php echo $userResult['id']; ?>" class="btn btn-outline-dark my-2 my-sm-0">Add Results</a></td>
        <td><a href="viewofficial.php?ID=<?php echo $userResult['id'];?>&p=c" class="btn btn-outline-dark my-2 my-sm-0">View</a></td>
      </tr>
      <?php endwhile;
    else: echo'<h3>No results matching your search!</h3>';
    endif;?>
  </tbody>
</table>
</div>


<?php include('includes/footer.php'); ?>
