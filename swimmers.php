<?php
$title="Swimmers";
include("includes/header.php");
if($_SESSION['usersAcc'] != "Coach"){
  header("Location:index.php?error=notauth");
}

include("includes/dbh.inc.php");

$uID = $_SESSION['usersID'];
//selects Results

  ?>
<div class="jumbotron-fluid centerjumbo">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item"><a href="profilecoach.php">Profile</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Swimmers</li>
    </ol>
  </div>
  <div class="container">
    <div class="alignright">
      <form action="search.php" method="post">
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
    </br>

    <h1>Swimmers</h1>
    <?php $sql = "SELECT * FROM users WHERE accountType='Swimmer' OR accountType='Child'";
    $result= mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0):
      while($userResult = mysqli_fetch_array($result)):?>
        <form method="post" action="includes/addswimmer.inc.php?ID=<?php echo $userResult['id']; ?>">
          <li>Name: <?php echo $userResult['name'];?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DOB: <?php echo $userResult['dob'];?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button class="btn btn-outline-dark my-2 my-sm-0" name="addSwimmer" type="submit">Add</button></li></br>
        </form>
        <?php endwhile;
      endif;?>
  </div>
</div>


<?php
include("includes/footer.php");
   ?>
