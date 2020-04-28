<?php
$title="Search";
include('includes/dbh.inc.php');
if (!ISSET($_SESSION['usersID'])){
  header("Location:index.php?error=notauth");
}

include('includes/header.php');

$uID = $_SESSION['usersID'];
$searchterm = $_POST['search']?>
<div class="jumbotron-fluid centerjumbo">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="profilecoach.php">Profile</a></li>
      <li class="breadcrumb-item"><a href="swimmers.php">Add Swimmers</a></li>
      <li class="breadcrumb-item active" aria-current="page">Search</li>
    </ol>
  </div>
  <h1>Search Results</h1>
  <?php
  $search = mysqli_real_escape_string($conn, $searchterm );
  $sql = "SELECT * FROM users WHERE name LIKE '%$search%' AND id !='$uID'";
  $result= mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)>0):
    while($userResult = mysqli_fetch_array($result)):?>
      <form method="post" action="includes/addswimmer.inc.php?ID=<?php echo $userResult['id']; ?>">
        <li>Name: <?php echo $userResult['name'];?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DOB: <?php echo $userResult['dob'];?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="btn btn-outline-dark my-2 my-sm-0" name="addSwimmer" type="submit">Add</button></li></br>
      </form>
      <?php endwhile;
    else: echo'<h3>No results matching your search!</h3>';
    endif;?>

</div>


<?php include('includes/footer.php'); ?>
