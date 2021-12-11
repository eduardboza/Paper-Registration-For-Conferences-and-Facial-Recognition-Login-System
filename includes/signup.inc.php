<?php

if(isset($_POST['signup-submit'])){

    require 'db.php';

    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password2'];

    if( empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordRepeat) ){
            header("Location: ../signup.php?error=emptyinput");
            exit();
            // header("Location: ../signup.php?error=emptyfields&firstName=".$firstname. "&lastName=" . $lastname .  "&email=".$email . "&password=" . $password . "&passwordRepeat=" . $passwordRepeat );
            // exit();
    }
    elseif(!preg_match("/^[a-zA-Z]*$/",$firstname)){
        header("Location: ../signup.php?error=invalidfirstname");
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z]*$/",$lastname)){
        header("Location: ../signup.php?error=invalidlastname");
        exit();
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) ){
        header("Location: ../signup.php?error=invalidemail");
        exit();
    }

    elseif($password !== $passwordRepeat){
        header("Location: ../signup.php?error=passwordcheck");
        exit();
    }
    else{

        $sql = "SELECT user_email FROM users WHERE user_email=?";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else{
           mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck>0){
                header("Location: ../signup.php?error=stmterror");
                exit();
            }
            else{

                $sql = "INSERT INTO users (user_firstname, user_lastname, user_email, user_password) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
            }
            else{

                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $hashedPwd);
            mysqli_stmt_execute($stmt);
            header("Location: ../signup.php?error=successfullySignedUp");
                    exit();
            }
        }
     }
 }  
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}
else{
    header("Location: ../signup.php");
    exit();
}


?>

