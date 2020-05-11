<?php
$title = 'Child Management';
include("includes/header.php");
if(!ISSET($_SESSION['usersID']) && $_SESSION['usersAcc'] != "Parent"){
  header("Location:index.php?error=notauth");
}
else{

include("includes/dbh.inc.php");
$uID = $_SESSION['usersID'];}?>


<div class="jumbotron-fluid">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">My Children</li>
    </ol>
  </div>
  <div class="container">
    <div class="row">
      <div class="col">
        <h5 class="title">Registered Children</h5>
      <br/>
        <?php
        if (isset($_GET['signup'])) {
          echo '<p class="signupsuccess">Sign up successful!</p>';
        }
        else if(isset($_GET['delete'])){
          echo '<p class="signupsuccess">Successfully deleted child!</p>';
        }
            ?><br/>
        <table class="table">
          <thead>
            <th scope="col">Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope ="col"></th>
          </thead>
          <tbody>
          <?php
          $sql2 = "SELECT * FROM users WHERE pID='$uID'";
          $result2 = mysqli_query($conn, $sql2);
          if(mysqli_num_rows($result2)>0) :
            while($childResult = mysqli_fetch_array($result2)):
          ?>
            <tr>
              <td><?php echo $childResult['name'];?></td>
              <td><a href="view.php?ID=<?php echo $childResult['id'];?>&p=ch"><button class="btn btn-outline-dark my-2 my-sm-0" name="addRace" type="submit">View</button></a></td>
              <td><a href="childinfo.php?ID=<?php echo $childResult['id']; ?>"><button class="btn btn-outline-dark my-2 my-sm-0" name="viewChild" type="submit">Add Lap</button></a></td>
              <td><a href="childedit.php?ID=<?php echo $childResult['id']; ?>"><button class="btn btn-outline-dark my-2 my-sm-0" name="editChild" type="submit">Edit</button></a></td>
              <td>
                <form method="post" action="includes/remove.inc.php?ID=<?php echo $childResult['id']; ?>">
                    <button class="btn btn-outline-dark my-2 my-sm-0" name="deleteChild" onclick="return confirm('Are you sure?');" type="submit">Delete</button></li>
                </form>
              </td>
            </tr>



          <?php endwhile;
        else: echo '<td>No registered Children.</td>';
        endif;?>
      </tbody>
      </table>
        <div class="centerjumbo">
          <a href="addChild.php" class="btn btn-outline-dark my-2 my-sm-0">Add Child</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("includes/footer.php");?>
