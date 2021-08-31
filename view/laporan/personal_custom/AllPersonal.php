<?php
include_once '../../../db/DBConnection.php';
include_once '../../../model/Personal.php';
// $listPerson='';
 $listJadual=isset($_POST['searchable']) ? $_POST['searchable'] : '';
 $checkKota=isset($_POST['checkKota']) ? $_POST['checkKota'] : '';
 $checkKategori=isset($_POST['checkKategori']) ? $_POST['checkKategori'] : '';
 $checkKelamin=isset($_POST['checkKelamin']) ? $_POST['checkKelamin'] : '';
 $ccheckTTL=isset($_POST['checkTTL']) ? $_POST['checkTTL'] : '';
 $checkTelepon=isset($_POST['checkTelepon']) ? $_POST['checkTelepon'] : '';
 $checkAlamat=isset($_POST['checkAlamat']) ? $_POST['checkAlamat'] : '';
 $checkPropinsi=isset($_POST['checkPropinsi']) ? $_POST['checkPropinsi'] : '';
 $checkNegara=isset($_POST['checkNegara']) ? $_POST['checkNegara'] : '';
 $checkTglGabung=isset($_POST['checkTglGabung']) ? $_POST['checkTglGabung'] : '';
 
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
        <table width="100%" border="0" cellspacing="1" cellpadding="2">
        
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
              <td width="100%" align="center"><font style="font-size: 18px;"><b>Data Santri</b></font></td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">              
                    <tr style="background: #CCC;">
                        <td style="border: 1px solid black;">NO</td>
                        <td style="border: 1px solid black; border-left: none;">Nama</td>
                        <?php if($checkKota=="1"){?>
                            <td style="border: 1px solid black; border-left: none;">Kota</td>
                        <?php }
                        if($checkKategori=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none;">Kategori</td>
                        <?php }
                        if($checkKelamin=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none;">Kelamin</td>
                        <?php }
                        if($ccheckTTL=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none;">Tempat TGL Lahir</td>
                         <?php }
                        if($checkTelepon=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none;">Telepon</td>
                         <?php }
                        if($checkAlamat=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none;">Alamat</td>
                         <?php }
                        if($checkPropinsi=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none;">Propinsi</td>
                         <?php }
                        if($checkNegara=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none;">Negara</td>
                         <?php }
                        if($checkTglGabung=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none;">Tgl gabung</td>
                        <?php
                        }
                        ?>
                    </tr>
            <?php
            $angka=0;
            //ini untuk meload seluruh kategori pekerjaan
            if($listJadual!=''){
               $listSiswa=implode("','",$listJadual);
            //ini untuk me loop employee 
                $sql="select distinct *, negara.nama_negara ,nama_propinsi
                    from personal right outer join negara on(negara.id_negara=personal.negara)
                    inner join propinsi on(propinsi.id_propinsi=personal.propinsi) where 1=1 ";
                $sql=$sql." and id_siswa in ('".$listSiswa."') order by nama_awal,nama_tengah,nama_akhir";
                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                    $angka=$angka+1;
                    ?>
                    <tr>
                        <td style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_awal']." ".$dataRow['nama_tengah']." ".$dataRow['nama_akhir'];?></td>
                        <?php if($checkKota=="1"){?>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['kota'];?></td>
                        <?php }
                        if($checkKategori=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['kategori_santri'];?></td>
                        <?php }
                        if($checkKelamin=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php if($dataRow['kelamin']==2){echo 'Akhwat'; }else{ echo 'Ikhwan';}?></td>
                        <?php }
                        if($ccheckTTL=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['tempat_lahir']." / ".IndonesiaTgl($dataRow['tgl_lahir']);?></td>
                         <?php }
                        if($checkTelepon=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['telepon'];?></td>
                         <?php }
                        if($checkAlamat=="1"){
                        ?>
                           <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['alamat'];?></td>
                         <?php }
                        if($checkPropinsi=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_propinsi'];?></td>
                         <?php }
                        if($checkNegara=="1"){
                        ?>
                            <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_negara'];?></td>
                         <?php }
                        if($checkTglGabung=="1"){
                        ?>
                           <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo IndonesiaTgl($dataRow['tgl_gabung']);?></td>
                        <?php
                        }
                        ?>
                        
                    </tr> 
                <?php
                 }
               }
             ?>
                </table>
            </td>
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
