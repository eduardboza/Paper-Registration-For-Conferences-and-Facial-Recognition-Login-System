<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Form Styling</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" />
  <link rel="stylesheet" href="css/signup.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
</head>

<body>

  <?php include "includes/navigation.php"; ?>


  <div id="container">
    <div class="form-wrap">
      <h1>Sign Up</h1>
      <p>It's free and only takes a minute</p>

      <?php

      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") { ?>
          <p style="color:red">Please fill in all fields in order to register!</p>
        <?php } elseif ($_GET["error"] == "invalidfirstname") { ?>
          <p style="color:red">Please choose a proper firstname in order to register!</p>
        <?php } elseif ($_GET["error"] == "invalidlastname") { ?>
          <p style="color:red">Choose a proper lastname in order to register!</p>
        <?php } elseif ($_GET["error"] == "invalidemail") { ?>
          <p style="color:red">Choose a proper email in order to register!</p>
        <?php } elseif ($_GET["error"] == "passwordcheck") { ?>
          <p style="color:red">Passwords doesn't match!</p>
        <?php } elseif ($_GET["error"] == "stmterror") { ?>
          <p style="color:red">Something went wrong, try again!</p>
        <?php
        } elseif ($_GET["error"] == "successfullySignedUp") { ?>
          <p style="color:green">You have signed up!</p>
      <?php
        }
      }
      ?>

      <form action="includes/signup.inc.php" method="post">
        <div class="form-group">
          <label for="first-name">First Name</label>
          <input type="text" name="firstName" id="first-name" />
        </div>
        <div class="form-group">
          <label for="last-name">Last Name</label>
          <input type="text" name="lastName" id="last-name" />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" />
        </div>
        <div class="form-group">
          <label for="password2">Confirm Password</label>
          <input type="password" name="password2" id="password2" />
        </div>
        <button type="submit" name="signup-submit" class="btn">Sign Up</button>
        <p class="bottom-text">
          By clicking the Sign Up button, you agree to our
          <a href="#">Terms & Conditions</a> and
          <a href="#">Privacy Policy</a>
        </p>
      </form>



    </div>



    <footer>
      <p>Already have an account? <a href="signin.php">Login Here</a></p>
    </footer>
    <?php include "includes/footer.php"; ?>
  </div>
</body>

</html>