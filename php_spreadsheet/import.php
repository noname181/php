<?php

//import.php

include 'vendor/autoload.php';
include '../database_connection.php';


if($_FILES["import_excel"]["name"] != '')
{

	$allowed_extension = array('xls', 'csv', 'xlsx');
	$file_array = explode(".", $_FILES["import_excel"]["name"]);
	$file_extension = end($file_array);

	if(in_array($file_extension, $allowed_extension))
	{
       
		$file_name = time() . '.' . $file_extension;
		move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
		$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);
        
        //$reader->setInputEncoding('CP1250');

		$spreadsheet = $reader->load($file_name);

		unlink($file_name);

		$data = $spreadsheet->getActiveSheet()->toArray();
		foreach($data as $row)
		{        
            /* (mssv, hotensv, gioitinhsv, ngaysinhsv,noisinh,sodienthoaisv,dienthoaibaotin,cmndsv,quoctich,dantoc,tongiao,diachi1,tinhthanhpho1,quanhuyen1,diachi2,tinhthanhpho2,quanhuyen2,hedaotao,chuyennganh,khoa,lop,khoahoc,emailsv,matkhau,resetpasswordcode,noicapcmnd,ngaycapcmnd,avatar,idphuhuynh) */
            $date = str_replace('/', '-', $row[3]);
            $ngaysinh = date("Y-m-d", strtotime($date));
            $date = str_replace('/', '-', $row[26]);
            $ngaycapcmnd = date("Y-m-d", strtotime($date));
			$query = "INSERT INTO sinhvien (mssv, hotensv, ngaysinhsv,chuyennganh,khoa,lop,khoahoc,emailsv,matkhau) VALUES ('".$row[0]."','".$row[1]."','".$ngaysinh."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[0]."')"; 
            mysqli_query($connect,$query);
          
        }
        if(mysqli_affected_rows($connect) > -1)
            $message = 'Thêm dữ liệu thành công';
        else {
            $message = 'Có lỗi xảy ra!';
        }

	}
	else
	{
		$message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
	}
}
else
{
	$message = '<div class="alert alert-danger">Please Select File</div>';
}

echo $message;

?>