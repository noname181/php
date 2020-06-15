<?php
    include 'database_connection.php';
    
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $id = $request->id;

    $listMessage = [];

    $sql = "SELECT t1.mssv,chat_message, t1.timestamp , t3.avatar, t3.hotensv
    FROM chat_message t1 
    JOIN
        (SELECT mssv, MAX(timestamp) as timestamp 
        FROM chat_message 
        WHERE to_user_id = ".$id." or from_user_id = ".$id."
        GROUP BY mssv) as t2
    ON t1.mssv = t2.mssv AND t1.timestamp = t2.timestamp
    JOIN sinhvien t3
    ON t1.mssv = t3.mssv order by t1.timestamp desc ";
    $result = mysqli_query($connect,$sql);
    $json_array = array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    } else {
        echo -1;
    }
   
?>