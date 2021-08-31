<?php
include_once '../../../db/DBConnection.php';
date_default_timezone_set('Asia/Jakarta');

$tgl=isset($_GET['tgl']) ? $_GET['tgl'] : '';
$jadual=isset($_GET['jadual']) ? $_GET['jadual'] : '';
$angka=0;
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
        <meta http-equiv="refresh" content="20" />
    </head>
    <body style="font-size: small;">
<center>
    <div>
        <table width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr>
              <td width="100%" align="center"><font style="font-size: 18px; color: #000088;"><b>
                      <MARQUEE WIDTH=100% BEHAVIOR=ALTERNATE>Daftar Santri Tidak Hadir - <?php echo date_format(date_create($tgl), "d F Y");?></MARQUEE>
                  </b></font></td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="3"> 
                   
                        <tr style="background: #CCC;">
                            <td align="center" width="2%" style="border: 1px solid black;"><b>NO</b></td>
                            <td width="34%"  style="border: 1px solid black; border-left: none;"><b>Nama</b></td>
                            <td align="center"  width="8%" style="border: 1px solid black; border-left: none; "><b>Status</b></td>
                            <td align="center"  width="42%" style="border: 1px solid black; border-left: none; "><b>Keterangan</b></td>
                            <td align="center"  width="14%" style="border: 1px solid black; border-left: none; "><b>Kelamin</b></td>
                        </tr>
                    <?php
                        $sql="select nama_awal,
                                nama_tengah,
                                nama_akhir,
                                ap.status,
                                ap.keterangan,
                                kelamin 
                            from        absensi a inner join absensi_personal ap on(a.id_absensi=ap.id_absensi)
                            inner join  personal on(ap.id_siswa=personal.id_siswa)
                            where       a.tanggal='".InggrisTgl($tgl)."'
                            and         a.id_jadual='$jadual'
                            and         ap.status !='PRS' order by kelamin asc";
                         $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
                         while ($dataRow=  mysql_fetch_array($dataQry)){
                             $angka++;
                             $kelamin='';
                             if($dataRow['kelamin']==1){
                                 $kelamin='Ikhwan';
                             }else{
                                 $kelamin='Akhwat';
                             }
                        ?>
                        <tr>
                            <td align="center" valign="top" style="border: 1px solid black; border-top: none;"><?php echo $angka;?></td>
                            <td valign="top" align="left" style="border: 1px solid black; border-top: none; border-left: none;"><b><?php echo ucwords($dataRow['nama_awal'].' '.$dataRow['nama_tengah'].' '.$dataRow['nama_akhir']);?></b></td>                          
                            <td valign="top" align="center" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $dataRow['status']?></td>
                            <td valign="top" align="left" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo ucwords($dataRow['keterangan'])?></td>
                            <td valign="top" align="left" style="border: 1px solid black; border-top: none; border-left: none;"><?php echo $kelamin; ?></td>
                           
                        </tr>
                        <?php 
                            }
                        ?>
                </table>
            </td>
          </tr>
           <tr>
            <td><table width="675" border="0" cellspacing="1" cellpadding="2">
              <tr>
                <td width="30">PRS</td>
                <td width="8">:</td>
                <td width="63">Hadir</td>
                <td width="10">&nbsp;</td>
                <td width="25">ABS</td>
                <td width="8">:</td>
                <td width="108">Tidak ada kabar</td>
                <td width="26">&nbsp;</td>
                <td width="22">IJN</td>
                <td width="5">:</td>
                <td width="59">Ijin</td>
                <td width="18">&nbsp;</td>
                <td width="26">SCK</td>
                <td width="4">:</td>
                <td width="187">Sakit</td>
              </tr>
                </table>
            </td>
          </tr>
      </table>
    </div>
</center>
</body>
</html>



