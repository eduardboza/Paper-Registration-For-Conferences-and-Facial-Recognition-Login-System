<?php
require 'includes/db.php';
require 'includes/header.php';

if (isset($_POST['someAction'])) {
    // $articleid = mysqli_real_escape_string($connection, $_POST['articleid']);
    //$sessionUserId = mysqli_real_escape_string($connection, $_POST['sessionUserId']);
    $articleid =  $_POST['articleid'];
    //$sessionUserId =  $_POST['sessionUserId'];
    $sessionUserId = $_SESSION['userId'];
    $sql = "UPDATE uploads SET up_filePath=NULL WHERE up_id='$articleid' AND user_id='$sessionUserId' ";
    // echo $sql;
    // exit();
    $query = mysqli_query($connection, $sql) or die("Bad Query: $sql");
    header("Location: EditPaper.php?UPid=$articleid&error=FileDeletedSuccessfully");
    exit();
}

?>