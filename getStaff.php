<?php
include 'database_connection.php';

$postdata = file_get_contents('php://input');

$request = json_decode($postdata);

if ($postdata) {
    $id = $request->id;
    $respone = array();
    $sql = "SELECT t1.idnhanvien,t1.hoten, t1.email, t1.sodienthoai,t2.avatar,t1.mssv FROM
         (SELECT * FROM nhanvien  WHERE idnhanvien ='" . $id . "') t1
    JOIN sinhvien t2
    ON t1.mssv = t2.mssv ";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $respone[] = $row;
    }
    if ($respone == []) {
        $sql = "SELECT * FROM
        nhanvien  WHERE idnhanvien ='" . $id . "'";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $respone[] = $row;
        }
    }

    echo json_encode($respone);

}
