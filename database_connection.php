<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "./Jwt/vendor/autoload.php";
use \Firebase\JWT\JWT;




$connect = mysqli_connect("45.252.248.26", "nonameec", "tinhyeuhoagio2@", "nonameec_hotrosv");

mysqli_set_charset($connect, 'utf8mb4');

function checkToken()
{
    $secret_key = "123456";
    $jwt = null;

    $authHeader = $_SERVER['HTTP_AUTHORIZATION'];

  
    $arr = explode(" ", $authHeader);
    $jwt = $arr[1];

    if ($jwt) {
        
        try {

            $decoded = JWT::decode($jwt, $secret_key,['HS256']);

            // Access is granted. Add code of the operation here

            // echo json_encode(array(
            //     "message" => "Access granted:",
            // ));
            return 1;

        } catch (Exception $e) {

            // http_response_code(401);

            // echo json_encode(array(
            //     "message" => "Access denied.",
            //     "error" => $e->getMessage(),
            // ));
            return -1;
        }

    }
}

if (!$connect) {
    echo "Connection failed: " . mysqli_connect_error();
    exit();
} else {
    // echo "Connect successfully";
}

//$result = mysqli_query($connect,"drop table noname1");
//$result = mysqli_query($connect,"delete from register_user where register_user_id = '73'");
//$result = mysqli_query($connect,"create table noname12 select * from register_user");
//$test = mysqli_real_escape_string($connect,"'cc''$'ccc'");

//$result = mysqli_query($connect,"insert into register_user (user_name) values ('ccccccccc') ");

//$result = mysqli_query($connect,"update register_user set user_name = 'gggg' where register_user_id = 43 ");
//$result = mysqli_query($connect,"select * from register_user");
//while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
//printf ("%s (%s) (%s) (%s) (%s) (%s)<br>", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[1]);
//    echo '<br>'.json_encode($row).'<br><br>';
//printf("<br>Error - SQLSTATE %s.\n", mysqli_sqlstate($connect));
//printf("<br>Server version: %s\n", mysqli_get_server_info($connect));
//printf("<br>Client library version: %s\n", mysqli_get_client_info());
//echo '<br>Affected_row: '.mysqli_affected_rows($connect).'<br>';
//echo '<br>Field count: '.mysqli_field_count($connect);
//echo password_hash('123456', PASSWORD_DEFAULT);
