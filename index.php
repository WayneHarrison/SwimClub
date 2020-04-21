<?php $title = 'Index'; include("includes/header.php");?>

<div class="jumbotron-fluid">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
  </div>
  <div class="container centerjumbo">
    <h1 class="display-4">College Road Swimming Club.</h1>
  <?php
  if(isset($_GET['error'])){
    if ($_GET['error'] == "NoUser"){
      echo '<p class="signuperror">Problem signing you in! Try Again!</p>';
    }
    else if($_GET['error'] == "notauth") {
      echo '<p class="signuperror">Unauthorised User!</p>';
    }
    else if($_GET['error'] == "WrongPassword") {
      echo '<p class="signuperror">Problem signing you in! Try Again!</p>';
    }
  }?>
    <?php
    if (isset($_SESSION['usersID'])){
      echo '<p class="description">Welcome ', $_SESSION['usersName'], '!</p>';
    }
    ?>
    <img class="rounded half" src="img/home.jpg" alt="Swimmer in pool">
  </div>
</div>

<?php include("includes/footer.php");?>
