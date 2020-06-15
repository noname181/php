<?php
    include 'database_connection.php';

    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata))
    {
        $request = json_decode($postdata);

        $id = $_GET['id'];
        $first_name = $request->first_name;
        $email = $request->email;

        $sql = "update register_user set user_name ='".$first_name."', user_email ='".$email. "' where register_user_id =".$id;
        //echo $sql;
        $result = mysqli_query($connect,$sql);
        if(mysqli_affected_rows($connect))
            echo "Success";
        else
            echo "Failed";
    }

?>