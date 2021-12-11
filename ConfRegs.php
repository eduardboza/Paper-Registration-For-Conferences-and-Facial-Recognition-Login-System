<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <title>Form Styling</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" />
  <link rel="stylesheet" href="css/ConfRegs.css" type="text/css" />
</head>

<body>

  <?php include "includes/navigation.php"; ?>



  <?php if (isset($_GET['ID'])) {

    $ID = mysqli_real_escape_string($connection, $_GET['ID']);

    $sql = "SELECT * FROM conferences WHERE id='$ID' ";
    $result = mysqli_query($connection, $sql) or die("Bad Query: $sql");
    $row = mysqli_fetch_array($result);
  } else {
    header('Location: index.php');
  } ?>




  <div id="container">
    <div class="form-wrap">
      <!-- <h1>Conference Register</h1> -->
      <h1><?php echo $row['title'] . " Register" ?></h1><br>



      <?php if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") { ?>
          <p style="color:red">First 3 fields are mandatory!</p>
        <?php } elseif ($_GET["error"] == "uploadsuccesswithoutpdf") { ?>
          <p style="color:green">Upload success without pdf!</p>
        <?php } elseif ($_GET["error"] == "uploadsuccess") { ?>
          <p style="color:green">Upload success!</p>
      <?php
        }
      }
      ?>


      <form action="upload.php" method="post" enctype="multipart/form-data">

        <div class="form-group">

          <label for="title">Paper Title</label>
          <textarea name="title" id="title" cols="25" rows="1"></textarea>

        </div>
        <div class="form-group">
          <label for="authors">Authors and Contributors</label>
          <textarea name="authors" id="authors" cols="25" rows="1"></textarea>

        </div>
        <div class="form-group">
          <label for="abstract">Abstract</label>
          <textarea name="abstract" id="abstract" cols="25" rows="7"></textarea>
        </div>
        <div>
          <label for="file">File (not mandatory) - you can upload this later</label>
          <input type="file" name="file" id="file" />
        </div>
        <div>
          <input type="hidden" name="ID" value="<?= $_GET['ID'] ?>" />
        </div>
        <button type="submit" name="submit" value="Upload File to FTP Server" class="btn">Upload</button>



      </form>
    </div>

    <footer>
      <!-- <p  >Don't have an account? <a href="#">Register here</a></p> -->
    </footer>
    <?php include "includes/footer.php"; ?>
  </div>
</body>

</html>