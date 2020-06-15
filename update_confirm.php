<?php
include 'database_connection.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if (isset($postdata) && !empty($postdata)) {
    //decode đổi chuỗi json thành object php
    $request = json_decode($postdata);
    $mssv = $request->mssv;
    $id = $request->id;
    $idloaitrangthai = $request->idloaitrangthai;
    $idnhanvien = $request->idnhanvien;
    $hotensv = $request->hotensv;
    $idloaihotro = $request->idloaihotro;
    $reason = $request->reason;
    $tenloaihotro = function ($idloaihotro) {
        if ($idloaihotro == '1') {
            return 'Đăng ký hoãn nghĩa vụ quân sự';
        } else if ($idloaihotro == '2') {
            return 'Đăng ký mua bảo hiểm y tế';
        } else if ($idloaihotro == '3') {
            return 'Đăng ký ở ký túc xá';
        } else {
            return 'Đăng ký vay vốn ngân hàng';
        }

    };
    $sql = "INSERT INTO chitietphieuhotro (idphieuhotro,idnhanvien,ngaythuchien,idloaitrangthai) values (" . $id . "," . $idnhanvien . ",NOW()," . $idloaitrangthai . ")";
    $result = mysqli_query($connect, $sql);
    if (mysqli_affected_rows($connect) > -1) {
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $date_recive = date('m/d/Y', $timestamp + 330000);
        $sql = "SELECT emailsv FROM sinhvien where mssv=" . $mssv;
        $result = mysqli_query($connect, $sql);
        $email = mysqli_fetch_row($result);
        if ($idloaitrangthai == 2) {
            $base_url = "http://localhost:8001/";
            //$base_url = "http://study.nonamee.com/";
            $mail_body = "
            <p>Chào bạn <strong>" . $hotensv . "</strong>,</p>
            <p>Chúng tôi nhận được yêu cầu của đơn <strong>" . $tenloaihotro($idloaihotro) . "</strong> có ID là " . $id . ".</p>
            <p>Đơn đăng ký của bạn đã được kiểm tra và thông tin hợp lệ, bạn có thể đến văn phòng hỗ trợ sinh viên nhận đơn xác nhận từ lúc nhận được thông báo này đến trước <strong>16h ngày " . $date_recive . "</strong>.</p>
            <p>Khi đi vui lòng mang theo thẻ sinh viên để hoàn thành thủ tục nhành nhất !</p>
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
            $mail->AddAddress($email[0], 'HUTECH'); //Adds a "To" address
            $mail->WordWrap = 50; //Sets word wrapping on the body of the message to a given number of characters
            $mail->IsHTML(true); //Sets message type to HTML
            $mail->Subject = 'Confirm'; //Sets the Subject of the message
            $mail->Body = $mail_body; //An HTML or plain text message body
            if ($mail->Send()) //Send an Email. Return true on success or false on error
            {

                $message = 1;
            }
        }
        if ($idloaitrangthai == 4) {
            $base_url = "http://localhost:8001/";
            //$base_url = "http://study.nonamee.com/";
            $mail_body = "
            <p>Chào bạn <strong>" . $hotensv . "</strong>,</p>
            <p>Chúng tôi nhận được yêu cầu của đơn <strong>" . $tenloaihotro($idloaihotro) . "</strong> có ID là " . $id . ".</p>
            <p>Đơn đăng ký của bạn đã được kiểm tra nhưng một số thông tin không hợp lệ hoặc chưa chính xác với lý do:</p>
            <p><strong>" . $reason . "</strong></p>
            <p>Vui lòng liên hệ phòng hỗ trợ sinh viên hoặc chat trực tiếp trên website để nhân viên hỗ trợ bạn tốt nhất!</p>
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
            $mail->AddAddress($email[0], 'HUTECH'); //Adds a "To" address
            $mail->WordWrap = 50; //Sets word wrapping on the body of the message to a given number of characters
            $mail->IsHTML(true); //Sets message type to HTML
            $mail->Subject = 'Confirm'; //Sets the Subject of the message
            $mail->Body = $mail_body; //An HTML or plain text message body
            if ($mail->Send()) //Send an Email. Return true on success or false on error
            {

                $message = 1;
            }
        }

        print_r($message);
    } else {
        print_r(-1);
    }

}
