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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/EditPaper.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- <script src="scss/EditPaper.scss"></script> -->
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/EditPaper.css" type="text/css" />
</head>

<body>
  <script src="js/EditPaper.js"></script>
  <?php include "includes/navigation.php"; ?>
  <div id="container">
    <div class="form-wrap">

      <?php if (isset($_GET['UPid'])) {

        $UPid = mysqli_real_escape_string($connection, $_GET['UPid']);
        $selectquery = "SELECT uploads.*, conf.title AS conf_title, conf.isactive AS conf_isactive FROM `uploads`
   LEFT OUTER JOIN `conferences` AS conf ON uploads.conference_id=conf.id WHERE up_id='$_GET[UPid]' ";
        $query = mysqli_query($connection, $selectquery) or die("Bad Query: $selectquery");
        $res = mysqli_fetch_array($query);

      ?>

        <h1> <?php

              echo "Edit your submit for " . $res['conf_title'];
              ?>

        </h1><br>
      <?php

      } else {
        echo "User id problem on session ";
      } ?>



      <?php
      $articleid = $_GET['UPid'];
      // echo $articleid;
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyfields") { ?>
          <p style="color:red">First 3 fields are mandatory!</p>
        <?php } elseif ($_GET["error"] == "uploadsuccesswithoutpdf") { ?>
          <p style="color:green">Edit success without pdf!</p>
        <?php } elseif ($_GET["error"] == "uploadsuccess") { ?>
          <p style="color:green">Edit success!</p>
      <?php
        }
      }
      ?>
      <form action="UploadEditPaper3.php" method="post" enctype="multipart/form-data">

        <div class="form-group">

          <label for="title">Paper Title</label>
          <textarea name="title" id="title" cols="25" rows="3"><?php echo $res['up_title']; ?></textarea>

        </div>
        <div class="form-group">
          <label for="authors">Authors and Contributors</label>
          <textarea name="authors" id="authors" cols="25" rows="3"><?php echo $res['up_authors']; ?></textarea>

        </div>
        <div class="form-group">

          <label for="abstract">Abstract</label>
          <!-- <textarea name="abstract" id="abstract" cols="25" rows="8"><//?php echo $res['up_abstract']; ?></textarea> -->
          <textarea class="txta" name="abstract" id="abstract" cols="25" rows="8"><?php echo $res['up_abstract']; ?></textarea>
        </div>

        <div>
          <label for="file">File (not mandatory) - you can upload this later</label>
          <input type="file" name="file" id="file" />
        </div>

        <div>
          <input type="hidden" name="UPid" value="<?= $_GET['UPid'] ?>" />
        </div>
        <button type="submit" name="edit" value="Edit Paper" class="btn">Edit</button>
        <br><br>


      </form>
    </div>
  </div>


  <div id="table">
    <table class="content-table">
      <thead>
        <tr>
          <th>File Uploaded</th>
          <th>View</th>
          <th>Download</th>
          <th>Delete</th>
        </tr>
        <thead>

        </thead>
      </thead>
      <tbody>
        <tr>

          <td style="text-align:center"><?php echo substr($res['up_filePath'], 23); ?></td>
          <td style="text-align:center"><a href="<?php echo $res['up_filePath']; ?>" target="_blank">View</a></td>
          <td style="text-align:center"><a href="<?php echo $res['up_filePath']; ?>" download>Download</td>
          <td style="text-align:center">
            <form method="post" action="DeleteFileUploaded.php">
              <input type="hidden" name="someAction" value="GO">
              <input type="hidden" name="articleid" value="<?= $articleid ?>">
              <input type="hidden" name="sessionUserId" value="<?= $sessionUserId ?>">
              <?php echo '<a href="DeleteFileUploaded.php"> <div class="main-box"><div class="icon-box"><i class="fas fa-trash-alt icon trash-icon"></i> </div></div></a>';              ?>
              <input type="submit" value="Delete">
            </form>
          </td>



          <!-- <td style="text-align:center"><?php //echo '<a href="DeleteFileUploaded.php"> <div class="main-box"><div class="icon-box"><i class="fas fa-trash-alt icon trash-icon"></i> </div></div></a>'; 
                                              ?></td> -->

          <!-- <form method="post" action="DeleteFileUploaded.php">
            <input type="hidden" name="someAction" value="GO">
            <input type="submit">
          </form> -->


          <!-- pt butonul de delete:  $sql = "UPDATE uploads SET up_filePath=NULL WHERE up_id='$articleid' AND user_id='$sessionUserId' "; -->


        </tr>

      </tbody>
    </table>
  </div>



  <?php include "includes/footer.php"; ?>


</body>

</html>