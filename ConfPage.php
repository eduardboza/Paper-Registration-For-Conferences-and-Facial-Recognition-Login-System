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
  <link rel="stylesheet" href="css/ConfPage.css" type="text/css" />
</head>

<body>

  <?php include "includes/navigation.php"; ?>


  <div id="container">
    <div class="form-wrap button">

      <?php if (isset($_GET['ID'])) {

        $ID = mysqli_real_escape_string($connection, $_GET['ID']);

        $sql = "SELECT * FROM conferences WHERE id='$ID' ";
        $result = mysqli_query($connection, $sql) or die("Bad Query: $sql");
        $row = mysqli_fetch_array($result);
      } else {
        header('Location: index.php');
      }
      ?>

      <h1><?php echo $row['title'] ?></h1><br><br><br><br><br><br>


      <!-- <br><br><br><br><br> -->

      <h5>Location</h5>
      <p><?php echo $row['location'] ?></p> <br><br><br>

      <h5>Period</h5>
      <p><?php echo $row['period'] ?></p> <br><br><br>

      <h5>Description</h5>
      <p><?php echo $row['description'] ?></p>



    </div>





    <div id="container">
      <div class="form-wrap button">
        <footer>
          <?php
          require_once 'includes/db.php';
          $sql = "SELECT * FROM conferences";
          $result = mysqli_query($connection, $sql) or die("Bad Query: $sql");
          if ($row['isactive'] == 1) { ?>
            <!-- echo '<form method="POST" action="ConfRegs.php">  
                 <button type="submit" name="Register" value="Register to a conference" class="btn">Register</button> <br>
                 </form>'; -->
            <div>
              <!-- <a href="ConfRegs.php?ID={$row['id']}'" class="xyz">Register</a> -->
              <?php echo "<a class='xyz' href='ConfRegs.php?ID={$row['id']}'>Register</a><br>"; ?>
            </div>

          <?php     } else {
            echo "<br>";
          }  ?>

          <?php

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
          ?>


            <?php } ?>




          <?php
          } else {
            echo "<br>";
          }

          ?>
        </footer>
      </div>
    </div>
    <?php include "includes/footer.php"; ?>
  </div>
</body>

</html>