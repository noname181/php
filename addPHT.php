<?php
    include 'database_connection.php';

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $type = $request->type;
    
    //print_r($request);

    if(isset($postdata) && !empty($postdata))
    {
        //decode đổi chuỗi json thành object php
        if($type == 'nvqs'){
            $mssv = $request->mssv;
            $diachihokhau = $request->diachihokhau;
            $cosotiepnhan = $request->cosotiepnhan;
            $sodienthoai = $request->sodienthoai;
            $sql = "insert into phieuhotro (mssv,diachihokhau,cosotiepnhan,dienthoai,idloaihotro,ngaydangky) values ('".$mssv."','".$diachihokhau."','".$cosotiepnhan."','".$sodienthoai."',1,Now())";
            
             $result = mysqli_query($connect,$sql);
        if(mysqli_affected_rows($connect) > -1)
            print_r("Update Successfully");
        else
            print_r(-1);
        }
        if($type == 'bhyt'){
            $mssv = $request->mssv;
            $diachihokhau = $request->diachihokhau;
            $cosotiepnhan = $request->cosotiepnhan;
            $sodienthoai = $request->sodienthoai;
            $tinhthanhpho = $request->tinhthanhpho;
            $quanhuyen = $request->quanhuyen;
            $xaphuong = $request->xaphuong;
            $benhvien = $request->benhviendk;
            $masobhyt = $request->masobhyt;
            $sql = "insert into phieuhotro (mssv,diachihokhau,cosotiepnhan,dienthoai,idloaihotro,tinhthanhpho,quanhuyen,phuongxa,benhvien,masobhyt,ngaydangky) values ('".$mssv."','".$diachihokhau."','".$cosotiepnhan."','".$sodienthoai."',2,'".$tinhthanhpho."','".$quanhuyen."','".$xaphuong."','".$benhvien."','".$masobhyt."',Now())";
            
             $result = mysqli_query($connect,$sql);
            if(mysqli_affected_rows($connect) > -1)
                print_r("Update Successfully");
            else
                print_r(-1,$sql);
        }
        if($type == 'ktx'){
            $mssv = $request->mssv;
            $cosotiepnhan = $request->cosotiepnhan;
            $sodienthoai = $request->sodienthoai;

            $sql = "insert into phieuhotro (mssv,cosotiepnhan,dienthoai,idloaihotro,ngaydangky) values ('".$mssv."','".$cosotiepnhan."','".$sodienthoai."',3,Now())";

            $result = mysqli_query($connect,$sql);
            if(mysqli_affected_rows($connect) > -1)
                print_r("Update Successfully");
            else
                print_r(-1);
        }
        if($type == 'vv'){
            $mssv = $request->mssv;
            $cosotiepnhan = $request->cosotiepnhan;
            $sotienvaygannhat = $request->sotienvaygannhat;
            $solanduocvay = $request->solanduocvay;
            $solanyeucau = $request->solanyeucau;
            $thuocdiensv = $request->thuocdien;
            $loaidoituongsv = $request->thuocdoituong;
            $sql = "insert into phieuhotro (mssv,cosotiepnhan,sotienvaygannhat,solanduocvay,solanyeucau,loaidiensv,loaidoituongsv,idloaihotro,ngaydangky) values ('".$mssv."','".$cosotiepnhan."','".$sotienvaygannhat."','".$solanduocvay."','".$solanyeucau."','".$thuocdiensv."','".$loaidoituongsv."',4,Now())";
            echo $sql;
            $result = mysqli_query($connect,$sql);
            if(mysqli_affected_rows($connect) > -1)
                print_r("Update Successfully");
            else
                print_r(-1);
        }
        $sql = 'SELECT idphieuhotro FROM phieuhotro ORDER BY idphieuhotro DESC LIMIT 0,1';
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_array($result);
        $id = $row[0];
        $sql = 'INSERT INTO chitietphieuhotro (idphieuhotro,idnhanvien,ngaythuchien,idloaitrangthai) values ('.$id.',1,Now(),1)';
        $result = mysqli_query($connect,$sql);
        if(mysqli_affected_rows($connect) > -1)
            print_r("Update Successfully");
        else
            print_r(-1);
    }
?>