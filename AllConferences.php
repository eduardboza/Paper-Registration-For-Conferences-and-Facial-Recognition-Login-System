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
  <link rel="stylesheet" href="css/AllConferences.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
</head>

<body>

  <?php include "includes/navigation.php"; ?>




  <div id="container">
    <div class="form-wrap button">

      <h1>SISOM Conferences</h1>
      <br><br>


      <?php

      require_once 'includes/db.php';
      $sql = "SELECT * FROM conferences";
      $result = mysqli_query($connection, $sql) or die("Bad Query: $sql");

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
          echo "<a href='ConfPage.php?ID={$row['id']}'>{$row['title']}</a><br>";
        }
      } else {
        echo "<h2>No Conferences to display</h2>";
      }

      ?>


    </div>






    <footer>
      <!--  <p  >Don't have an account? <a href="#">Register here</a></p>  -->
    </footer>
    <?php include "includes/footer.php"; ?>
  </div>
</body>

</html>