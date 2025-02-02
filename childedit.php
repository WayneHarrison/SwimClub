<?php
$title = 'Edit';
include("includes/header.php");
if($_SESSION['usersAcc'] != "Parent"){
  header("Location:index.php?error=notauth");
}

include("includes/dbh.inc.php");
$cID = intval($_GET['ID']);
$sql = "SELECT * FROM users WHERE id='$cID'";
$result= mysqli_query($conn, $sql);
if(mysqli_num_rows($result)) {
  $userResult = mysqli_fetch_array($result);
}?>
<div class="jumbotron-fluid centerjumbo">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <?php if ($_SESSION['usersAcc'] == "Swimmer" OR $_SESSION['usersAcc'] == "Child"){
        echo'<li class="breadcrumb-item"><a href="profile.php">Profile</a></li>';
      }
      elseif ($_SESSION['usersAcc'] == "Parent"){
        echo'<li class="breadcrumb-item"><a href="child.php">My Children</a></li>';
      }
      elseif ($_SESSION['usersAcc'] == "Coach"){
        echo'<li class="breadcrumb-item"><a href="profilecoach.php">Profile</a></li>';
      }
      ?>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
  </div>
  <div class="container">
    <h1>Profile Edit</h1>
    <div>
      <?php
      //Error Messages
      if(isset($_GET['error'])){
        if ($_GET['error'] == "emptyfields"){
          echo '<p class="signuperror">Missing fields!</p>';
        }
        else if($_GET['error'] == "incorrectdob") {
          echo '<p class="signuperror">Numbers only in DOB field!</p>';
        }
        else if($_GET['error'] == "incorrectphone") {
          echo '<p class="signuperror">Numbers only in phone number field!</p>';
        }
      }
      else if (isset($_GET['edit'])) {
        echo '<p class="signupsuccess">Edit successful!</p>';
      }
      ?>
    </div>
    <form action="includes/edit.inc.php&ID= <?php echo $cID?>" method="post">
      <fieldset>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="editAddress">Address</label>
              <input type="text" class="form-control" id="editAddress" placeholder="Address" name="editAddress" value="<?php echo $userResult['address']?>">
            </div>
            <div class="form-group">
              <label for="editPostcode">Postcode</label>
              <input type="text" class="form-control" id="editPostcode" placeholder="Postcode" name="editPostcode" value="<?php echo $userResult['postcode']?>">
            </div>
            <div class="form-group">
              <label for="editPhone">Phone Number</label>
              <input type="text" class="form-control" id="editPhone" placeholder="Phone" name="editPhone" value="<?php echo $userResult['phone']?>">
            </div>
            <div class="form-group">
              <label for="accType">Account Type</label>
              <select class="form-control" id="accType" name="accType" required>
                <option disabled value="" selected hidden>Account Type</option>
                <option>Child</option>
                <option>Swimmer</option>
              </select>
            </div>
          </div>
        </div>
        <div class="float-center">
          <button class="btn btn-outline-dark my-2 my-sm-0" name="editButton" type="submit">Submit</button>
        </div>
      </fieldset>
    </form>
  </div>


<?php include("includes/footer.php");?>
