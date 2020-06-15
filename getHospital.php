<?php
include 'database_connection.php';

    $hos = [];

    
    $idDistrict = $request->id;
    $sql = "select * from benhvien";
    
    $result = mysqli_query($connect, $sql);
    if (mysqli_affected_rows($connect) != -1) {
        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            $hos[$i]['tenbenhvien'] = $row[1];
            $i++;
        }
        //encode array php thành chuỗi json
        echo json_encode($hos);
        //$string = implode(",",$user);
        //echo $string;
    } else {
        echo -1;
    }



?>
