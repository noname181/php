<?php
include 'database_connection.php';
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "./Jwt/vendor/autoload.php";
use \Firebase\JWT\JWT;

$check = checkToken();

$user = [];

$postdata = file_get_contents('php://input');

$request = json_decode($postdata);

if ($postdata && $check != -1) {

    $tinhthanhpho1 = $request->provine1;
    $tinhthanhpho2 = $request->provine2;
    $gioitinhsv = $request->gioitinhsv;
    $emailsv = $request->emailsv;
    $sodienthoaisv = $request->sodienthoaisv;
    $cmndsv = $request->cmndsv;
    $ngaycapcmnd = $request->ngaycapcmnd;
    $noicapcmnd = $request->noicapcmnd;
    $quoctich = $request->quoctich;
    $dantoc = $request->dantoc;
    $noisinh = $request->noisinh;
    $dienthoaibaotin = $request->dienthoaibaotin;
    $tongiao = $request->tongiao;
    $quanhuyen1 = $request->quanhuyen1;
    $quanhuyen2 = $request->quanhuyen2;
    $diachi1 = $request->diachi1;
    $diachi2 = $request->diachi2;
    $hotencha = $request->hotencha;
    $nghenghiepcha = $request->nghenghiepcha;
    $sodienthoaicha = $request->sodienthoaicha;
    $hotenme = $request->hotenme;
    $nghenghiepme = $request->nghenghiepme;
    $sodienthoaime = $request->sodienthoaime;
    $email = $request->email;
    $mssv = $request->mssv;
    $idphuhuynh = $request->idphuhuynh;
    $sql = "UPDATE sinhvien set tinhthanhpho1 =" . $tinhthanhpho1 . ",tinhthanhpho2=" . $tinhthanhpho2 . ",gioitinhsv=" . $gioitinhsv . ",emailsv='" . $emailsv . "',sodienthoaisv='" . $sodienthoaisv . "',cmndsv='" . $cmndsv . "',ngaycapcmnd='" . $ngaycapcmnd . "',noicapcmnd='" . $noicapcmnd . "',quoctich='" . $quoctich . "',dantoc='" . $dantoc . "',noisinh='" . $noisinh . "',dienthoaibaotin='" . $dienthoaibaotin . "',tongiao='" . $tongiao . "',quanhuyen1='" . $quanhuyen1 . "',quanhuyen2='" . $quanhuyen2 . "',diachi1='" . $diachi1 . "',diachi2='" . $diachi2 . "' where mssv=" . $mssv;

    $result = mysqli_query($connect, $sql);
    $sql2 = "update phuhuynh set hotencha='" . $hotencha . "',hotenme='" . $hotenme . "',sodienthoaicha='" . $sodienthoaicha . "',sodienthoaime='" . $sodienthoaime . "',nghenghiepcha='" . $nghenghiepcha . "',nghenghiepme='" . $nghenghiepme . "',email='" . $email . "' where idphuhuynh=" . $idphuhuynh;
    $result = mysqli_query($connect, $sql2);
    if (mysqli_affected_rows($connect) != -1) {
        echo 1;
    } 

}else {
    echo -1;
}
