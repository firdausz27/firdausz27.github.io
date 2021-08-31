<?php
include_once '../../../db/DBConnection.php';
include_once '../../../model/Personal.php';
// $listPerson='';
 $listJadual=isset($_POST['searchable']) ? $_POST['searchable'] : '';
 //$listPerson=$listPerson."'";
function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$tgl-$bln-$thn";
	return $tanggal;
}

function query($id,$kelamin){
    $personals=array();
    $sql="select * from personal where id_siswa='".$id."' and kelamin=".$kelamin." order by kelamin,id_siswa";
    $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
    while ($dataRow=  mysql_fetch_array($dataQry)){ 
        $personal=new Personal();
          $personal->setIdPersonal($dataRow['id_siswa']);
          $personal->setNamaAwal($dataRow['nama_awal']);
          $personal->setNamaTengah($dataRow['nama_tengah']);
          $personal->setNamaAkhir($dataRow['nama_akhir']);
          $personal->setTempatLahir($dataRow['tempat_lahir']);
          $personal->setTglLahir($dataRow['tgl_lahir']);
          $personal->setTelepon($dataRow['telepon']);
          $personal->setAlamat($dataRow['alamat']);
          $personal->setKota($dataRow['kota']);
          $personal->setPropinsi($dataRow['propinsi']);
          $personal->setNegara($dataRow['negara']);
          $personal->setEmail($dataRow['email']);
          $personal->setTglGabung($dataRow['tgl_gabung']);
          $personal->setKelamin($dataRow['kelamin']);
          $personal->setKategoriSantri($dataRow['kategori_santri']);
          $personal->setFoto($dataRow['foto']);
          $personals[]=$personal;
    }
    return $personals;
}
  
function cekData($kelamin){
    $data=false;
    $listJadual=isset($_POST['searchable']) ? $_POST['searchable'] : '';
    if($listJadual!=''){
        foreach ($listJadual as $value){
            $query = query($value, $kelamin);
            if($query!=NULL){
                $data=true;
            }
        }
    }
    return $data;
}
           
?>

<!DOCTYPE html>
<html>
    <head>
        <script>
            function hideButton(){
                document.getElementById("bPrint").style.visibility = 'hidden';
                document.getElementById("bClose").style.visibility = 'hidden';
            }
        </script>
    </head>
<body style="overflow: scroll; font-size: small;">
<center>
    <div>
        <table width="650" border="0" cellspacing="1" cellpadding="2">
        
          <tr>
              <td align="center">
            <table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#006633">
             
              <tr>
                <td width="11%" rowspan="3" align="center" valign="middle"><img src="../../../images/dm_logo.png" width="68" height="73" /></td>
                <td width="89%" align="left"><font color="#FFFF00" size="+2">MA'HAD DAARUL MUWAHHID</font></td>
              </tr> 
              <tr>
                <td align="left"><font color="#FFFFFF" size="+1">Jalan Flamboyan Nomor 59, Srengseng KebanganJakarta Barat 11630</font></td>
              </tr>
              <tr>
                <td align="left"><font color="#FFFFFF">Telp 021-58906112</font></td>
              </tr>
            </table></td>
          </tr>
          <tr>
              <td width="896" align="center"><font style="font-size: 18px;"><b>Data Santri</b></font></td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <?php
                //echo "Test".cekData("1");
                if(cekData("1")!=false){
                ?>
                    <tr>
                        <td colspan="8" align="left"><b>Ikhwan<b></td>
                    </tr>
                    <tr style="background: #CCC;">
                        <td style="border: 1px solid black;">NO</td>
                        <td style="border: 1px solid black; border-left: none;">Nama</td>
                        <td style="border: 1px solid black; border-left: none;">Tempat Lahir</td>
                        <td style="border: 1px solid black; border-left: none;">Tanggal Lahir</td>
                        <td style="border: 1px solid black; border-left: none;">Telepon</td>
                        <td style="border: 1px solid black; border-left: none;">Alamat</td>
                        <td style="border: 1px solid black; border-left: none;">Tgl Gabung</td>
                        <td style="border: 1px solid black; border-left: none;">Kategori Santri</td>
                    </tr>
            <?php
            }
            $angka=0;
            if($listJadual!=''){
               foreach ($listJadual as $value){
                $sql="select * from personal where id_siswa='".$value."' and kelamin=1 order by nama_awal,nama_tengah,nama_akhir";
                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                    $angka=$angka+1;
                    ?>
                    <tr>
                        <td style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_awal']." ".$dataRow['nama_tengah']." ".$dataRow['nama_akhir'];?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['tempat_lahir'];?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo IndonesiaTgl($dataRow['tgl_lahir']);?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['telepon'];?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['alamat'];?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo IndonesiaTgl($dataRow['tgl_gabung']);?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['kategori_santri'];?></td>
                    </tr> 
                <?php
                 }
                }
              }
             ?>
                </table>
            </td>
          </tr>
            <tr>
                <td>
                <?php
                if(cekData("2")!=false){
                ?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                        <tr>
                            <td colspan="8" align="left"><b>Akhwat<b></td>
                        </tr>
                        <tr style="background: #CCC;">
                            <td style="border: 1px solid black;">NO</td>
                            <td style="border: 1px solid black; border-left: none;">Nama</td>
                            <td style="border: 1px solid black; border-left: none;">Tempat Lahir</td>
                            <td style="border: 1px solid black; border-left: none;">Tanggal Lahir</td>
                            <td style="border: 1px solid black; border-left: none;">Telepon</td>
                            <td style="border: 1px solid black; border-left: none;">Alamat</td>
                            <td style="border: 1px solid black; border-left: none;">Tgl Gabung</td>
                            <td style="border: 1px solid black; border-left: none;">Kategori Santri</td>
                        </tr>
                <?php 
                    }
                $angka=0;
                if($listJadual!=''){
                   foreach ($listJadual as $value){
                    $sql="select * from personal where id_siswa='".$value."' and kelamin=2 order by nama_awal,nama_tengah,nama_akhir";
                    $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                    while ($dataRow=  mysql_fetch_array($dataQry)){ 
                        $angka=$angka+1;
                        ?>
                        <tr>
                            <td style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_awal']." ".$dataRow['nama_tengah']." ".$dataRow['nama_akhir'];?></td>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['tempat_lahir'];?></td>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo IndonesiaTgl($dataRow['tgl_lahir']);?></td>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['telepon'];?></td>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['alamat'];?></td>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo IndonesiaTgl($dataRow['tgl_gabung']);?></td>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['kategori_santri'];?></td>
                        </tr> 
                    <?php
                     }
                    }
                  }
                 ?>
                    </table>
                </td>
            </tr>
          </tr>
          <tr>
           <td align="center">
             <input type="submit" name="bPrint" id="bPrint" value="Print" onClick="hideButton();javascript:window.print();"/>
           <input type="reset" name="bClose" id="bClose" value="Close" onclick=" window.close();"/></td>
         </tr>
        </table>
    </div>
</center>
</body>
</html>