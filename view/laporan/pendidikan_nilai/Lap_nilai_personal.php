<?php
include_once '../../../db/DBConnection.php';
include_once '../../../model/Personal.php';
date_default_timezone_set('Asia/Jakarta');

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
?>
 <!DOCTYPE html>
<html>
    <head>
        <script>
            function hideButton(){
                document.getElementById("bPrint").style.visibility = 'hidden';
                document.getElementById("bClose").style.visibility = 'hidden';
            }
        </script></head>
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
              <td width="100%" align="center"><font style="font-size: 18px;"><b>Nilai </b></font></td>
          </tr>
		  <tr>
             <td width="100%" align="center">
				 <b><?php echo ucwords($personal->getNamaAwal().' '.$personal->getNamaTengah().' '.$personal->getNamaAkhir());?></b>
			</td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="3"> 
                   
                        <tr style="background: #CCC;">
                            <td align="center" width="3%" rowspan="2" style="border: 1px solid black;">NO</td>
                            <td width="27%" rowspan="2" style="border: 1px solid black; border-left: none;">Nama Kajian</td>
                            <td align="center" colspan="5" style="border: 1px solid black; border-left: none; "><strong>Nilai</strong></td>
                        </tr>
                        <tr style="background: #CCC;">
                            <td align="center"  width="13%" style="border: 1px solid black; border-left: none; border-top:none;">Kesopanan</td>
                            <td align="center"  width="13%" style="border: 1px solid black; border-left: none; border-top:none;">Kerajinan</td>
                            <td align="center"  width="13%" style="border: 1px solid black; border-left: none; border-top:none;">Disiplin</td>
                            <td align="center"  width="13%" style="border: 1px solid black; border-left: none; border-top:none;">Nilai Huruf </td>
							<td align="center"  width="18%" style="border: 1px solid black; border-left: none; border-top:none;">Nilai Angka </td>
                        </tr>
                    <?php
                        $sql="select pelajaran.nama_pelajaran, kesopanan, kerajinan,disiplin,nilai_kajian,nilai_huruf,nilai_personal.keterangan 
                            from nilai inner join nilai_personal on(nilai.id_nilai=nilai_personal.id_nilai)
                            inner join jadual on(jadual.id_jadual=nilai.id_jadual)
                            inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran)
                            where nilai_personal.id_siswa='".$empid."';";
                         $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                         while ($dataRow=  mysql_fetch_array($dataQry)){ 
                            $angka=$angka+1;
                            $total=0
                        ?>
                        <tr>
                            <td align="center" valign="top" style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                            <td valign="top" style="border: 1px solid black; border-top: none; border-left: none;"><b><?php echo ucwords($dataRow['nama_pelajaran']);?></b></td>
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $dataRow['kesopanan'];?></td>
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $dataRow['kerajinan'];?></td>
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $dataRow['disiplin'];?></td>
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $dataRow['nilai_huruf'];?></td>
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $dataRow['nilai_kajian'];?></td>
                        </tr>
                        
                        <?php 
                           }
                        ?>
                </table>
            </td>
          </tr>
           
           <tr>
            <td colspan="3"><table width="781" border="0" cellspacing="1" cellpadding="2">
              <tr>
                <td width="26">&nbsp;</td>
                <td width="26">A</td>
                <td width="9">:</td>
                <td width="699">Istimewa</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>B</td>
                <td>:</td>
                <td>Baik</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>C</td>
                <td>:</td>
                <td>Cukup</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>D</td>
                <td>:</td>
                <td>Kurang</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>E</td>
                <td>:</td>
                <td>Buruk</td>
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



