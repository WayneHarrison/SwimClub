<?php $title = 'Index'; include("includes/header.php");?>

<div class="jumbotron-fluid" align="center">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
  </div>
  <div class="container">
    <h1 class="display-4">College Road Swimming Club.</h1>
  <?php
    if (isset($_SESSION['usersID'])){
      echo '<p class="description">Welcome ', $_SESSION['usersName'], '!</p>';
    }
    ?>
    <img class="rounded" src="img/home.jpg" alt="Swimmer in pool" height="50%" width="50%">
  </div>
</div>

<?php include("includes/footer.php");?>
