<?php
    include 'database_connection.php';
    
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $id = $request->id;

    $listComfirm = [];

    $sql = "SELECT * 
    FROM phieuhotro p 
    JOIN loaihotro l 
        ON p.idloaihotro = l.idloaihotro
    JOIN 
        (SELECT t3.hoten,t1.idphieuhotro,t2.tenloaitrangthai,t2.idloaitrangthai,t1.ngaythuchien FROM (SELECT * FROM chitietphieuhotro WHERE (idphieuhotro, idloaitrangthai) IN ( SELECT idphieuhotro, MAX(idloaitrangthai) FROM chitietphieuhotro GROUP BY idphieuhotro)) as t1 JOIN loaitrangthai t2 on t1.idloaitrangthai = t2.idloaitrangthai JOIN nhanvien t3 on t1.idnhanvien = t3.idnhanvien
        ) t1 
        ON p.idphieuhotro = t1.idphieuhotro 
    where mssv='".$id."' 
    order by ngaydangky asc";
    if($id == ''){
        $sql = "SELECT * 
        FROM phieuhotro p 
        JOIN loaihotro l 
            ON p.idloaihotro = l.idloaihotro
        JOIN 
            (SELECT t3.hoten,t1.idphieuhotro,t2.tenloaitrangthai,t2.idloaitrangthai,t1.ngaythuchien,t1.idnhanvien FROM (SELECT * FROM chitietphieuhotro WHERE (idphieuhotro, idloaitrangthai) IN ( SELECT idphieuhotro, MAX(idloaitrangthai) FROM chitietphieuhotro GROUP BY idphieuhotro)) as t1 JOIN loaitrangthai t2 on t1.idloaitrangthai = t2.idloaitrangthai JOIN nhanvien t3 on t1.idnhanvien = t3.idnhanvien
            ) t1 
            ON p.idphieuhotro = t1.idphieuhotro
        JOIN (SELECT * FROM sinhvien v) as v
            ON v.mssv = p.mssv
        order by ngaydangky asc";
    }
    
    $result = mysqli_query($connect,$sql);
    $json_array = array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    } else {
        echo -1;
    }
   
?>