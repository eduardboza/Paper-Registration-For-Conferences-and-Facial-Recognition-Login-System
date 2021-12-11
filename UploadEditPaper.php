<?php
require 'includes/db.php';
require 'includes/header.php';
//session_start();
$title = $_POST['title'];
//echo $title; 
$authors = $_POST['authors'];
//echo $authors;
$abstract = $_POST['abstract'];
//echo $abstract;
$articleid = $_POST['UPid'];   //era inainte confid
//echo $articleid;
$sessionUserId = $_SESSION['userId'];
//echo $_SESSION['userId'];


// if (!isset($_SESSION['userId'])){

//     header{

//     }
//     exit();
// }



if (isset($_SESSION['userId'])) {
    if (isset($articleid)) {
        if (isset($_POST['edit'])) {
            $file = $_FILES['file'];


            //file properties
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            //work out the file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            $allowed = array('pdf');


            if (empty($title) || empty($authors) || empty($abstract)) {
                header("Location: EditPaper.php?error=emptyinput");
                exit();
            }


            if (in_array($file_ext, $allowed)) {
                // get last record id
                $sql = 'SELECT max(up_id) as id from uploads';
                $result = mysqli_query($connection, $sql);
                if ($result) {
                    $row = mysqli_fetch_array($result);
                    $file_name = ($row['id'] + 1) . '-' . $file_name;

                    if ($file_error === 0) {

                        if ($file_size > 0) {
                            //    $file_name_new = uniqid('', true) . '.' . $file_ext ;       
                            //    $file_destination = 'conferences/SISOM_2022' . $file_name_new;


                            $file_destination = 'conferences/SISOM_2022/' . $file_name;


                            if (move_uploaded_file($file_tmp, $file_destination)) {
                                //echo $file_destination;  asta cred ca e up_filePath

                                //session_start();
                                $file_destination = 'conferences/SISOM_2022/' . $file_name;
                                // $sql = "INSERT INTO uploads(user_id, conference_id, up_title, up_authors, up_abstract, up_filePath) VALUES('$_SESSION[userId]', '$confid', '$title', '$authors', '$abstract', '$file_destination')";
                                $selectquery = "SELECT * FROM uploads WHERE up_id='$articleid' AND user_id='$sessionUserId' ";
                                // de verificat ca exista 1 si numai 1. daca nu e 1, ori nu are acces ori nu exista info. 
                                $update_article = "UPDATE uploads SET up_title='$title', up_authors='$authors', up_abstract='$abstract',
                                up_filePath='$file_destination' WHERE up_id='$_POST[UPid]' ";
                                //echo $update_article;
                                mysqli_query($connection, $update_article);


                                //  $ssqqll = "SELECT uploads.*, conf.title AS conf_title, conf.isactive AS conf_isactive FROM `uploads`
                                //   LEFT OUTER JOIN `conferences` AS conf ON uploads.conference_id=conf.id WHERE up_id='$_GET[UPid]'; 
                                //   UPDATE uploads SET up_title='$title', up_authors='$authors', up_abstract='$abstract',
                                //    up_filePath='$file_destination' WHERE up_id='$articleid'; " ;

                                //    mysqli_query($connection, $ssqqll);

                                header("Location: index.php?error=uploadsuccess");
                                exit();
                            } else {
                                header("Location: EditPaper.php?error=moveuploadedfile");
                                exit();
                            }
                        } else {
                            header("Location: EditPaper.php?error=filesizemaimicdecat0");
                            exit();
                        }
                    } else {
                        header("Location: EditPaper.php?error=fileerror");
                        exit();
                    }
                }
            } else {
                // insert file details into database
                $file_destination = 'conferences/SISOM_2022/' . $file_name;
                //session_start();
                //$_SESSION['userId'] = $row['user_id'];
                // $sql = "INSERT INTO uploads(user_id, conference_id, up_title, up_authors, up_abstract) 
                // VALUES('$_SESSION[userId]', '$confid', '$title', '$authors', '$abstract')";
                $selectquery = "SELECT * FROM uploads WHERE up_id='$articleid' AND user_id='$sessionUserId' ";
                $update_article = "UPDATE uploads SET up_title='$title', up_authors='$authors', up_abstract='$abstract',
  up_filePath='$file_destination' WHERE up_id='$articleid' AND user_id='$sessionUserId' ";



                $qry =  mysqli_query($connection, $update_article);

                header("Location: index.php?error=uploadsuccesswithoutpdf");
                exit();
            }
        } else {
            header("Location: EditPaper.php?error=fileisnotset");
            exit();
        }
    } else {
        echo "error";
    }
} else {
    echo "Nu corespunde user id";
}
