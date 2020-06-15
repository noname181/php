<?php
    include 'database_connection.php';
     header('Access-Control-Allow-Origin: *');
     header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
     header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

    $postdata = file_get_contents("php://input");
    
    
    //print_r($request);

    if(isset($postdata) && !empty($postdata))
    {
        //decode đổi chuỗi json thành object php
        $request = json_decode($postdata);
        $user_name = $request->first_name;
        $user_email = $request->email;
        $sql = "insert into register_user (user_name,user_email,user_password,user_activation_code) values ('".$user_name."','".$user_email."','123456','123456')";
?>

<?php
        $result = mysqli_query($connect,$sql);
        if(mysqli_affected_rows($connect) > -1)
            print_r("Update Successfully");
        else
            print_r("Failed------".$sql);
    }
?>
