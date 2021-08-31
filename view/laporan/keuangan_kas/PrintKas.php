<?php
include_once '../../../db/DBConnection.php';
$sql="select * from keuangan_kas";
$dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
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
              <td width="896" align="center"><font style="font-size: 18px;"><b>Laporan Kas </b></font></td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr style="background: #CCC;">
                        <td width="20%" style="border: 1px solid black;"><b>NO</b></td>
                        <td width="58%" style="border: 1px solid black; border-left: none;"><strong>Nama Kas</strong></td>
                        <td width="22%" align="right" style="border: 1px solid black; border-left: none;"><strong>Jumlah</strong></td>
                    </tr>
            <?php
            //}
            $angka=0;
            while ($dataRow=  mysql_fetch_array($dataQry)){ 
                $angka++;
            ?>
                    <tr>
                        <td style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                        <td style="border: 1px solid black; border-left: none; border-top: none;"><?php echo $dataRow['nama_kas'];?></td>
                        <td align="right" style="border: 1px solid black; border-left: none; border-top: none;"><strong>Rp <?php echo number_format($dataRow['jumlah']);?></strong></td>
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