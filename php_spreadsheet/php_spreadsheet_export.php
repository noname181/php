<?php

//php_spreadsheet_export.php

include 'vendor/autoload.php';
include '../database_connection.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$query = "SELECT * FROM sinhvien ORDER BY mssv DESC";

$result = mysqli_query($connect, $query);

if (isset($_GET['type'])) {
    $file = new Spreadsheet();

    $active_sheet = $file->getActiveSheet();

    $active_sheet->setCellValue('A1', 'mssv');
    $active_sheet->setCellValue('B1', 'hotensv');
    //$active_sheet->setCellValue('C1', 'gioitinhsv');
    $active_sheet->setCellValue('C1', 'ngaysinh');
    //$active_sheet->setCellValue('E1', 'noisinh');
    //$active_sheet->setCellValue('F1', 'sodienthoaisv');
    //$active_sheet->setCellValue('G1', 'dienthoaibaotin');
    // $active_sheet->setCellValue('H1', 'cmndsv');
    // $active_sheet->setCellValue('I1', 'quoctich');
    // $active_sheet->setCellValue('J1', 'dantoc');
    // $active_sheet->setCellValue('K1', 'tongiao');
    // $active_sheet->setCellValue('L1', 'diachi1');
    // $active_sheet->setCellValue('M1', 'tinhthanhpho1');
    // $active_sheet->setCellValue('N1', 'quanhuyen1');
    // $active_sheet->setCellValue('O1', 'diachi2');
    // $active_sheet->setCellValue('P1', 'tinhthanhpho2');
    // $active_sheet->setCellValue('Q1', 'quanhuyen2');
    // $active_sheet->setCellValue('R1', 'hedaotao');
    $active_sheet->setCellValue('D1', 'chuyennganh');
    $active_sheet->setCellValue('E1', 'khoa');
    $active_sheet->setCellValue('F1', 'lop');
    $active_sheet->setCellValue('G1', 'khoahoc');
    $active_sheet->setCellValue('H1', 'emailsv');
    // $active_sheet->setCellValue('X1', 'matkhau');
    // $active_sheet->setCellValue('Y1', 'resetpasswordcode');
    // $active_sheet->setCellValue('Z1', 'noicapcmnd');
    // $active_sheet->setCellValue('AA1', 'ngaycapcmnd');
    // $active_sheet->setCellValue('AB1', 'avatar');
    // $active_sheet->setCellValue('AC1', 'idphuhuynh');

    $count = 2;
   
    foreach ($result as $row) {
        
        $active_sheet->setCellValue('A' . $count, $row["mssv"]);
        $active_sheet->setCellValue('B' . $count, $row["hotensv"]);
        //$active_sheet->setCellValue('C' . $count, $row["gioitinhsv"]);
        $active_sheet->setCellValue('C' . $count, $row["ngaysinhsv"]);
        // $active_sheet->setCellValue('E' . $count, $row["noisinh"]);
        // $active_sheet->setCellValue('F' . $count, $row["sodienthoaisv"]);
        // $active_sheet->setCellValue('G' . $count, $row["dienthoaibaotin"]);
        // $active_sheet->setCellValue('H' . $count, $row["cmndsv"]);
        // $active_sheet->setCellValue('I' . $count, $row["quoctich"]);
        // $active_sheet->setCellValue('J' . $count, $row["dantoc"]);
        // $active_sheet->setCellValue('K' . $count, $row["tongiao"]);
        // $active_sheet->setCellValue('L' . $count, $row["diachi1"]);
        // $active_sheet->setCellValue('M' . $count, $row["tinhthanhpho1"]);
        // $active_sheet->setCellValue('N' . $count, $row["quanhuyen1"]);
        // $active_sheet->setCellValue('O' . $count, $row["diachi2"]);
        // $active_sheet->setCellValue('P' . $count, $row["tinhthanhpho2"]);
        // $active_sheet->setCellValue('Q' . $count, $row["quanhuyen2"]);
        // $active_sheet->setCellValue('R' . $count, $row["hedaotao"]);
        $active_sheet->setCellValue('D' . $count, $row["chuyennganh"]);
        $active_sheet->setCellValue('E' . $count, $row["khoa"]);
        $active_sheet->setCellValue('F' . $count, $row["lop"]);
        $active_sheet->setCellValue('G' . $count, $row["khoahoc"]);
        $active_sheet->setCellValue('H' . $count, $row["emailsv"]);
        // $active_sheet->setCellValue('X' . $count, password_hash($row["mssv"], PASSWORD_DEFAULT));
        // $active_sheet->setCellValue('Y' . $count, $row["resetpasswordcode"]);
        // $active_sheet->setCellValue('Z' . $count, $row["noicapcmnd"]);
        // $active_sheet->setCellValue('AA' . $count, $row["ngaycapcmnd"]);
        // $active_sheet->setCellValue('AB' . $count, $row["avatar"]);
        // $active_sheet->setCellValue('AC' . $count, $row["idphuhuynh"]);



        $count = $count + 1;
    }

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file,$_GET['type']);

    $file_name = 'Sinh-viên-'.time() . '.' . strtolower($_GET['type']);

    $writer->save($file_name);

    header('Content-Type: application/x-www-form-urlencoded');

    header('Content-Transfer-Encoding: Binary');

    header("Content-disposition: attachment; filename=\"" . $file_name . "\"");

    readfile($file_name);

    unlink($file_name);


    exit;

}
