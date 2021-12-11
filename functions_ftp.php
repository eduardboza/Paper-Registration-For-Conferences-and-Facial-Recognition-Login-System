<?php

const BR = '<br />';

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function local_server_path_to_http($local_server_path){
    $http_path = preg_replace("!.*?\:\\\!","http://",$local_server_path);
    $http_path = preg_replace("! !","%20",$http_path);
    $http_path = preg_replace("!\\\!","/",$http_path);
    return $http_path;
}

function clean_scandir($dir){
    return array_values(array_diff(scandir($dir), array('..', '.')));
}

function clean_ftp_nlist($ftp_connection,$server_dir){
    $files_on_server = ftp_nlist($ftp_connection,$server_dir);
    //clean up . and .. from the files array and resete array values 
    return array_values(array_diff($files_on_server,array('.','..')));
}

function clean_readdir($dir){
    $files = array();
    //read files from a local directory
    //opendir ( string $path ) : resource
    if ($handle = opendir($dir)) {
        //readdir ([ resource $dir_handle ] ) : string
        while (false !== ($file_name = readdir($handle))) {
            //skip . and ..
            if ($file_name != "." && $file_name != "..") {
                $files[] = $file_name;
            }
        }
        // closedir ([ resource $dir_handle ] ) : void
        // close directory stream
        closedir($handle);
    }    
    return $files;
}

function copy_files($from_dir, $to_dir){

    $files = clean_scandir($from_dir);

    for ($i=0;$i<count($files);$i++){
        //file_exists ( string $filename ) : bool
        if (!file_exists("$to_dir/$files[$i]")){
        //copy ( string $source , string $dest ) : bool
            if(copy("$from_dir/$files[$i]", "$to_dir/$files[$i]")){
                echo "Copied $files[$i] to $to_dir/$files[$i]".BR;
            }
            else {
                echo "Couldn't copy $files[$i]".BR;
            }
        }
        else {
            echo "$to_dir/$files[$i] exists!".BR;
        }
    }
    return clean_scandir($to_dir);
}

function upload_files($ftp_connection,$local_dir,$server_dir){

    $files = clean_scandir($local_dir);

    for ($i=0;$i<count($files);$i++){
        //ftp_nlist ( resource $ftp_stream , string $directory ) : array
        //ftp_nlist — Returns a list of files in the given directory
        $files_on_server = clean_ftp_nlist($ftp_connection, $server_dir);
        if (!in_array("$files[$i]",$files_on_server))
        {
            //upload images/files to remote server directory
            if (ftp_put($ftp_connection, "$server_dir/$files[$i]", "$local_dir/$files[$i]", FTP_BINARY)){
                echo "Successfully uploaded $files[$i]".BR;
            }
            else {
                echo "There was a problem while uploading $files[$i]".BR;
            }
        }
        else {
            echo "$server_dir/$files[$i] exists!".BR;
        }
    }
    $files_on_server = clean_ftp_nlist($ftp_connection,$server_dir);
    ftp_close($ftp_connection);
    return $files_on_server;
}

function remove_ext($file_name){
    return preg_replace("!.(jpg|gif|jpeg|png)!i","",$file_name);
}
