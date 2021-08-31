<?php
include_once '../../../db/DBConnection.php';
include_once '../../../model/Personal.php';
date_default_timezone_set('Asia/Jakarta');
function InggrisTgl($tanggal){
	$tgl=substr($tanggal,0,2);
	$bln=substr($tanggal,3,2);
	$thn=substr($tanggal,6,4);
	$tanggal="$thn-$tgl-$bln";
	return $tanggal;
}

$tglAwal=isset($_POST['txtTanggalAwal']) ? $_POST['txtTanggalAwal'] : '';
$tglAkhir= isset($_POST['txtTanggalAkhir']) ? $_POST['txtTanggalAkhir'] : '';
$jumlahHari= strtotime($tglAkhir) -  strtotime($tglAwal);
$hari = ($jumlahHari/(60*60*24))+1;
$empid=isset($_POST['cboEmp']) ? $_POST['cboEmp'] : '';

function getPersonal($id){
    $personal=NULL;
    $sql="select * from personal where id_siswa='$id'";
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
      $personal->setKelamin($dataRow['kelamin']);
      $personal->setKategoriSantri($dataRow['kategori_santri']);
      $personal->setTglGabung($dataRow['tgl_gabung']);
      $personal->setFoto($dataRow['foto']);
    }
    return $personal;
}

$personal = getPersonal($empid);

$angka=0;
$listStatus=Array();
$listStatus[]="PRS";
$listStatus[]="ABS";
$listStatus[]="IJN";
$listStatus[]="SCK";
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
        <table width="799" border="0" cellspacing="1" cellpadding="2">
        
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
              <td width="100%" align="center"><font style="font-size: 18px;"><b>Absensi </b></font></td>
          </tr>
		  <tr>
             <td>
				 <table width="347" border="0" cellpadding="2" cellspacing="0">
				  <tr>
					<td width="28">&nbsp;</td>
                                        <td width="75"><b>Dari Tgl </b></td>
                                        <td width="232"><b>: <?php echo $tglAwal; ?></b></td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
                                    <td><b>Sampai Tgl </b></td>
                                    <td><b>: <?php echo $tglAkhir; ?></b></td>
			       </tr>
				  <tr>
				    <td>&nbsp;</td>
                                    <td><b>Nama</b></td>
                                    <td><b>: <?php echo ucwords($personal->getNamaAwal().' '.$personal->getNamaTengah().' '.$personal->getNamaAkhir());?></b></td>
			       </tr>
				  <!--<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>-->
			   </table>
			</td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="3"> 
                   
                        <tr style="background: #CCC;">
                            <td align="center" width="4%" rowspan="2" style="border: 1px solid black;">NO</td>
                            <td width="29%" rowspan="2" style="border: 1px solid black; border-left: none;">Nama Kajian</td>
                            <td align="center" colspan="4" style="border: 1px solid black; border-left: none; "><b>Status Kehadiran</b></td>
                            <td align="center" width="13%" rowspan="2" style="border: 1px solid black; border-left: none;"><b>Total<br>Kehadiran</b></td>
                        </tr>
                        <tr style="background: #CCC;">
                            <td align="center"  width="13%" style="border: 1px solid black; border-left: none; border-top:none;">PRS</td>
                            <td align="center"  width="14%" style="border: 1px solid black; border-left: none; border-top:none;">ABS</td>
                            <td align="center"  width="13%" style="border: 1px solid black; border-left: none; border-top:none;">IJN</td>
                            <td align="center"  width="14%" style="border: 1px solid black; border-left: none; border-top:none;">SCK</td>
                        </tr>
                    <?php
                        $sql="select distinct pelajaran.id_pelajaran,pelajaran.nama_pelajaran 
                            from jadual inner join jadual_personal 
                            on(jadual_personal.id_jadual=jadual.id_jadual)
                            inner join pelajaran on(pelajaran.id_pelajaran=jadual.id_pelajaran)
                            where personal_id='".$empid."' order by pelajaran.nama_pelajaran";
                         $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                         while ($dataRow=  mysql_fetch_array($dataQry)){ 
                            $angka=$angka+1;
                            $total=0
                        ?>
                        <tr>
                            <td align="center" valign="top" style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                            <td valign="top" style="border: 1px solid black; border-top: none; border-left: none;"><b><?php echo ucwords($dataRow['nama_pelajaran']);?></b></td>
                           <?php
                           foreach ($listStatus as $value){
                               echo '<td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;">';
                               $sqlDT="select distinct count(absensi_personal.status) as jumlah from absensi inner join absensi_personal 
                                    on(absensi_personal.id_absensi=absensi.id_absensi)
                                    inner join jadual on(absensi.id_jadual=jadual.id_jadual)
                                    where jadual.id_pelajaran='".$dataRow['id_pelajaran']."'
                                    and absensi_personal.status='".$value."'
                                    and absensi_personal.id_siswa='".$empid."'
                                    and absensi.tanggal >='".  InggrisTgl($tglAwal)."'
                                    and absensi.tanggal<= '".  InggrisTgl($tglAkhir)."';";
                               $dataQryDT  =  mysql_query($sqlDT, DBConnection::getConnection())or die("Query error :".  mysql_error());
                               while ($dataRowDT=  mysql_fetch_array($dataQryDT)){
                                   echo $dataRowDT['jumlah'];
                                   $total=$total+ $dataRowDT['jumlah'];
                               }
                               echo '</td>';
                           }
                           ?>
                            
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $total;?></td>
                        </tr>
                        
                        <?php 
                           }
                        ?>
                </table>
            </td>
          </tr>
           
           <tr>
            <td colspan="3"><table width="750" border="0" cellspacing="1" cellpadding="2">
              <tr>
                <td width="49">PRS</td>
                <td width="8">:</td>
                <td width="677">Hadir</td>
              </tr>
              <tr>
                <td>ABS</td>
                <td>:</td>
                <td>Tidak ada kabar</td>
              </tr>
              <tr>
                <td>IJN</td>
                <td>:</td>
                <td>Ijin</td>
              </tr>
              <tr>
                <td>SCK</td>
                <td>:</td>
                <td>Sakit</td>
              </tr>
            </table></td>
          </tr>
           <tr height="">
                  <td height="20">&nbsp;</td>
          </tr>
          <tr>
           <td align="center">
             <table width="100%" border="0">
               <tr>
                 <td width="28%"><div align="center"><strong>Lurah Ma'had </strong></div></td>
                 <td width="42%">&nbsp;</td>
                 <td width="30%"><div align="center"><strong>Walimatul Ma'had</strong></div></td>
               </tr>
               <tr>
                 <td height="45">&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td><div align="center">(...................................................)</div></td>
                 <td>&nbsp;</td>
                 <td><div align="center">(......................................................)</div></td>
               </tr>
             </table>
             <p>&nbsp;</p>
             <p>
               <input type="submit" name="bPrint" id="bPrint" value="Print" onClick="hideButton();javascript:window.print();"/>
               <input type="reset" name="bClose" id="bClose" value="Close" onClick=" window.close();"/>
             </p></td>
         </tr>
      </table>
    </div>
</center>
</body>
</html>



