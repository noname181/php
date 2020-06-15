<?php
    include 'database_connection.php';

    $id = $_REQUEST['id'];

    $sql = "select * from register_user where register_user_id=" .$id;

    $result = mysqli_query($connect,$sql);

    $row = mysqli_fetch_assoc($result);

    echo json_encode($row); 

?>