<?php
//register.php

include 'database_connection.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$email = $request->email;
$password = $request->password;

$message = '';

if ($postdata) {
    $sql = "
 SELECT * FROM sinhvien
  WHERE emailsv ='" . $email . "'
  ";
 
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    if (!$row) {
        $message = 'Email chưa đăng ký hoặc không chính xác';
    } else {
        //$user_password = rand(100000,999999);
        //$user_encrypted_password = $password;
        $user_encrypted_password = password_hash($password, PASSWORD_DEFAULT);
        
        $user_activation_code = md5(rand());
        $insert_query = "
        UPDATE sinhvien set resetpasswordcode ='" . $user_encrypted_password . "' where emailsv='" . $email . "'";
     
        $result = mysqli_query($connect, $insert_query);
    
        if ($result) {

            $base_url = "http://localhost:8001/";
            //$base_url = "http://study.nonamee.com/";
            $mail_body = "
            <p>Chào bạn " . $email . ",</p>
            <p>Chúng tôi nhận được yêu cầu lấy lại mật khẩu của bạn.</p>
            <p>Vui lòng bấm vào link dưới đây nếu đúng là bạn vừa thực hiện yêu cầu đó - " . $base_url . "email_verification.php/" . $user_encrypted_password . "
            <p>HUTECH Support,<br />Admin</p>
            ";
            require 'class/class.phpmailer.php';
            require 'class/class.smtp.php';
            $mail = new PHPMailer;
            $mail->IsSMTP(); //Sets Mailer to send message using SMTP
            $mail->Host = 'smtp.gmail.com'; //Sets the SMTP hosts of your Email hosting, this for Godaddy
            $mail->Port = '465'; //Sets the default SMTP server port
            $mail->SMTPAuth = true; //Sets SMTP authentication. Utilizes the Username and Password variables
            $mail->Username = 'l.h.thuong181@gmail.com'; //Sets SMTP username
            $mail->Password = 'myfdqxvyoakztoav'; //Sets SMTP password
            $mail->SMTPSecure = 'ssl'; //Sets connection prefix. Options are "", "ssl" or "tls"
            $mail->From = 'l.h.thuong181@gmail.com'; //Sets the From email address for the message
            $mail->FromName = 'HUTECH'; //Sets the From name of the message
            $mail->AddAddress($email, 'HUTECH'); //Adds a "To" address
            $mail->WordWrap = 50; //Sets word wrapping on the body of the message to a given number of characters
            $mail->IsHTML(true); //Sets message type to HTML
            $mail->Subject = 'Email Verification'; //Sets the Subject of the message
            $mail->Body = $mail_body; //An HTML or plain text message body
            if ($mail->Send()) //Send an Email. Return true on success or false on error
            {

                $message = 'Mật khẩu mới sẽ được cập nhật sau khi xác nhận Email thành công';
            }
        }
    }
}
echo $message;
