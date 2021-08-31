<?php
include_once '../../../db/DBConnection.php';
include_once '../../../model/Personal.php';
include_once '../../../model/Listjadual.php';

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
              <td width="100%" align="center"><font style="font-size: 18px;"><b>Jadual Kajian </b></font></td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">              
                    <tr style="background: #CCC;">
                        <td width="2%" style="border: 1px solid black;">NO</td>
                        <td width="13%" style="border: 1px solid black; border-left: none;">Kelas</td>
                        <!--<td width="10%" style="border: 1px solid black; border-left: none;">Ruangan</td>
                        <td width="6%" style="border: 1px solid black; border-left: none;">Jam Mulai </td>
                        <td width="7%" style="border: 1px solid black; border-left: none;">Jam Selesai </td>-->
                        <td align="center" width="13%" style="border: 1px solid black; border-left: none;">Senin</td>
                        <td align="center" width="14%" style="border: 1px solid black; border-left: none;">Selasa</td>
                        <td align="center" width="11%" style="border: 1px solid black; border-left: none;">Rabu</td>
                        <td align="center" width="12%" style="border: 1px solid black; border-left: none;">Kamis</td>
                        <td align="center" width="12%" style="border: 1px solid black; border-left: none;">Jumat</td>
                        <td align="center" width="11%" style="border: 1px solid black; border-left: none;">Sabtu</td>
                        <td align="center" width="12%" style="border: 1px solid black; border-left: none;">Minggu</td>
                    </tr>
            <?php
            $angka=0;
                    //untuk mendapatkan data dari jadual
                    $sqlJadual="select distinct "
                            . "kelas.nama_kelas, "
                            . "jadual.kelas_id as id_kelas "
                            . "from jadual inner join ruangan on(jadual.id_ruangan=ruangan.id_ruangan) "
                            . "inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran) "
                            . "inner join kelas on(jadual.kelas_id=kelas.id_kelas) ";
                    $sqlJadual=$sqlJadual." order by id_kelas";
                    $dataMax  =  mysql_query($sqlJadual, DBConnection::getConnection())or die("Query error :".  mysql_error());                  
                    while ($dataRow=  mysql_fetch_array($dataMax)){ 
                    $angka=$angka+1;
                    //ini unutk menentukan jumlah rowspan
                    $dataRows=0;
                    $sqlMax="select count(hari) as hi, hari from jadual  "
                            . "where jadual.kelas_id='".$dataRow['id_kelas']."' "
                            . "group by hari order by hi desc limit 1 ";
                    $dat  =  mysql_query($sqlMax, DBConnection::getConnection())or die("Query error :".  mysql_error());
                    while ($dataR=  mysql_fetch_array($dat)){ 
                        $dataRows=$dataR['hi'];
                    }
                    ?>
                    <tr>
                        <td valign="top" style="border: 1px solid black; border-top: none;" rowspan="<?php echo $dataRows;?>"><?php echo $angka;?></td>
                        <td valign="top" style="border: 1px solid black; border-left: none; border-top: none;" rowspan="<?php echo $dataRows;?>"><b><?php echo ucwords($dataRow['nama_kelas']);?></b></td>
                        <!--<td style="border: 1px solid black; border-left: none; border-top: none;"><?php //echo $dataRow['nama_ruangan'];?></td>-->
                        <?php 
                         $sqlJa="select distinct hari, "
                            . "jam_mulai, "
                            . "jam_selesai, "
                            . "nama_ruangan, "
                            . "nama_pelajaran, "
                            . "kelas.nama_kelas, "
                            . "jadual.kelas_id as id_kelas "
                            . "from jadual inner join ruangan on(jadual.id_ruangan=ruangan.id_ruangan) "
                            . "inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran) "
                            . "inner join kelas on(jadual.kelas_id=kelas.id_kelas) "
                            . "where jadual.kelas_id='".$dataRow['id_kelas']."' "
                                 . "and (jadual.status is null or status=0) "
                            . "order by hari,jam_mulai,jam_selesai";
                        $dataM  =  mysql_query($sqlJa, DBConnection::getConnection())or die("Query error :".  mysql_error());
                        $row=0;
                        $banding=1;
                        $listIsi=array();
                        $listTmp=array();
                        while ($dataRo=  mysql_fetch_array($dataM)){
                            for($i=0;$i<=$banding;$i++){
                            if($banding<$dataRo['hari']){
                                    echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">-</td>';
                                    $row++;
                                    $banding++;
                                }
                            }
                            for ($i=1;$i<8;$i++){
                                
                                if($i==$dataRo['hari']){
                                    if(!in_array($dataRo['hari'], $listIsi)){
                                        $listIsi[]=$dataRo['hari'];
                                         $row=$row+1;
                                         $banding++;
                        ?>
                        <td align="center" style="border: 1px solid black; border-left: none; border-top: none;"><?php echo ucwords($dataRo['nama_pelajaran'])."<br>".substr($dataRo['jam_mulai'],0, 5)." s/d ".substr($dataRo['jam_selesai'],0,5); ?></td>
                        <?php 
                                    }else{
                                        $listJadual=new Listjadual();
                                        $listJadual->setHari($dataRo['hari']);
                                        $listJadual->setPelajaran($dataRo['nama_pelajaran']);
                                        $listJadual->setJammulai($dataRo['jam_mulai']);
                                        $listJadual->setJamSelesai($dataRo['jam_selesai']);
                                        $listTmp[]=$listJadual;
                                    }
                                }
                            } 
                        }
                        $data=7-$row;
                        for($i=0;$i<$data;$i++){
                            echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">-</td>';
                        }
                        //ini untuk membuat baris yang kedua
                        echo '</tr>';
                        $banding=1;
                        $listIsi2= array();
                        $listTmp2=array();
                        $row2=0;
                        foreach ($listTmp as $tampil2){
                            for($i=0;$i<=$banding;$i++){
                            if($banding<$tampil2->getHari()){
                                   echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">-</td>';
                                   $row2++;
                                   $banding++;
                               }
                            }
                            for ($i=1;$i<8;$i++){
                                if($i==$tampil2->getHari()){
                                    if(!in_array($tampil2->getHari(), $listIsi2)){
                                        $listIsi2[]=$tampil2->getHari();
                                         $row2=$row2+1;
                                         $banding=$banding+1;
                        ?>
                        <td align="center" style="border: 1px solid black; border-left: none; border-top: none;"><?php echo ucwords($tampil2->getPelajaran())."<br>".substr($tampil2->getJammulai(),0,5)." s/d ".substr($tampil2->getJamSelesai(),0,5); ?></td>
                        <?php 
                                    }else{
                                        $listJadual=new Listjadual();
                                        $listJadual->setHari($tampil2->getHari());
                                        $listJadual->setPelajaran($tampil2->getPelajaran());
                                        $listJadual->setJammulai($tampil2->getJammulai());
                                        $listJadual->setJamSelesai($tampil2->getJamSelesai());
                                        $listTmp2[]=$listJadual;
                                    }
                                }
                            } 
                        }
                        if($listTmp){
                            $data2=7-$row2;
                            for($i=0;$i<$data2;$i++){
                                echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">-</td>';
                            }
                        }
                        //ini untuk membuat baris yang ketiga
                        echo '</tr>';
                        $banding=1;
                        $listIsi3= array();
                        $listTmp3=array();
                        $row3=0;
                        foreach ($listTmp2 as $tampil3){
                            for($i=0;$i<=$banding;$i++){
                            if($banding<$tampil3->getHari()){
                                   echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">-</td>';
                                   $row3++;
                                   $banding++;
                               }
                            }
                            for ($i=1;$i<8;$i++){
                                if($i==$tampil3->getHari()){
                                    if(!in_array($tampil3->getHari(), $listIsi3)){
                                        $listIsi3[]=$tampil3->getHari();
                                         $row3=$row3+1;
                                         $banding=$banding+1;
                        ?>
                        <td align="center" style="border: 1px solid black; border-left: none; border-top: none;"><?php echo ucwords($tampil3->getPelajaran())."<br>".substr($tampil3->getJammulai(),0,5)." s/d ".substr($tampil3->getJamSelesai(),0,5) ; ?></td>
                        <?php 
                                    }else{
                                        $listJadual=new Listjadual();
                                        $listJadual->setHari($tampil3->getHari());
                                        $listJadual->setPelajaran($tampil3->getPelajaran());
                                        $listJadual->setJammulai($tampil3->getJammulai());
                                        $listJadual->setJamSelesai($tampil3->getJamSelesai());
                                        $listTmp3[]=$listJadual;
                                    }
                                }
                            } 
                        }
                        if($listTmp2){
                            $data3=7-$row3;
                            for($i=0;$i<$data3;$i++){
                                echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">-</td>';
                            }
                        }
                        //ini untuk membuat baris yang keempat
                        echo '</tr>';
                        $banding=1;
                        $listIsi4= array();
                        $listTmp4=array();
                        $row4=0;
                        foreach ($listTmp3 as $tampil4){
                            for($i=0;$i<=$banding;$i++){
                            if($banding<$tampil4->getHari()){
                                   echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">-</td>';
                                   $row4++;
                                   $banding++;
                               }
                            }
                            for ($i=1;$i<8;$i++){
                                if($i==$tampil4->getHari()){
                                    if(!in_array($tampil4->getHari(), $listIsi4)){
                                        $listIsi4[]=$tampil4->getHari();
                                         $row4=$row4+1;
                                         $banding=$banding+1;
                        ?>
                        <td align="center" style="border: 1px solid black; border-left: none; border-top: none;"><?php echo ucwords($tampil4->getPelajaran())."<br>".substr($tampil4->getJammulai(),0,5)." s/d ".substr($tampil4->getJamSelesai(),0,5) ; ?></td>
                        <?php 
                                    }else{
                                        $listJadual=new Listjadual();
                                        $listJadual->setHari($tampil4->getHari());
                                        $listJadual->setPelajaran($tampil4->getPelajaran());
                                        $listJadual->setJammulai($tampil4->getJammulai());
                                        $listJadual->setJamSelesai($tampil4->getJamSelesai());
                                        $listTmp4[]=$listJadual;
                                    }
                                }
                            } 
                        }
                        if($listTmp3){
                            $data4=7-$row4;
                            for($i=0;$i<$data4;$i++){
                                echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">-</td>';
                            }
                        }
                        //ini untuk membuat baris yang kelima
                        echo '</tr>';
                        $banding=1;
                        $listIsi5= array();
                        $listTmp5=array();
                        $row5=0;
                        foreach ($listTmp4 as $tampil5){
                            for($i=0;$i<=$banding;$i++){
                            if($banding<$tampil5->getHari()){
                                   echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">-</td>';
                                   $row5++;
                                   $banding++;
                               }
                            }
                            for ($i=1;$i<8;$i++){
                                if($i==$tampil5->getHari()){
                                    if(!in_array($tampil5->getHari(), $listIsi5)){
                                        $listIsi5[]=$tampil5->getHari();
                                         $row5=$row5+1;
                                         $banding=$banding+1;
                        ?>
                        <td align="center" style="border: 1px solid black; border-left: none; border-top: none;"><?php echo ucwords($tampil5->getPelajaran())."<br>".substr($tampil5->getJammulai(),0,5)." s/d ".substr($tampil5->getJamSelesai(),0,5) ; ?></td>
                        <?php 
                                    }else{
                                        $listJadual=new Listjadual();
                                        $listJadual->setHari($tampil5->getHari());
                                        $listJadual->setPelajaran($tampil5->getPelajaran());
                                        $listJadual->setJammulai($tampil5->getJammulai());
                                        $listJadual->setJamSelesai($tampil5->getJamSelesai());
                                        $listTmp5[]=$listJadual;
                                    }
                                }
                            } 
                        }
                        if($listTmp4){
                            $data5=7-$row5;
                            for($i=0;$i<$data5;$i++){
                                echo '<td align="center" style="border: 1px solid black; border-left: none; border-top: none;">-</td>';
                            }
                        }
                        ?>
           
                    </tr> 
                <?php
                 }
                 ?>
                </table>
            </td>
          </tr>
		  <tr height="">
		  	<td height="40">&nbsp;</td>
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
             <p>&nbsp;             </p>
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