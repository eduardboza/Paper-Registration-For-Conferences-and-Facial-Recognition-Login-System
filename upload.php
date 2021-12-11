<?php
require 'includes/db.php';

$title = $_POST['title'];
$authors = $_POST['authors'];
$abstract = $_POST['abstract'];
$confid = $_POST['ID'];


if(isset($confid)){
if(isset($_POST['submit'])){
    $file=$_FILES['file'];
    

    //file properties
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    //work out the file extension
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));
    $allowed = array('txt', 'pdf');


    if( empty($title) || empty($authors) || empty($abstract) ){
        header("Location: ConfRegs.php?error=emptyinput");
        exit();
       } 
          
       
       if(in_array($file_ext, $allowed)){
        // get last record id
        $sql = 'SELECT max(up_id) as id from uploads';
        $result = mysqli_query($connection, $sql);
        if($result){
            $row = mysqli_fetch_array($result);
            $file_name = ($row['id']+1) . '-' . $file_name;

        if($file_error ===0){

            if($file_size > 0){
            //    $file_name_new = uniqid('', true) . '.' . $file_ext ;       
            //    $file_destination = 'conferences/SISOM_2022' . $file_name_new;

               
               $file_destination = 'conferences/SISOM_2022/' . $file_name;


                if(move_uploaded_file($file_tmp, $file_destination)){
         //echo $file_destination;  asta cred ca e up_filePath
         
         session_start();
         //$_SESSION['userId'] = $row['user_id'];
         $sql = "INSERT INTO uploads(user_id, conference_id, up_title, up_authors, up_abstract, up_filePath) VALUES('$_SESSION[userId]', '$confid', '$title', '$authors', '$abstract', '$file_destination')";
         mysqli_query($connection, $sql);
         header("Location: index.php?error=uploadsuccess");
         exit();
                }else
                {
                    header("Location: ConfRegs.php?error=moveuploadedfile");
                    exit();
                }

            }else
            {
                header("Location: ConfRegs.php?error=filesizemaimicdecat0");
                exit();
            }
        } else
        {
            header("Location: ConfRegs.php?error=fileerror");
            exit();
        } 
    }
  }
       
       
       
       
       else 
               {
           // insert file details into database
           
           session_start();
           //$_SESSION['userId'] = $row['user_id'];
           $sql = "INSERT INTO uploads(user_id, conference_id, up_title, up_authors, up_abstract) 
                                    VALUES('$_SESSION[userId]', '$confid', '$title', '$authors', '$abstract')";
           mysqli_query($connection, $sql);
           header("Location: index.php?error=uploadsuccesswithoutpdf");
           exit();
                  }



   
}else
{
    header("Location: ConfRegs.php?error=fileisnotset");
    exit();
} 

} else {
    echo "error";
}
