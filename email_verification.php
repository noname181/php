<?php

include 'database_connection.php';

$message = '';

if (isset($_GET['activation_code'])) {
    $query = "
  SELECT * FROM register_user
  WHERE user_activation_code = :user_activation_code
 ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':user_activation_code' => $_GET['activation_code'],
        )
    );
    $no_of_row = $statement->rowCount();

    if ($no_of_row > 0) {
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            if ($row['user_email_status'] == 'not verified') {
                $update_query = "
    UPDATE sinhvien
    SET password = '". $_GET['activation_code']."' 
    WHERE resetpasswordcode = '" . $row['activation_code'] . "'
    ";
                $statement = $connect->prepare($update_query);
                $result = $statement->execute();
                
                if (isset($result)) {
                    $message = 'Your Email Address Successfully Verified.You can login here';
                }
            } else {
                $message = 'Your Email Address Already Verified';
            }
        }
    } else {
        $message = 'Invalid Link';
    }
}

