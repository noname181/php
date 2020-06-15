<?php
include 'database_connection.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if (isset($postdata) && !empty($postdata)) {
    //decode đổi chuỗi json thành object php
    $request = json_decode($postdata);
    $id = $request->id;
    $sodienthoai= $request->sodienthoai;
    $email = $request->email;
    $sql = "UPDATE nhanvien SET sodienthoai='".$sodienthoai."', email='".$email."' WHERE idnhanvien=".$id;
    $result = mysqli_query($connect, $sql);
    if (mysqli_affected_rows($connect) > -1) {
        
        print_r(0);
    } else {
        print_r(-1);
    }

}
