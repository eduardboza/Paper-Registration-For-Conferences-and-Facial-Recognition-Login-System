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

if (!isset($_SESSION['userId'])) {
    header("Location: signin.php?YouHaveToLogin");
    exit();
} else {
    if (!isset($articleid)) {
        echo "Articleid is not set";
        exit();
    } else {
        if (!isset($_POST['edit'])) {
            echo "nu s a transmis prin butonul de la cealalta pagina";
            exit();
        } else {
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
                header("Location: EditPaper.php?UPid=$articleid&error=emptyfields");
                exit();
            } else {

                $file_name = $articleid . '-' . $file_name;
                $update_article = "UPDATE uploads SET up_title='$title', up_authors='$authors', up_abstract='$abstract',
                up_filePath='$file_destination' WHERE up_id='$articleid' AND user_id='$sessionUserId' ";
                if (in_array($file_ext, $allowed) == 0) {
                    $file_destination = NULL;
                    $update_article_without_pdf = "UPDATE uploads SET up_title='$title', up_authors='$authors', up_abstract='$abstract' WHERE up_id='$articleid' AND user_id='$sessionUserId' ";
                    $qry =  mysqli_query($connection, $update_article_without_pdf);
                    header("Location: EditPaper.php?UPid=$articleid&error=uploadsuccesswithoutpdf");
                    exit();
                } else {
                    $file_destination = 'conferences/SISOM_2022/' . $file_name;
                    if ($file_error != 0) {
                        header("Location: EditPaper.php?UPid=$articleid&error=fileerror");
                        exit();
                    } else {
                        if ($file_size < 0) {
                            header("Location: EditPaper.php?UPid=$articleid&error=filesizemaimicdecat0");
                            exit();
                        } else {

                            if (move_uploaded_file($file_tmp, $file_destination) == 0) {
                                header("Location: EditPaper.php?UPid=$articleid&error=moveuploadedfile");
                                exit();
                            } else {
                                $update_article_with_pdf = "UPDATE uploads SET up_title='$title', up_authors='$authors', up_abstract='$abstract',
                                up_filePath='$file_destination' WHERE up_id='$articleid' AND user_id='$sessionUserId' ";

                                // pt butonul de delete:  $sql = "UPDATE uploads SET up_filePath=NULL WHERE up_id='$articleid' AND user_id='$sessionUserId' ";

                                $qry = mysqli_query($connection, $update_article_with_pdf);
                                header("Location: EditPaper.php?UPid=$articleid&error=uploadsuccess");
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }
}
