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
    <link rel="stylesheet" href="css/signin.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
</head>

<body>

    <?php include "includes/navigation.php"; ?>




    <div id="container">
        <div class="form-wrap">
            <h1>Sign In</h1>

            <?php

      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") { ?>
            <p style="color:red">Please fill in all fields in order to login!</p>
            <?php } elseif ($_GET["error"] == "nouser") { ?>
            <p style="color:red">Wrong email or password!</p>
            <?php } elseif ($_GET["error"] == "wrongpassword") { ?>
            <p style="color:red">Wrong email or password!</p>
            <?php }
      }
      ?>

            <form action="includes/signin.inc.php" method="post">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" />
                </div>
                <button type="submit" name="login-submit" class="btn">Sign In without Facial Recognition</button>
                <button type="submit" name="login-submit-FacialRecognition" class="btn">Sign In with Facial Recognition</button>
            </form>


                
        </div>

        <footer>
            <p>Don't have an account? <a href="#">Register here</a></p>
        </footer>
        <?php include "includes/footer.php"; ?>
    </div>
</body>

</html>