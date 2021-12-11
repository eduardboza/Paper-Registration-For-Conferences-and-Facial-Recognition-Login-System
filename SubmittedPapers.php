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
    <link rel="stylesheet" href="css/SubmittedPapers.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>



    <div id="container">
        <?php include "includes/navigation.php"; ?>

        <div class="page_title">
            <h2>Submitted Papers</h2>
        </div>


        <div class="content">

            <div id="table">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Paper Title</th>
                            <th>Abstract</th>
                            <th>Date Uploaded</th>
                            <th>Conference</th>
                            <th>Edit</th>
                        </tr>
                        <thead>

                        </thead>
                    </thead>
                    <tbody>

                        <?php


                        if (!isset($_SESSION['userId'])) {
                            echo 'You have to be authenticated in order to access this page ';
                        } else { ?>

                            <?php

                            $selectquery = "SELECT uploads.*, conf.title AS conf_title, conf.isactive AS conf_isactive FROM `uploads`
   LEFT OUTER JOIN `conferences` AS conf ON uploads.conference_id=conf.id WHERE user_id='$_SESSION[userId]' ";
                            $query = mysqli_query($connection, $selectquery) or die("Bad Query: $selectquery");
                            //$nums = mysqli_num_rows($query);



                            if (mysqli_num_rows($query) > 0)
                                while ($res = mysqli_fetch_array($query)) { ?>


                                <tr>

                                    <td><?php echo $res['up_title']; ?></td>
                                    <td><?php echo $res['up_abstract']; ?></td>
                                    <td><?php echo $res['date']; ?></td>
                                    <td><?php echo $res['conf_title']; ?></td>

                                    <td><?php if ($res['conf_isactive']) {
                                            echo "<a class='fa fa-pencil-square-o' href='EditPaper.php?UPid={$res['up_id']}'></a><br>";
                                        } else {
                                            echo "Session is no longer available";
                                        } ?></td>

                            <?php }
                        }
                            ?>


                                </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
</body>

</html>