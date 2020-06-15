<?php

include 'database_connection.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if ($request->type == '1') {
    $sql = "SELECT * FROM nhanvien";
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
} else if ($request->type == '2') {
    $sql = "SELECT * FROM loaihotro";
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
}else if ($request->type == '3') {
    $status = $request->status == '1' ? 0 : 1;
    $id = $request->id;
    $sql = "UPDATE loaihotro SET active=".$status." WHERE idloaihotro=".$id;
    mysqli_query($connect, $sql);

    $sql = "SELECT * FROM loaihotro";
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
}

