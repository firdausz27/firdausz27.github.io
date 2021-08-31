<?php
include_once '../../../db/DBConnection.php';
include_once '../../../model/Personal.php';
// $listPerson='';
 $tglFrom=  InggrisTgl(isset($_POST['txtTglFrom']) ? $_POST['txtTglFrom'] : '');
 $tglTo= InggrisTgl(isset($_POST['txtTglTo']) ? $_POST['txtTglTo'] : '');
 $cboKas=isset($_POST['cboKas']) ? $_POST['cboKas'] : '';
 $pilihan=isset($_POST['radiobutton']) ? $_POST['radiobutton'] : '';
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

//if($act != 0){
/*
 header("Expires: Mon, 26 Jul 2001 05:00:00 GMT");
 header("Last-Modified:". gmdate("D, d M Y H:i:s") . "GMT");
 header("Cache-Control: no-store, no-cache, must-revalidate");
 header("Cache-Control: post-check=0, pre-check=0", false);
 header("Pragma: no-cache");
 header("Cache-Control: private");
 header("Content-Type: application/vnd.ms-excel; name='excel'");
 header("Content-disposition: attachment; filename=LapDataSiswa.xls");
*/
 //session_start(); 
 //include "../../koneksi.php";
//}
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
              <td align="center" width="100%">
                <table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#006633">
                  <tr>
                      <td width="11%" rowspan="3" colspan="2"align="center" valign="middle"><img src="../../../images/dm_logo.png" width="68" height="73" /></td>
                    <td width="89%"  colspan="2" align="left"><font color="#FFFF00" size="+2">MA'HAD DAARUL MUWAHHID</font></td>
                  </tr> 
                  <tr>
                    <td align="left"  colspan="2"><font color="#FFFFFF" size="+1">Jalan Flamboyan Nomor 59, Srengseng KebanganJakarta Barat 11630</font></td>
                  </tr>
                  <tr>
                    <td align="left"  colspan="2"><font color="#FFFFFF">Telp 021-58906112</font></td>
                  </tr>
                </table>
              </td>
          </tr>
          <tr>
              <td width="100%" align="center"><font style="font-size: 18px;">
                  <b>Lapaoran Detail Peminjaman</b><br>
                  <?php echo 'Dari '.IndonesiaTgl($tglFrom).' Sampai '.IndonesiaTgl($tglTo)?></font>
            </td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2"> 
                    <tr>
                        <td colspan="8" align="center" style="border: 1px solid black;">
                            <?php 
                            $sql="select * from keuangan_kas where id_kas='$cboKas'";
                            $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                            while ($dataRow=  mysql_fetch_array($dataQry)){ 
                                echo $dataRow['nama_kas'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr style="background: #CCC;">
                        <td width="2%" rowspan="2" style="border: 1px solid black; border-top: none;">NO</td>
                        <td width="30%" rowspan="2"style="border: 1px solid black; border-left: none; border-top: none;">Nama Peminjam</td>
                        <td width="12%" rowspan="2"style="border: 1px solid black; border-left: none; border-top: none;"><div align="center">Tanggal Pinjam</div></td>
                        <td width="12%" rowspan="2"style="border: 1px solid black; border-left: none; border-top: none;"><div align="center">Perkiraan Kembali</div></td>
                        <td width="12%" rowspan="2"style="border: 1px solid black; border-left: none; border-top: none;"><div align="center">Status</div></td>
                        <td colspan="3" style="border: 1px solid black; border-left: none; border-top: none;"><div align="center">Detail</div></td>
                    </tr>
                    <tr style="background: #CCC;">
			<td  width="10%" style="border: 1px solid black; border-left: none;border-top: none;"><div align="right">Total Pinjam </div></td>
                        <td  width="10%" style="border: 1px solid black; border-left: none; border-top: none;"><div align="right">Sisa Pinjam </div></td>
                        <td  width="12%" style="border: 1px solid black; border-left: none; border-top: none;"><div align="right">Cicilan</div></td>
                    </tr>
            <?php
            $angka=0; 
                $sql="select id_pinjam,
                        tgl_pinjam,
                        tgl_kembali,
                        nama_awal,
                        nama_tengah,
                        nama_akhir,
                        keuangan_kas.jumlah,
                        status,
                        nama_kas
                    from keuangan_pinjam inner join keuangan_kas 
                    on          (keuangan_kas.id_kas=keuangan_pinjam.kas_id) 
                    inner join  personal on(keuangan_pinjam.personal_id=personal.id_siswa)
                    where       keuangan_kas.id_kas='$cboKas'
                    and         tgl_pinjam<= '$tglTo'
                    and         tgl_pinjam>='$tglFrom'";
                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                $total=0;
                $JumlahKas=0;
                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                    $angka=$angka+1;
                    $JumlahKas=$dataRow['jumlah'];
                    $sqlDtl="select total_pinjam,"
                            . "sisa_pinjam,"
                            . "kredit_pinjam "
                            . "from keuangan_pinjam_detail as kd "
                            . "where kd.id_pinjam='".$dataRow['id_pinjam']."'";
                    $dataD =  mysql_query($sqlDtl, DBConnection::getConnection())or die("Query error :".  mysql_error());
                    $num_rows = mysql_num_rows($dataD);
                    ?>
                    <tr>
                        <td valign="top" rowspan="<?php echo $num_rows;?>" style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                        <td valign="top" rowspan="<?php echo $num_rows;?>" style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_awal'].' '.$dataRow['nama_tengah'].' '.$dataRow['nama_akhir'];?></td>
                        <td valign="top" rowspan="<?php echo $num_rows;?>" style="border: 1px solid black; border-left: none; border-top: none;"><?php echo IndonesiaTgl($dataRow['tgl_pinjam']);?></td>
                        <td valign="top" rowspan="<?php echo $num_rows;?>" style="border: 1px solid black; border-left: none; border-top: none;"><?php echo IndonesiaTgl($dataRow['tgl_kembali']);?></td>
                        <td valign="top" rowspan="<?php echo $num_rows;?>" style="border: 1px solid black; border-left: none; border-top: none;"><?php if($dataRow['status']=='l'){echo 'Lunas';}else{echo 'Pinjam';}?></td> 
                
                    
               <?php
                
                while ($dataDtl=  mysql_fetch_array($dataD)){
                    $total=$total+$dataDtl['kredit_pinjam'];
                    ?>
                      <td width="10%" style="border: 1px solid black; border-left: none; border-top: none;"><div align="right">Rp <?php echo number_format($dataDtl['total_pinjam']);?></div></td>
                      <td width="10%" style="border: 1px solid black; border-left: none; border-top: none;"><div align="right">Rp <?php echo number_format($dataDtl['sisa_pinjam']);?></div></td>
                      <td width="10%" style="border: 1px solid black; border-left: none; border-top: none;"><div align="right">Rp <?php echo number_format($dataDtl['kredit_pinjam']);?></div></td>
                    </tr>
                <?php
                    }
                }
             ?>
                    <tr>
                        <td  colspan="5" style="border: 1px solid black; border-top: none;"><div align="right"><strong>Jumlah Cicilan</strong></div></td>
                        <td  colspan="3" style="border: 1px solid black; border-left: none; border-top: none;"><div align="right"><strong>Rp <?php echo number_format($total);?></strong></div></td>
                    </tr>
                    <tr>
                        <td  colspan="5" style="border: 1px solid black; border-top: none;"><div align="right"><strong>Jumlah Kas</strong></div></td>
                        <td  colspan="3"style="border: 1px solid black; border-left: none; border-top: none;"><div align="right"><strong>Rp <?php echo number_format($JumlahKas);?></strong></div></td>
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
