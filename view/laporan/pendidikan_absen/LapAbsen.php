<?php
include_once '../../../db/DBConnection.php';
date_default_timezone_set('Asia/Jakarta');

$tglAwal=isset($_POST['txtTanggalAwal']) ? $_POST['txtTanggalAwal'] : '';
$tglAkhir= isset($_POST['txtTanggalAkhir']) ? $_POST['txtTanggalAkhir'] : '';
$listEmp=isset($_POST['searchable']) ? $_POST['searchable'] : '';
$jumlahHari= strtotime($tglAkhir) -  strtotime($tglAwal);
$hari = ($jumlahHari/(60*60*24))+1;
$pengajar=isset($_POST['cboPengajar']) ? $_POST['cboPengajar'] : '';
$jadual=isset($_POST['cboJadual']) ? $_POST['cboJadual'] : '';
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
        </script>
    </head>
<body style="overflow: scroll; font-size: small;">
<center>
    <div>
        <table width="1164" border="0" cellspacing="1" cellpadding="2">
        
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
              <td width="100%" align="center"><font style="font-size: 18px;"><b>Absensi Kajian</b></font></td>
          </tr>
          <tr>
              <td width="100%" align="center"><b><?php echo 'Dari  '.$tglAwal.'  s/d  '.$tglAkhir; ?></b></td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="3"> 
                   
                        <tr style="background: #CCC;">
                            <td align="center" width="2%" rowspan="2" style="border: 1px solid black;">NO</td>
                            <td width="13%" rowspan="2" style="border: 1px solid black; border-left: none;">Nama</td>
                            <td align="center" colspan="<?php echo $hari; ?>" width="72%" style="border: 1px solid black; border-left: none; ">Tanggal</td>
                            <td align="center" rowspan="2" width="3%" style="border: 1px solid black; border-left: none; ">Tot<br>PRS</td>
                            <td align="center" rowspan="2" width="3%" style="border: 1px solid black; border-left: none; ">Tot<br>ABS</td>
                            <td align="center" rowspan="2" width="3%" style="border: 1px solid black; border-left: none; ">Tot<br>IJN</td>
                            <td align="center" rowspan="2" width="3%" style="border: 1px solid black; border-left: none; ">Tot<br>SCK</td>
                        </tr>
                        <tr style="background: #CCC;">
                            <?php 
                            $tgl=strtotime($tglAwal);
                            for($i=1;$i<=$hari;$i++){
                                echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">'.date("d",$tgl).'</td>';
                                $tgl=$tgl+(60*60*24);
                            }
                            ?>
                        </tr>
                    </tr>
                    <?php
                    if($listEmp!=''){
                        $listSiswa=implode("','",$listEmp);
                        $sql="select id_siswa,nama_awal,nama_tengah,nama_akhir 
                            from  personal 
                            where id_siswa in ('".$listSiswa."');";
                         $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                         while ($dataRow=  mysql_fetch_array($dataQry)){ 
                            $angka=$angka+1;
                            $prs=0;
                            $abs=0;
                            $ijn=0;
                            $sck=0;
                        ?>
                        <tr>
                            <td align="center" valign="top" style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                            <td valign="top" style="border: 1px solid black; border-top: none; border-left: none;"><b><?php echo ucwords($dataRow['nama_awal'].' '.$dataRow['nama_tengah'].' '.$dataRow['nama_akhir']);?></b></td>
                            <?php 
                            $tgl=strtotime($tglAwal);
                            for($i=1;$i<=$hari;$i++){
                                echo '<td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;">';
                                $sqlD="select absensi_personal.* from absensi 
                                    inner join absensi_personal 
                                    on(absensi_personal.id_absensi=absensi.id_absensi)
                                    where tanggal='".date("Y-m-d",$tgl)."'
                                    and id_siswa='".$dataRow['id_siswa']."'";
                                //echo $sqlD.'<br>';
                                 $dataQryD  =  mysql_query($sqlD, DBConnection::getConnection())or die("Query error :".  mysql_error());
                                 while ($dataRowD=  mysql_fetch_array($dataQryD)){ 
                                        echo  ucwords('<font style=" font-size: smaller">'.$dataRowD['status'].'</font><br>');
                                        if($dataRowD['status']=="PRS"){
                                            $prs=$prs+1;
                                        }else if($dataRowD['status']=="ABS"){
                                            $abs=$abs+1;
                                        }else if($dataRowD['status']=="IJN"){
                                            $ijn=$ijn+1;
                                        }else if($dataRowD['status']=="SCK"){
                                            $sck=$sck+1;
                                        }
                                 }
                                 echo '</td>';
                                 $tgl=$tgl+(60*60*24);
                            }
                            ?>
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $prs;?></td>
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $abs;?></td>
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $ijn;?></td>
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $sck;?></td>
                        </tr>
                        
                        <?php 
                            }
                       }
                        ?>
                </table>
            </td>
          </tr>
           
           <tr>
            <td colspan="3"><table width="750" border="0" cellspacing="1" cellpadding="2">
              <tr>
                <td width="49">PRS</td>
                <td width="8">:</td>
                <td width="677">Hadir</td>
              </tr>
              <tr>
                <td>ABS</td>
                <td>:</td>
                <td>Tidak ada kabar</td>
              </tr>
              <tr>
                <td>IJN</td>
                <td>:</td>
                <td>Ijin</td>
              </tr>
              <tr>
                <td>SCK</td>
                <td>:</td>
                <td>Sakit</td>
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



