<?php

include 'database_connection.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$activation_code = $request->activation_code;
$message = '';

if (isset($activation_code)) {

    $query = "
  SELECT * FROM sinhvien
  WHERE resetpasswordcode ='" . $activation_code . "'";

    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    $rand = rand(1000000,9999999);
    if ($row) {

        $update_query = "
UPDATE sinhvien
SET matkhau='" . $activation_code .
            "',resetpasswordcode= '".$rand."' WHERE resetpasswordcode ='" . $activation_code . "'";

        $result = mysqli_query($connect, $update_query);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        if ($result) {

            $message = 'Xác thực email thành công, bạn có thể đăng nhập !';
        } else {
            $message = 'Địa chỉ truy cập không hợp lệ !';
        }

    }
    else
        $message = 'Địa chỉ truy cập không hợp lệ !';
}

echo $message;
