<?php

require_once 'config.php';
require_once 'functions_ftp.php';

//FTP Connection
$ftp_connection = ftp_connect($ftp_host, $port=14147) or die("Couldn't connect to $ftp_host");
ftp_login($ftp_connection, $ftp_user, $ftp_pass) or die("Couldn't login to ftp server");
ftp_pasv($ftp_connection, true);

$local_dir ="C:\upload_ftp_dir" ;
$remote_server_dir = "/SISOM_2022" ;

pre_r(upload_files($ftp_connection,$local_dir,$remote_server_dir));
