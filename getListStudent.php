<?php

include 'database_connection.php';

$sql = "SELECT * FROM sinhvien";
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
