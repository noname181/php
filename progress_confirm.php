<?php
include 'database_connection.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;

$sql = "SELECT 
* FROM chitietphieuhotro c
JOIN nhanvien n
    ON c.idnhanvien = n.idnhanvien
JOIN loaitrangthai l
    ON c.idloaitrangthai = l.idloaitrangthai
WHERE idphieuhotro =" . $id;

$result = mysqli_query($connect, $sql);
$json_array = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $json_array[] = $row;
    }
    echo json_encode($json_array);

} else {
    echo -1;
}
