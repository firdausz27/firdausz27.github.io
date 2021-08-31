<?php
include_once '../../../db/DBConnection.php';
include_once '../../../model/Personal.php';
// $listPerson='';
 $tglFrom=  InggrisTgl(isset($_POST['txtTglFrom']) ? $_POST['txtTglFrom'] : '');
 $tglTo= InggrisTgl(isset($_POST['txtTglTo']) ? $_POST['txtTglTo'] : '');
 $cboEmp=isset($_POST['cboKas']) ? $_POST['cboKas'] : '';
function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$tgl-$bln-$thn";
	return $tanggal;
}

function InggrisTgl($tanggal){
	$tgl=substr($tanggal,0,2);
	$bln=substr($tanggal,3,2);
	$thn=substr($tanggal,6,4);
	$tanggal="$thn-$tgl-$bln";
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
              <td width="100%" align="center"><font style="font-size: 18px;">
                  <b>Lapaoran Pemasukan Personal</b>
                  <br><?php echo 'Dari '.IndonesiaTgl($tglFrom).' Sampai '.IndonesiaTgl($tglTo)?></font>
              </td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2"> 
                    <tr>
                        <td style="border: 1px solid black; border-right: none;">&nbsp;</td>
                        <td colspan="4" width="3%" style="border: 1px solid black; border-left: none;"> 
                            <?php 
                            $sql="select nama_awal,nama_tengah,nama_akhir from personal where id_siswa='$cboEmp'";
                            $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                            while ($dataRow=  mysql_fetch_array($dataQry)){ 
                                echo 'Nama : '.$dataRow['nama_awal'].' '.$dataRow['nama_tengah'].' '.$dataRow['nama_akhir'].' [ '.$cboEmp.' ]';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr style="background: #CCC;">
                        <td width="3%" style="border: 1px solid black;">NO</td>
                        <td width="36%" style="border: 1px solid black; border-left: none;">Nama Kas</td>
                        <td width="15%" style="border: 1px solid black; border-left: none;">Tanggal Transaksi</td>
                        <td width="15%" style="border: 1px solid black; border-left: none;">Kategori</td>
                        <td style="border: 1px solid black; border-left: none;">Jumlah</td>
                    </tr>
            <?php
            $angka=0; 
                $sql="select p.pemasukan_id,
                        p.tanggal,
                        keuangan_kategori.nama_kategori,
                        nama_kas,
                        keuangan_kas.jumlah as total,
                        pd.jumlah 
                    from        keuangan_pemasukan p 
                    inner join  keuangan_pemasukan_detail pd
                    on          (p.pemasukan_id=pd.pemasukan_id)
                    inner join  keuangan_kas 
                    on          (p.kas_id=keuangan_kas.id_kas)
                    inner join  keuangan_kategori 
                    on          (p.kategori_id=keuangan_kategori.id_kategori)
                    where        pd.personal_id='$cboEmp'
                    and p.tanggal <= '$tglTo'
                    and p.tanggal >='$tglFrom'";
                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                $total=0;
                $JumlahKas=0;
                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                    $JumlahKas=$JumlahKas+$dataRow['jumlah'];
                    $angka++;
                    ?>
                    <tr>
                        <td  style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                        <td  style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_kas'];?></td>
                        <td  style="border: 1px solid black; border-left: none; border-top: none;"><?php echo IndonesiaTgl($dataRow['tanggal']);?></td>
                        <td  style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_kategori'];?></td> 
                        <td width="12%" style="border: 1px solid black; border-left: none; border-top: none;"><div align="right">Rp <?php echo number_format($dataRow['jumlah']);?></div></td>
                    </tr>
                <?php
                }
             ?>
                    <tr>
                        <td  colspan="4" style="border: 1px solid black; border-top: none;"><div align="right"><strong>Jumlah Pemasukan</strong></div></td>
                        <td  style="border: 1px solid black; border-left: none; border-top: none;"><div align="right"><strong>Rp <?php echo number_format($JumlahKas);?></strong></div></td>
                    </tr>
                </table>
            </td>
          </tr>
          <tr>
           <td align="center">
             <input type="submit" name="bPrint" id="bPrint" value="Print" onClick="hideButton();javascript:window.print();"/>
           <input type="reset" name="bClose" id="bClose" value="Close" onClick=" window.close();"/></td>
         </tr>
        </table>
    </div>
</center>
</body>
</html>
