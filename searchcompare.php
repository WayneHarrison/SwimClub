<?php
$title="Search";
include('includes/header.php');
if (!ISSET($_SESSION['usersID'])){
  header("Location:index.php?error=notauth");
}


include('includes/dbh.inc.php');
$uID = $_SESSION['usersID'];
$searchterm = $_POST['search']?>
<div class="jumbotron-fluid centerjumbo">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="stats.php">Statistics</a></li>
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
  $search = mysqli_real_escape_string($conn, $searchterm);
  $sql = "SELECT * FROM users WHERE name LIKE '%$search%' AND id !='$uID'";
  $result= mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)>0):
    while($userResult = mysqli_fetch_array($result)):?>
    <tbody>
      <tr>
        <td><?php echo $userResult['name'];?></td>
        <td><?php echo $userResult['dob'];?></td>
        <td><a href="compare.php?ID=<?php echo $userResult['id']; ?>" class="btn btn-outline-dark my-2 my-sm-0" name="addRace" type="submit">Compare</a></td>
        <td><a href="view.php?ID=<?php echo $userResult['id'];?>&p=c" class="btn btn-outline-dark my-2 my-sm-0" name="addRace" type="submit">View</a></td>
      </tr>
      <?php endwhile;
    else: echo'<h3>No results matching your search!</h3>';
    endif;?>
    </tbody>
  </table>

</div>


<?php include('includes/footer.php'); ?>
