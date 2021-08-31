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
                  <b>Lapaoran Pemasukan</b>
                  <br><?php echo 'Dari '.IndonesiaTgl($tglFrom).' Sampai '.IndonesiaTgl($tglTo)?></font>
              </td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">              
                    <tr style="background: #CCC;">
                        <td width="3%" style="border: 1px solid black;">NO</td>
                        <td width="44%" style="border: 1px solid black; border-left: none;">Nama Kas</td>
                        <td width="17%" style="border: 1px solid black; border-left: none;">Tanggal Transaksi</td>
                        <td width="19%" style="border: 1px solid black; border-left: none;">Kategori</td>
                        <td width="17%" style="border: 1px solid black; border-left: none;">Jumlah</td>
                    </tr>
            <?php
            $angka=0; 
                $sql="select pd.pemasukan_id,tanggal,nama_kas,keuangan_kas.jumlah,keuangan_kategori.nama_kategori,sum(pd.jumlah) sum
                    from keuangan_pemasukan inner join keuangan_kas 
                    on(keuangan_kas.id_kas=keuangan_pemasukan.kas_id)
                    inner join keuangan_kategori on(keuangan_pemasukan.kategori_id=keuangan_kategori.id_kategori) 
                    inner join keuangan_pemasukan_detail pd on(keuangan_pemasukan.pemasukan_id=pd.pemasukan_id)
                    where keuangan_kas.id_kas='$cboKas'
                    and tanggal<= '$tglTo'
                    and tanggal>='$tglFrom'
                    group by pd.pemasukan_id ";
                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                $total=0;
                $JumlahKas=0;
                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                    $angka=$angka+1;
                    $JumlahKas=$dataRow['jumlah'];
                    $total=$total+$dataRow['sum'];
                    ?>
                    <tr>
                        <td  style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                        <td  style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_kas'];?></td>
                        <td  style="border: 1px solid black; border-left: none; border-top: none;"><?php echo IndonesiaTgl($dataRow['tanggal']);?></td>
                        <td  style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_kategori'];?></td> 
                        <td  style="border: 1px solid black; border-left: none; border-top: none;"><div align="right">Rp <?php echo number_format($dataRow['sum']);?></div></td> 
                
                        <?php
                }
             ?>
                    <tr>
                        <td  colspan="4" style="border: 1px solid black; border-top: none;"><div align="right"><strong>Jumlah Pemasukan</strong></div></td>
                        <td  style="border: 1px solid black; border-left: none; border-top: none;"><div align="right"><strong>Rp <?php echo number_format($total);?></strong></div></td>
                    </tr>
                    <tr>
                        <td  colspan="4" style="border: 1px solid black; border-top: none;"><div align="right"><strong>Jumlah Kas</strong></div></td>
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
