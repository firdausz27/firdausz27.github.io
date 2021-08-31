<?php
include_once './db/DBConnection.php';
include_once './model/DasborAbs.php';
include_once './dao/PersonalOtorisasiDao.php';
include_once './dao/PersonalDao.php';
include_once './dao/PropinsiDao.php';
$month=  date("F");
$otorisasidao=new PersonalOtorisasiDao();
$otorisasi = $otorisasidao->getOtorisasi($_SESSION['SES_LOGIN']);
if($otorisasi==NULL){
    $otorisasi[]=$_SESSION['SES_LOGIN'];
}
$listSiswa=implode("','",$otorisasi);
function getAbsesnsi($kelamin,$month,$listSi){
    $listAbs=array();
    $sql="select 
        count(status) as jumlah,
        personal.id_siswa,
        personal.nama_awal,
        personal.nama_tengah,
        personal.nama_akhir
        from        absensi_personal inner join personal 
        on          (absensi_personal.id_siswa=personal.id_siswa)
        inner       join absensi on(absensi_personal.id_absensi=absensi.id_absensi)
        where       status ='ABS'
        and         personal.kategori_santri='mukim'
        and         month(absensi.tanggal)=$month
        and         personal.kelamin= $kelamin
        and         personal.id_siswa in('".$listSi."')
        group by    absensi_personal.id_siswa 
        order by    jumlah desc
        limit 10;";
    $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
    while ($dataRow=  mysql_fetch_array($dataQry)){
        $abs=new DasborAbs();
        $abs->setPersonalId($dataRow['id_siswa']);
        $abs->setNama($dataRow['nama_awal'].' '.$dataRow['nama_tengah'].' '.$dataRow['nama_akhir']);
        $abs->setJumlah($dataRow['jumlah']);
        $listAbs[]=$abs;
    }
    return $listAbs;
}
//untuk mendapatkan data pribadi
$personalDao=new PersonalDao();
$personal=new Personal();
$personal = $personalDao->getPersonal($_SESSION['SES_LOGIN']);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script>
        function popup(url){
            var w=950;
            var h=600;
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            var myWindow = window.open(url, "Laporan Kas", "width=950, height=600, width="+w+", height="+h+", top="+top+", left="+left);
        }
    </script>
    <style>
        #Ikhwan-abs,#Akhwat-abs{
            width: 98%;
            float: left;
            height: auto;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 10px;
            background: url(./images/7AF2Qzt.png);
            border: 1px solid #999;
            border-radius: 0px;
            box-shadow: 0 1px 0 #999;
        }
        #Akhwat-abs{
            width: 98%;
            height: auto;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 10px;
            background: url(./images/7AF2Qzt.png);
            border: 1px solid #999;
            border-radius: 0px;
            box-shadow: 0 1px 0 #999;
        }
        
        
        #Ikhwan-abs h4,#Akhwat-abs h4{
            text-align: center;
            color: #ccc;
            padding: 5px 0px 5px 0px;
            background: url(./images/headercontent.jpg);
            height: 15px;
            width: 100%;
        }
        
        #personal h4{
            text-align: left;
            color: #ccc;
            padding: 5px 0px 5px 0px;
            background: url(./images/headercontent2.jpg);
            height: 15px;
            width: 100%;
        }
        #personal{
            width: 100%;
            float: left;
            background: url(./images/7AF2Qzt.png);
            height: auto;
            border: 1px solid #999;
            box-shadow: 0 1px 0 #999;
            border-radius: 0px;
            margin-top: 0px;
            margin-left: 0px;
            margin-right: 0px;
            margin-left: 0px;
        }
        #calender{
            width:auto;
            float: left;
            background: url(./images/7AF2Qzt.png);
            height: auto;
            border: 1px solid #999;
            box-shadow: 0 1px 0 #999;
            border-radius: 0px;
            margin-top: 10px;
            margin-left: 1%;
        }
        
        #grafik{
            width:auto;
            float: left;
            height: auto;
            margin-top: 10px;
            margin-left: 0px;
        }
        
        #visi #content, #misi #content, #personal #content{
            padding-left: 5px;
            padding-right: 5px;
            text-align: justify;
            text-spacing:space-adjacent;
            font: 12px Arial,Helvetica, sans-serif;
            font-size: 14px;
            margin-bottom: 5px;
        }
        
    </style>
</head>
<body>
    <!--<div id="slider"style="margin-top: 5px;margin-bottom: 5px;"><img src="images/DM.jpg" width="100%" height="100%"></div>-->
    <table style="width: 100% " cellpadding="0" cellspacing="2">
        <tr valign="top">
            <td colspan="2">
                <div id="personal">
                    <h4>&nbsp;&nbsp;Personal Data</h4>
                    <div id="content">
                            <table width="90%" height="100%">
                                <tr>
                                    <td align="center" valign="top" width="30%">
                                        <img src="./foto/<?php echo $personal->getFoto();?>" style="background-color: #eee;
                                            border: 0.3 px solid #ccc;
                                            width: 150px;
                                            height: 200px;
                                            margin-top: 10px;
                                            border-radius: 4px;
                                            box-shadow: 0 1px 0 #999;"/>
                                    </td>
                                    <td width="592"  valign="top" >
                                        <table width="100%" border="0" cellspacing="1" cellpadding="3" style="margin-top: 15px;">
                                            
                                            <tr>
                                              <td width="25%">Nama </td>
                                              <td>:</td>
                                              <td width="75%"><?php echo ucwords($personal->getNamaAwal()." ".$personal->getNamaTengah()." ".$personal->getNamaAkhir());?>								</td>
                                            </tr>
                                            <tr>
                                              <td>Telepon</td>
                                              <td>:</td>
                                              <td><?php if($personal->getTelepon()==''){echo 'N/A';}else{echo $personal->getTelepon();}?></td>
                                            </tr>
                                            <tr>
                                              <td>Tempat/Tgl.Lahir</td>
                                              <td>:</td>
                                              <td><?php echo ucwords($personal->getTempatLahir()." / ". date_format(date_create($personal->getTglLahir()),"d F Y"));?></td>
                                            </tr>
                                            <tr>
                                              <td>Jns Kelamin</td>
                                              <td>:</td>
                                              <td><?php if($personal->getKelamin()==1){echo 'Ikhwan';}else{echo 'Akhwat';}?></td>
                                            </tr>
                                            <tr>
                                              <td>Alamat</td>
                                              <td>:</td>
                                              <td><?php echo ucwords($personal->getAlamat());?></td>
                                            </tr>
                                            <!--<tr>
                                              <td>Kota</td>
                                              <td>: <?php //echo $personal->getKota();?></td>
                                            </tr>-->
                                            <tr>
                                              <td>Propinsi</td>
                                              <td>:</td>
                                              <td><?php 
                                              $propinsiDao=new PropinsiDao();
                                              $propinsi = $propinsiDao->getPropinsi($personal->getPropinsi());
                                              echo $propinsi->getNama();
                                              ?></td>
                                            </tr>
                                            <!--<tr>
                                              <td>Negara</td>
                                              <td>: <?php //echo $personal->getNegara();?></td>
                                            </tr>-->
                                            <tr>
                                              <td>Kategori</td>
                                              <td>:</td>
                                              <td><?php echo ucwords($personal->getKategoriSantri());?></td>
                                            </tr>
                                            <tr>
                                              <td>Tgl Gabung</td>
                                              <td>:</td>
                                              <td><?php echo date_format(date_create($personal->getTglGabung()),"d F Y");?></td>
                                            </tr>
                                       </table>
                                    </td>
                                  </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td >
                <div id="grafik"><?php include_once './GrafikSantri.php';?></div>
                 <div id="calender"><?php include_once './kalender.php';?></div>
                <?php include_once './Jam.php';?>
            </td>
            
        </tr>
        
    </table>
</body>
</html>