<?php
include 'database_connection.php';
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$user = [];

$postdata = file_get_contents('php://input');

$request = json_decode($postdata);

if ($postdata) {
    
    $avatar = $request->avatar;
    $mssv = $request->mssv;
    $sql = "UPDATE sinhvien set avatar ='".$avatar."' where mssv=".$mssv ;
     $result = mysqli_query($connect, $sql);
    
     if (mysqli_affected_rows($connect) != -1) {
        echo 1;
     } else {
         echo -1;
     }

}

?>
