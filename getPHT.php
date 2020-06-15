<?php

include 'database_connection.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$id = $request->id;

$sql = "SELECT * FROM phieuhotro t1
 JOIN sinhvien t2
    ON t1.mssv = t2.mssv
 WHERE idphieuhotro=" . $id;
$result = mysqli_query($connect, $sql);
$json_array = array();

if (mysqli_affected_rows($connect) != -1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $json_array[] = $row;
    }
    echo json_encode($json_array);
} else {
    echo -1;
}
