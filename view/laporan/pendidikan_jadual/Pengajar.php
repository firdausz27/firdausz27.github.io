<?php
include_once '../../../db/DBConnection.php';
include_once '../../../model/Personal.php';
include_once '../../../model/Listjadual.php';

function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$tgl-$bln-$thn";
	return $tanggal;
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
        <table width="1200" border="0" cellspacing="1" cellpadding="2">
        
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
              <td width="100%" align="center"><font style="font-size: 18px;"><b>Jadual Pengajar </b></font></td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">              
                    <tr style="background: #CCC;">
                        <td width="2%" style="border: 1px solid black;">NO</td>
                        <td width="13%" style="border: 1px solid black; border-left: none;">Kelas</td>
                        <td width="13%" style="border: 1px solid black; border-left: none;">Senin</td>
                        <td width="14%" style="border: 1px solid black; border-left: none;">Selasa</td>
                        <td width="11%" style="border: 1px solid black; border-left: none;">Rabu</td>
                        <td width="12%" style="border: 1px solid black; border-left: none;">Kamis</td>
                        <td width="12%" style="border: 1px solid black; border-left: none;">Jumat</td>
                        <td width="11%" style="border: 1px solid black; border-left: none;">Sabtu</td>
                        <td width="12%" style="border: 1px solid black; border-left: none;">Minggu</td>
                    </tr>
            <?php
            $angka=0;
                    //untuk mendapatkan data dari jadual
                    $sqlJadual="select distinct "
                            . "kelas.nama_kelas, "
                            . "jadual.kelas_id as id_kelas "
                            . "from jadual inner join ruangan on(jadual.id_ruangan=ruangan.id_ruangan) "
                            . "inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran) "
                            . "inner join kelas on(jadual.kelas_id=kelas.id_kelas) "
                            . "order by id_kelas";
                    $dataMax  =  mysql_query($sqlJadual, DBConnection::getConnection())or die("Query error :".  mysql_error());
                    while ($dataRow=  mysql_fetch_array($dataMax)){ 
                    $angka=$angka+1;
                    //ini unutk menentukan jumlah rowspan
                    $dataRows=0;
                    $sqlMax="select count(hari) as hi, hari from jadual  "
                            . "where jadual.kelas_id='".$dataRow['id_kelas']."' "
                            . "group by hari order by hi desc limit 1 ";
                    $dat  =  mysql_query($sqlMax, DBConnection::getConnection())or die("Query error :".  mysql_error());
                    while ($dataR=  mysql_fetch_array($dat)){ 
                        $dataRows=$dataR['hi'];
                    }
                    ?>
                    <tr>
                        <td valign="top" style="border: 1px solid black; border-top: none;" ><?php echo $angka;?></td>
                        <td valign="top" style="border: 1px solid black; border-left: none; border-top: none;" ><b><?php echo ucwords($dataRow['nama_kelas']);?></b></td>
                        <td valign="top" style="border: 1px solid black; border-left: none; border-top: none;">
                        <?php 
                         $sqlMax="select distinct nama_awal,nama_tengah,nama_akhir,pelajaran.nama_pelajaran 
                             from jadual_pengajar 
                             inner join jadual on(jadual.id_jadual=jadual_pengajar.jadual_id)
                             inner join personal on(personal.id_siswa=jadual_pengajar.personal_id)
                             inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran)
                             where kelas_id='".$dataRow['id_kelas']."' and hari=1;";
                        $dat  =  mysql_query($sqlMax, DBConnection::getConnection())or die("Query error :".  mysql_error());
                            while ($dataR=  mysql_fetch_array($dat)){ 
                                echo ucwords($dataR['nama_awal']." ".$dataR['nama_tengah']." ".$dataR['nama_akhir']." <br>[ <i>".$dataR['nama_pelajaran']." </i> ]<br>");
                            }
                        ?>
                        </td>
                         <td valign="top" style="border: 1px solid black; border-left: none; border-top: none;" >
                        <?php 
                         $sqlMax="select distinct nama_awal,nama_tengah,nama_akhir ,pelajaran.nama_pelajaran 
                             from jadual_pengajar 
                             inner join jadual on(jadual.id_jadual=jadual_pengajar.jadual_id)
                             inner join personal on(personal.id_siswa=jadual_pengajar.personal_id)
                             inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran)
                             where kelas_id='".$dataRow['id_kelas']."' and hari=2;";
                        $dat  =  mysql_query($sqlMax, DBConnection::getConnection())or die("Query error :".  mysql_error());
                            while ($dataR=  mysql_fetch_array($dat)){ 
                                echo ucwords($dataR['nama_awal']." ".$dataR['nama_tengah']." ".$dataR['nama_akhir']." <br>[ <i>".$dataR['nama_pelajaran']." </i> ]<br>");
                            }
                        ?>
                        </td>
                         <td valign="top" style="border: 1px solid black; border-left: none; border-top: none;" >
                        <?php 
                         $sqlMax="select distinct nama_awal,nama_tengah,nama_akhir ,pelajaran.nama_pelajaran 
                             from jadual_pengajar 
                             inner join jadual on(jadual.id_jadual=jadual_pengajar.jadual_id)
                             inner join personal on(personal.id_siswa=jadual_pengajar.personal_id)
                             inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran)
                             where kelas_id='".$dataRow['id_kelas']."' and hari=3;";
                        $dat  =  mysql_query($sqlMax, DBConnection::getConnection())or die("Query error :".  mysql_error());
                            while ($dataR=  mysql_fetch_array($dat)){ 
                                echo ucwords($dataR['nama_awal']." ".$dataR['nama_tengah']." ".$dataR['nama_akhir']."<br>[ <i>".$dataR['nama_pelajaran']." </i> ]<br>");
                            }
                        ?>
                        </td>
                         <td valign="top" style="border: 1px solid black; border-left: none; border-top: none;" >
                        <?php 
                         $sqlMax="select distinct nama_awal,nama_tengah,nama_akhir,pelajaran.nama_pelajaran 
                             from jadual_pengajar 
                             inner join jadual on(jadual.id_jadual=jadual_pengajar.jadual_id)
                             inner join personal on(personal.id_siswa=jadual_pengajar.personal_id)
                             inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran)
                             where kelas_id='".$dataRow['id_kelas']."' and hari=4;";
                        $dat  =  mysql_query($sqlMax, DBConnection::getConnection())or die("Query error :".  mysql_error());
                            while ($dataR=  mysql_fetch_array($dat)){ 
                                echo ucwords($dataR['nama_awal']." ".$dataR['nama_tengah']." ".$dataR['nama_akhir']."<br>[ <i>".$dataR['nama_pelajaran']." </i> ]<br>");
                            }
                        ?>
                        </td>
                         <td valign="top" style="border: 1px solid black; border-left: none; border-top: none;" >
                        <?php 
                         $sqlMax="select distinct nama_awal,nama_tengah,nama_akhir ,pelajaran.nama_pelajaran 
                             from jadual_pengajar 
                             inner join jadual on(jadual.id_jadual=jadual_pengajar.jadual_id)
                             inner join personal on(personal.id_siswa=jadual_pengajar.personal_id)
                             inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran)
                             where kelas_id='".$dataRow['id_kelas']."' and hari=5;";
                        $dat  =  mysql_query($sqlMax, DBConnection::getConnection())or die("Query error :".  mysql_error());
                            while ($dataR=  mysql_fetch_array($dat)){ 
                                echo ucwords($dataR['nama_awal']." ".$dataR['nama_tengah']." ".$dataR['nama_akhir']."<br>[ <i>".$dataR['nama_pelajaran']." </i> ]<br>");
                            }
                        ?>
                        </td>
                         <td valign="top" style="border: 1px solid black; border-left: none; border-top: none;" >
                        <?php 
                         $sqlMax="select distinct nama_awal,nama_tengah,nama_akhir ,pelajaran.nama_pelajaran 
                             from jadual_pengajar 
                             inner join jadual on(jadual.id_jadual=jadual_pengajar.jadual_id)
                             inner join personal on(personal.id_siswa=jadual_pengajar.personal_id)
                             inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran)
                             where kelas_id='".$dataRow['id_kelas']."' and hari=6;";
                        $dat  =  mysql_query($sqlMax, DBConnection::getConnection())or die("Query error :".  mysql_error());
                            while ($dataR=  mysql_fetch_array($dat)){ 
                                echo ucwords($dataR['nama_awal']." ".$dataR['nama_tengah']." ".$dataR['nama_akhir']."<br>[ <i>".$dataR['nama_pelajaran']." </i> ]<br>");
                            }
                        ?>
                        </td>
                         <td valign="top" style="border: 1px solid black; border-left: none; border-top: none;" >
                        <?php 
                         $sqlMax="select distinct nama_awal,nama_tengah,nama_akhir ,pelajaran.nama_pelajaran 
                             from jadual_pengajar 
                             inner join jadual on(jadual.id_jadual=jadual_pengajar.jadual_id)
                             inner join personal on(personal.id_siswa=jadual_pengajar.personal_id)
                             inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran)
                             where kelas_id='".$dataRow['id_kelas']."' and hari=7;";
                        $dat  =  mysql_query($sqlMax, DBConnection::getConnection())or die("Query error :".  mysql_error());
                            while ($dataR=  mysql_fetch_array($dat)){ 
                                echo ucwords($dataR['nama_awal']." ".$dataR['nama_tengah']." ".$dataR['nama_akhir']."<br>[ <i>".$dataR['nama_pelajaran']." </i> ]<br>");
                            }
                        ?>
                        </td>
                    </tr> 
                <?php
                 }
                 ?>
                </table>
            </td>
          </tr>
		  <tr height="">
		  	<td height="40">&nbsp;</td>
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
             <p>&nbsp;             </p>
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