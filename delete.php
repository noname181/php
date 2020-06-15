<?php
    include 'database_connection.php';

    $id = $_REQUEST['id'];

    $sql = "delete from register_user where register_user_id=". $id ;

    $result = mysqli_query($connect,$sql);

    if(mysqli_affected_rows($connect))
        echo "Success";
    else
        echo "Failed";
?>