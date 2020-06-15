<?php
//register.php

include 'database_connection.php';

echo 'SESSION....'.$_SESSION['login'];
// $postdata = file_get_contents("php://input");

// $request = json_decode($postdata);
// $email = $request->email;
// $password = $request->password;

// $message = '';

// $query = "
// SELECT * FROM sinhvien
//  WHERE email = :email
//  ";
// $statement = $connect->prepare($query);
// $statement->execute(
//     array(
//         ':email' => $email,
//     )
// );
// $no_of_row = $statement->rowCount();
// if ($no_of_row = 0) {
//     $message = '<label class="text-danger">Email chưa đăng ký</label>';
// } else {
//     //$user_password = rand(100000,999999);
//     $user_encrypted_password = $password;
//     //$user_encrypted_password = password_hash($password, PASSWORD_DEFAULT);
//     $user_activation_code = md5(rand());
//     $insert_query = "
//   UPDATE sinhvien set resetpasswordcode = :user_activation_code";
//     $statement = $connect->prepare($insert_query);
//     $result = $statement->execute(
//         array(
//             ':user_activation_code' => $user_encrypted_password            
//         )
//     );
//     if ($result) {

//         $base_url = "http://localhost:3001/";
//         $mail_body = "
// <p>Hi " . $email . ",</p>
// <p>Thanks for Registration. Your password is " . ", This password will work only after your email verification.</p>
// <p>Please Open this link to verified your email address - " . $base_url . "email_verification.php?activation_code=" . $user_encrypted_password. "
// <p>Best Regards,<br />Webslesson</p>
// ";
//         require 'class/class.phpmailer.php';
//         require 'class/class.smtp.php';
//         $mail = new PHPMailer;
//         $mail->IsSMTP(); //Sets Mailer to send message using SMTP
//         $mail->Host = 'smtp.gmail.com'; //Sets the SMTP hosts of your Email hosting, this for Godaddy
//         $mail->Port = '465'; //Sets the default SMTP server port
//         $mail->SMTPAuth = true; //Sets SMTP authentication. Utilizes the Username and Password variables
//         $mail->Username = 'l.h.thuong181@gmail.com'; //Sets SMTP username
//         $mail->Password = 'myfdqxvyoakztoav'; //Sets SMTP password
//         $mail->SMTPSecure = 'ssl'; //Sets connection prefix. Options are "", "ssl" or "tls"
//         $mail->From = 'l.h.thuong181@gmail.com'; //Sets the From email address for the message
//         $mail->FromName = 'Noname'; //Sets the From name of the message
//         $mail->AddAddress($_POST['user_email'], $_POST['user_name']); //Adds a "To" address
//         $mail->WordWrap = 50; //Sets word wrapping on the body of the message to a given number of characters
//         $mail->IsHTML(true); //Sets message type to HTML
//         $mail->Subject = 'Email Verification'; //Sets the Subject of the message
//         $mail->Body = $mail_body; //An HTML or plain text message body
//         if ($mail->Send()) //Send an Email. Return true on success or false on error
//         {

//             $message = '<label class="text-success">Vui lòng xác thực qua email.</label>';
//         }
//     }
// }
