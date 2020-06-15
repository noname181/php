<?php
include 'database_connection.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if (isset($postdata) && !empty($postdata)) {
    //decode đổi chuỗi json thành object php
    $request = json_decode($postdata);
    $id = $request->id;
    $password= $request->password;
    $type = $request->type;

    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    if($type == 1){
        $sql = "UPDATE nhanvien SET matkhau='".$encrypted_password."' WHERE idnhanvien=".$id;
        $result = mysqli_query($connect, $sql);
        if (mysqli_affected_rows($connect) > -1) {
            
            print_r($sql);
        } else {
            print_r(-1);
        }
    }
    if($type == 0){
        $sql = "UPDATE sinhvien SET matkhau='".$encrypted_password."' WHERE mssv=".$id;
        $result = mysqli_query($connect, $sql);
        if (mysqli_affected_rows($connect) > -1) {
            
            print_r($sql);
        } else {
            print_r(-1);
        }
    }
    

}
