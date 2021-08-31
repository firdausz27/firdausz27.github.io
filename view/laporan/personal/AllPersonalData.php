<?php
include_once '../../../db/DBConnection.php';
        $listPerson='';
        $listJadual=isset($_POST['searchable']) ? $_POST['searchable'] : '';
        $listPerson=$listPerson."'";
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
<body style="overflow: scroll; font-size: small">
<center>
        <table width="650" border="0" cellspacing="1" cellpadding="2">
           <!--<tr>
               <td width="896" align="center" style="" height="50">&nbsp;</td>
          </tr>-->
          
            <?php 
            
            if($listJadual!=''){
            foreach ($listJadual as $value){
                $sql="select *,negara.nama_negara, nama_propinsi from personal "
                        . " inner join negara on(negara.id_negara=personal.negara)"
                        . " inner join propinsi on(personal.propinsi=propinsi.id_propinsi) where id_siswa='".$value."' order by kelamin,id_siswa";
                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                    ?>
            <tr>
            <td height="1050" valign="top">
               <center>
                <!--<tr>
                    <td align="center" >-->
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
                        </table>
                   <!-- </td>
                </tr>-->
                
                    <div style=" position: relative; margin: 5px auto;" >
                        <table width="750" border="0" cellspacing="1" cellpadding="2">
                          <tr>
                              <td width="896" align="center" colspan="2"><font style="font-size: 20px;"><b>Data Santri</b></font></td>
                        </tr>
                          <tr>
                            <td width="250" height="200" align="center" valign="top" >
                                <img src="../../../foto/<?php echo $dataRow['foto'];?>" style="background-color: #eee;
                                            border: 0.1px solid #ccc;
                                            width: 150px;
                                            height: 200px;
                                            border-radius: 3px;
                                            box-shadow: 0 1px 0 #999;"/>
                            </td>
                            <td width="592"  valign="top">
                                <table width="100%" border="0" cellspacing="1" cellpadding="5">
                                    <tr align="left">
                                      <td width="25%">Nama </td>
                                      <td width="75%">: <?php echo $dataRow['nama_awal']." ".$dataRow['nama_tengah']." ".$dataRow['nama_akhir'];?>								</td>
                                    </tr>
                                    <tr align="left">
                                      <td>Telepon</td>
                                      <td>: <?php if($dataRow['telepon']==''){echo 'N/A';}else{echo $dataRow['telepon'];}?></td>
                                    </tr>
                                    <tr align="left">
                                      <td>Tempat - Tgl. Lahir</td>
                                      <td>: <?php echo $dataRow['tempat_lahir']." - ".IndonesiaTgl($dataRow['tgl_lahir']);?></td>
                                    </tr>
                                    <tr align="left">
                                      <td>Jenis Kelamin</td>
                                      <td>: <?php if($dataRow['kelamin']==1){echo 'Ikhwan';}else{echo 'Akhwat';}?></td>
                                    </tr>
                                    <tr align="left">
                                      <td>Alamat</td>
                                      <td>: <?php echo $dataRow['alamat'];?></td>
                                    </tr >
                                    <tr align="left">
                                      <td>Kota</td>
                                      <td>: <?php echo $dataRow['kota'];?></td>
                                    </tr>
                                    <tr align="left">
                                      <td>Propinsi</td>
                                      <td>: <?php echo $dataRow['nama_propinsi'];?></td>
                                    </tr>
                                    <tr align="left">
                                      <td>Negara</td>
                                      <td>: <?php echo $dataRow['nama_negara'];?></td>
                                    </tr>
                                    <tr align="left">
                                      <td>Kategori Santri</td>
                                      <td>: <?php echo $dataRow['kategori_santri'];?></td>
                                    </tr>
                                    <tr align="left">
                                      <td>Tanggal Gabung</td>
                                      <td>: <?php echo IndonesiaTgl($dataRow['tgl_gabung']);?></td>
                                    </tr>
                                    
                               </table>
                            </td>
                          </tr>
                          <tr>
                              
                              <td valign="top" colspan="2" style="padding-left: 30px;">
                                <table width="90%" cellspacing="0" cellpadding="3">
                                    <tr>
                                        <td align=left valign="top" colspan="4"><font style="font-size: medium"><b>Riwayat Keluarga</b></font></td>
                                    </tr>
                                    <tr style="background-color: #CCC;">
                                         <td width="25" style="border: 1px solid black;">No</td>
                                         <td style="border: 1px solid black; border-left: none;">Hubungan</td>
                                         <td style="border: 1px solid black; border-left: none;">Nama</td>
                                         <td style="border: 1px solid black; border-left: none;">Telepon</td>
                                         <td style="border: 1px solid black; border-left: none;">Alamat</td>
                                     </tr>
                            <?php 
                                $angka=0;
                                $sql="select * from family where personal_id='".$value."' order by Id_family";
                                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                                    $angka=$angka+1;
                            ?>    
                                      
                                     <tr>
                                         <td style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                                         <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['hubungan'];?></td>
                                         <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama'];?></td>
                                         <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['telepon'];?></td>
                                         <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['alamat'];?></td>
                                     </tr> 
                            <?php
                                }
                            ?>
                                    
                                </table>
                            </td>
                          </tr>
                          <tr>
                             
                              <td valign="top" colspan="2" style="padding-left: 30px;">
                                <table width="90%" cellspacing="0" cellpadding="3">
                                    <tr>
                                        <td align="left" valign="top" colspan="4"><font style="font-size: medium"><b>Riwayat Pendidikan</b></font></td>
                                    </tr>
                                    <tr style="background-color: #CCC;">
                                         <td width="25"style="border: 1px solid black;">No</td>
                                         <td style="border: 1px solid black; border-left: none;">Level</td>
                                         <td style="border: 1px solid black; border-left: none;">Institusi</td>
                                         <td style="border: 1px solid black; border-left: none;">Tahun Selesai</td>
                                     </tr>
                            <?php 
                                $angka=0;
                                $sql="select * from education_history where personal_id='".$value."' order by Id_education";
                                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                                    $angka=$angka+1;
                            ?>    
                                      
                                     <tr>
                                         <td style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                                         <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['level_pendidikan'];?></td>
                                         <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['institusi'];?></td>
                                         <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['tahun_selesai'];?></td>
                                     </tr> 
                            <?php
                                }
                            ?>
                                    
                                </table>
                            </td>
                          </tr>
                          <tr>
                              
                              <td valign="top" colspan="2" style="padding-left: 30px;">
                                <table width="90%" cellspacing="0" cellpadding="3">
                                    <tr>
                                        <td align="left" valign="top" colspan="4"><font style="font-size: medium"><b>Riwayat Pekerjaan</b></font></td>
                                    </tr>
                                    <tr style="background-color: #CCC;">
                                         <td width="25" style="border: 1px solid black;">No</td>
                                         <td style="border: 1px solid black; border-left: none;">Nama Pekerjaan</td>
                                         <td style="border: 1px solid black; border-left: none;">Nama Perusahaan</td>
                                         <td style="border: 1px solid black; border-left: none;">Alamat Perusahaan</td>
                                     </tr>
                            <?php 
                                $angka=0;
                                $sql="select * from pekerjaan where personal_id='".$value."' order by Id_Pekerjaan";
                                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                                    $angka=$angka+1;
                            ?>    
                                      
                                     <tr>
                                         <td style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                                         <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_pekerjaan'];?></td>
                                         <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_perusahaan'];?></td>
                                         <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['alamat'];?></td>
                                     </tr> 
                            <?php
                                }
                            ?>
                                     <tr>
                                         <td colspan="4">&nbsp;</td>
                                     </tr>
                                </table>
                            </td>
                          </tr>
                        </table>
                    </td>
                 </tr>
                <?php
                 }
                }
              }
             ?>
           
          <tr>
           <td align="center">
             <input type="submit" name="bPrint" id="bPrint" value="Print" onClick="hideButton();javascript:window.print();"/>
           <input type="reset" name="bClose" id="bClose" value="Close" onclick=" window.close();"/></td>
         </tr>
   </table>
</center>
</body>
</html>