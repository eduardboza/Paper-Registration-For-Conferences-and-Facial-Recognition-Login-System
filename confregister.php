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
  <style>
    * {
      /* 
        -May want to add "border-box for "box-sizing so padding does not affect width
        -Reset margin and padding 
       */

      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      /* 
          -Background color is #344a72
        */
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
      background-color: white;
      color: white;
      line-height: 1.8;
    }

    a {
      /* 
        Underlined links are ugly :)
       */
      text-decoration: none;
    }

    #container {
      /* 
        -Remember, margin: auto on left and right will center a block element 
        -I would also set a "max-width" for responsiveness
        -May want to add some padding
        */
      margin: 30px auto;
      max-width: 400px;
      padding: 20px;

    }

    .form-wrap {
      /* 
          This is the white area around the form and heading, etc
        */
      background-color: white;
      padding: 15px 25px;
      color: #333;
    }

    .form-wrap h1,
    .form-wrap p {
      /* 
          May want to center these
        */
      text-align: center;
    }

    .form-wrap .form-group {
      /* 
          Each label, input is wrapped in .form-group
        */
      margin-top: 15px;

    }

    .form-wrap .form-group label {
      /* 
          Label should be turned into a block element
        */
      display: block;
      /* asta a aliniat first last email pass */
      color: #666;
    }

    .form-wrap .form-group input {
      /* 
          Inputs should reach accross the .form-wrap 100% and have some padding
        */
      width: 100%;
      padding: 10px;
      border: #ddd 1px solid;
      border-radius: 5px;
    }

    .form-wrap button {
      /* 
          Button should wrap accross 100% and display as block
          Background color for button is #49c1a2
        */
      display: block;
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      background-color: #49c1a2;
      color: white;
      cursor: pointer;
    }

    .form-wrap button:hover {
      /* 
          Hover background color for button is #37a08e
        */
      background-color: #37a08e;
    }

    .form-wrap .bottom-text {
      /* 
          Bottom text is smaller
        */
      font-size: 13px;
      margin-top: 20px;
    }

    footer {
      /* 
        Should be centered
       */

      text-align: center;
      margin-top: 10px;
      color: black;
    }

    footer a {
      /* 
          Footer link color is #49c1a2
        */
      text-align: center;
      margin-top: 10px;
      color: #3e58ad;
    }
  </style>
</head>

<body>

  <?php include "includes/navigation.php"; ?>




  <div id="container">
    <div class="form-wrap">
      <h1>Conference Register</h1>



      <form action="ftp_upload.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" />
        </div>
        <div class="form-group">
          <label for="authors">Authors/Contributors</label>
          <input type="text" name="authors" id="authors" />
        </div>
        <div class="form-group">
          <label for="abstract">Abstract</label>
          <input type="text" name="abstract" id="abstract" />
        </div>
        <div>
          <label for="file">File (not mandatory)</label>
          <input type="file" name="srcfile" id="srcfile" />
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