<?php

if( isset($_POST['login-submit'])){

require 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

if(empty($email) || empty($password)){
    header("Location: ../signin.php?error=emptyinput");
    exit(); }
   else{
    $sql = "SELECT * FROM users WHERE user_email=?";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)){

                $passwordCheck = password_verify($password, $row['user_password']);
               


                if($passwordCheck==false){
                    header("Location: ../signin.php?error=wrongpassword");
                    exit();
                }elseif($passwordCheck==true){
                    
                    session_start();
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['userFirstname'] = $row['user_firstname'];
                    $_SESSION['userLastname'] = $row['user_lastname'];
                    header("Location: ../index.php?login=success");
                    exit();

                }else{
                    header("Location: ../signin.php?error=wrongpassword");
                    exit();
                }

        }else{
            header("Location: ../signin.php?error=nouser");
            exit();
        }


    }
   }
}




    //Facial Recognition log in
    elseif( isset($_POST['login-submit-FacialRecognition'])){
        require 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

if(empty($email) || empty($password)){
    header("Location: ../signin.php?error=emptyinput");
    exit(); }
   else{
    $sql = "SELECT * FROM users WHERE user_email=?";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)){

                $passwordCheck = password_verify($password, $row['user_password']);
               


                if($passwordCheck==false){
                    header("Location: ../signin.php?error=wrongpassword");
                    exit();
                }elseif($passwordCheck==true){
                    
                    session_start();
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['userFirstname'] = $row['user_firstname'];
                    $_SESSION['userLastname'] = $row['user_lastname'];
                    header("Location: ../index.php?login=success-Facial-Recognition");
                    exit();

                }else{
                    header("Location: ../signin.php?error=wrongpassword");
                    exit();
                }

        }else{
            header("Location: ../signin.php?error=nouser");
            exit();
        }


    }
   }
    }


    else{

    header("Location: ../index.php");
    exit();

    }


?>