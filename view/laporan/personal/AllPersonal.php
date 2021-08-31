<?php
include_once '../../../db/DBConnection.php';

        $listPerson='';
        $listJadual=isset($_POST['searchable']) ? $_POST['searchable'] : '';
       
                $listPerson=$listPerson."'"
           
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
<body style="overflow: scroll;">
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
                </table>
              </td>
          </tr>
          <tr>
              <td width="896" align="center" height="50"><font style="font-size: 20px;"><b>Ringkasan Data Santri</b></font></td>
          </tr>
          <tr>
            <td>
            <?php 
            $angka=0;
            if($listJadual!=''){
               foreach ($listJadual as $value){
                $sql="select * from personal where id_siswa='".$value."' order by kelamin,id_siswa";
                $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                while ($dataRow=  mysql_fetch_array($dataQry)){ 
                    $angka=$angka+1;
                    ?>
                            <center>
                            <div style="
                                        width: 20%;
                                        height: 160px;
                                        display: inline-block;
                                        float: left;
                                        position: relative;
                                        margin: 5px auto;

                                        " >
                                <center>
                                <img src="../../../foto/<?php echo $dataRow['foto'];?>" width="100" height="120" /><br>
                                <label style="font-size: small"><?php echo $dataRow['nama_awal']." ".$dataRow['nama_tengah']." ".$dataRow['nama_akhir'];?></label><br>
                                <label style="font-size: small"><?php if($dataRow['telepon']==''){
                                        echo 'N/A';}else{echo $dataRow['telepon'];}?></label>

                                </center>
                            </div>
                            </center>
                  
                <?php
                 }
                }
              }
             ?>
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