<?php
include 'database_connection.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require "./Jwt/vendor/autoload.php";
use \Firebase\JWT\JWT;


$postdata = file_get_contents("php://input");



if (isset($postdata) && !empty($postdata)) {
    
    //decode đổi chuỗi json thành object php
    $request = json_decode($postdata);
    $id = $request->username;
    $password = $request->password;
    $type = $request->type;

    if ($type == '0') {
        $sql = "select * from sinhvien where mssv =" . $id;
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['matkhau'])) {

            $secret_key = "123456";
            $issuer_claim = "THE_ISSUER"; // this can be the servername
            $audience_claim = "THE_AUDIENCE";
            $issuedat_claim = time(); // issued at
           
            $notbefore_claim = $issuedat_claim - 10; //not before in seconds
            $expire_claim = $issuedat_claim + 1800; // expire time in seconds
            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $id,
                    "password" => $password,
                    "type" => $type,
                ));

            http_response_code(200);

            $jwt = JWT::encode($token, $secret_key);
            echo json_encode(
                array(
                    "message" => "Successful login.",
                    "jwt" => $jwt,
                    "email" => $email,
                    "expireAt" => $expire_claim,
                    "mssv"=>$row['mssv']
                ));
            
        } else {
            echo 0;
        }

    }
    if ($type == '1') {
        $sql = "select * from nhanvien where email ='" . $id . "'";

        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['matkhau']) && $row['idloaichucvu'] != '2') {
            //   echo $row['idnhanvien'];
            // if (password_verify($password, $row['matkhau'])) {

            $respone = array();
            $sql = "SELECT t1.idnhanvien,t1.hoten, t1.email, t1.sodienthoai,t2.avatar FROM
                 (SELECT * FROM nhanvien  WHERE email ='" . $id . "') t1
            JOIN sinhvien t2
            ON t1.mssv = t2.mssv ";
            $result = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $respone[] = $row;
            }
            echo json_encode($respone);
        } else if (password_verify($password, $row['matkhau']) && $row['idloaichucvu'] == '2') {

            $respone = array();

            $respone[] = $row;

            echo json_encode($respone);
        } else {
            echo 0;
        }
    }

}
