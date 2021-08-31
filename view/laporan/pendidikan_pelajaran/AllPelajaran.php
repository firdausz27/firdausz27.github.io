<?php
include_once '../../../db/DBConnection.php';
include_once '../../../model/Personal.php';

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
              <td width="100%" align="center"><font style="font-size: 18px;"><b>Data Kajian </b></font></td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">              
                    <tr style="background: #CCC;">
                        <td width="7%" style="border: 1px solid black;">NO</td>
                        <td width="15%" style="border: 1px solid black; border-left: none;">Kode Kajian</td>
                        <td width="38%" style="border: 1px solid black; border-left: none;">Nama Kajian</td>
                        <td width="12%" style="border: 1px solid black; border-left: none;">Jumlah Jam</td>
                        <td width="28%" style="border: 1px solid black; border-left: none;">Kategori Kajian</td>
                    </tr>
            <?php
            $angka=0;
                $sql="select distinct id_pelajaran,nama_pelajaran,sks,nama_kategori
                    from pelajaran inner join kategori_pelajaran 
                    on(pelajaran.kategori_pelajaran=kategori_pelajaran.id_kategori)where 1=1 
                    order by id_pelajaran";
                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                    $angka=$angka+1;
                    ?>
                    <tr>
                        <td style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['id_pelajaran'];?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_pelajaran'];?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['sks'];?>&nbsp;Jam</td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_kategori'];?></td>
                    </tr> 
                <?php
                 }
             ?>
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
