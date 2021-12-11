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
                $file_name = $articleid . '-' . $file_name;
                $file_destination = 'conferences/SISOM_2022/' . $file_name;
                //  $selectquery = "SELECT * FROM uploads WHERE up_id='$articleid' AND user_id='$sessionUserId' ";
                $update_article = "UPDATE uploads SET up_title='$title', up_authors='$authors', up_abstract='$abstract',
                    up_filePath='$file_destination' WHERE up_id='$articleid' AND user_id='$sessionUserId' ";
                if ($file_error === 0) {
                    if ($file_size > 0) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            $qry = mysqli_query($connection, $update_article);
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
            } else {
                $file_destination = 'empty';
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
