<?php $title = 'Register'; include("includes/header.php");?>
<div class="jumbotron-fluid" class="centerjumbo">
  <div aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Register</li>
    </ol>
  </div>
  <div class="container">
    <h1 class="display-4">Register</h1>

    <div>
      <?php
      //Error Messages
      if(isset($_GET['error'])){
        if ($_GET['error'] == "emptyfields"){
          echo '<p class="signuperror">Missing fields!</p>';
        }
        else if($_GET['error'] == "invalidmail") {
          echo '<p class="signuperror">Invalid Email!</p>';
        }
        else if($_GET['error'] == "invalidname") {
          echo '<p class="signuperror">Invalid Name!</p>';
        }
        else if($_GET['error'] == "passwordcheck") {
          echo '<p class="signuperror">Password do not match!</p>';
        }
        else if($_GET['error'] == "incorrectdob") {
          echo '<p class="signuperror">Numbers only in DOB field!</p>';
        }
        else if($_GET['error'] == "young") {
          echo '<p class="signuperror">Over 18 only!</p>';
        }
        else if($_GET['error'] == "incorrectphone") {
          echo '<p class="signuperror">Numbers only in phone number field!</p>';
        }
        else if($_GET['error'] == "EmailTaken") {
          echo '<p class="signuperror">Email already registered!</p>';
        }
        else if($_GET['error'] == "UserNameTaken") {
          echo '<p class="signuperror">Username already registered!</p>';
        }
      }
      else if (isset($_GET['signup'])) {
        echo '<p class="signupsuccess">Sign up successful!</p>';
      }
      ?>
    </div>
    <!--Inputs for register-->

    <form action="includes/signup.inc.php" method="post">
      <fieldset>
        <div class ="row">
          <div class="col">
            <div class="form-group">
              <label for="unameField">User Name</label>
              <input type="text" class="form-control" id="unameField" placeholder="User Name" name="uname">
            </div>
            <div class="form-group">
              <label for="nameField">Name</label>
              <input type="text" class="form-control" id="nameField" placeholder="Name" name="name">
            </div>
            <div class="form-group">
              <label for="addressField">Address</label>
              <input type="text" class="form-control" id="addressField" placeholder="Address" name="address">
            </div>
            <div class="form-group">
              <label for="pcField">Postcode</label>
              <input type="text" class="form-control" id="pcField" placeholder="Postcode" name="postcode">
            </div>
            <div class="form-group">
              <label for="rpasswordField">Password</label>
              <input type="password" class="form-control" id="rpasswordField" placeholder="Password" name="rpassword">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="ageField">Date of Birth</label>
              <input type="text" class="form-control" id="ageField" placeholder="Age" name="dob" onfocus="(this.type='date')" onblur="(this.type='text')">
            </div>
            <div class="form-group">
              <label for="phoneField">Phone Number</label>
              <input type="text" class="form-control" id="phoneField" placeholder="Phone" name="phone">
            </div>
            <div class="form-group">
              <label for="emailField">Email Address</label>
              <input type="email" class="form-control" id="remailField" placeholder="Email" name="remail">
            </div>
              <div class="form-group">
                <label for="accType">Account Type</label>
                <select class="form-control" id="accType" name="accType" required>
                  <option disabled value="" selected hidden>Account Type</option>
                  <option>Swimmer</option>
                  <option>Coach</option>
                  <option>Official</option>
                  <option>Parent</option>
                </select>
              </div>
              <div class="form-group">
                <label for="cpasswordField">Confirm Password</label>
                <input type="password" class="form-control" id="cpasswordField" placeholder="Confirm Password" name="cpassword">
              </div>
          </div>
        </div>
        <div class="centerjumbo">
          <button class="btn btn-outline-dark my-2 my-sm-0" name="registerButton" type="submit">Submit</button>
        </div>
      </fieldset>
    </form>
  </div>
</div>

<?php include("includes/footer.php");?>
