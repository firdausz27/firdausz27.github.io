<?php
include_once './dao/JadualDao.php';
include_once './dao/KelasDao.php';
$jadualDa=new JadualDao();
$personaldao=new PersonalDao();
$allKategori = $jadualDa->getAllJadual();
$row=20;
$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$jumlah = sizeof($allKategori);
$max= ceil($jumlah/$row);
$allKaryawanPage = $jadualDa->getAllJadualPage($hal, $row);
$nomor=0;
$cboCari='';
$txtCari='';
if($_POST){
    $allKaryawanPage=$jadualDa->getCariJadual($_POST['cboCari'], $_POST['txtCari']);
    $jumlah = sizeof($allKaryawanPage);
    $cboCari=$_POST['cboCari'];
    $txtCari=$_POST['txtCari'];
}
$pengajar=new Personal();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Karyawan</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">    
        <script>
            function validasi(){
                var field=document.getElementById("cboCari").value;
                var text=document.getElementById("txtCari").value;
                if(field==="blank"){
                    alert("Field pencarian belum dipilih !");
                    return false;
                }else if(text===""){
                    alert("Text Pencarian masih kosong !");
                }else{
                    document.forms["fJadual"].action="?page=JadualForm";
                    document.forms["fJadual"].submit();
                    return true;
                }
            }
        </script>
    </head>
    <body>
    <form name="fJadual" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">    
            <tr>
                <td width="839" colspan="9" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Transaksi | Jadual</b></td>
            </tr>
            <tr>
            	<td>Cari 
            	  <select name="cboCari" id="cboCari">
            	    <option value="blank">- All -</option>
                    <option value="id_jadual" <?php if($cboCari=='id_jadual')echo 'selected=""'?>>Kode</option>
            	    <option value="ruangan.nama_ruangan" <?php if($cboCari=='hari')echo 'selected=""'?>>Ruangan</option>
            	    <option value="pelajaran.nama_pelajaran" <?php if($cboCari=='jam_mulai')echo 'selected=""'?>>Pelajaran</option>
                    <option value="kelas.nama_kelas" <?php if($cboCari=='jam_mulai')echo 'selected=""'?>>Kelas</option>
       	        </select>
            	  Kata Kunci
                  <input type="text" name="txtCari" id="txtCari" value="<?php echo $txtCari;?>">
                      <input type="button" name="bCari" id="bCari" value="Cari" onclick="validasi();"></td>
            </tr>
            <tr>
              <td colspan="9"><a href="?page=JadualInsert">Tambah Jadual</a></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <th width="33">No</th>
                          <th width="228">Ruangan</th>
                          <th width="101">Hari</th>
                          <th width="86">Jam Mulai</th>
                          <th width="97">Jam Selesai</th>
                          <th width="247">Pengajar</th>
                          <th width="306">Pelajaran</th>
                          <th width="306">Kelas</th>
                        </tr>
                  
                  <?php
                      foreach ($allKaryawanPage as $value) {
                          //untuk menampilkan kelas
                          $kelasDao=new KelasDao();
                          $kelas = $kelasDao->getKelas($value->getKeals());
                          $nomor++;
                          $id=$value->getJadualId();                   
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
                    <td valign="top"><?PHP echo $nomor;?></td>
                    <td  valign="top">
                        <a href="?page=JadualEdit&Kode=<?php echo $id;?>">
                            <?PHP 
                           echo $value->getIdRuangan()->getNama();;
                            ?>
                        </a>
                    </td>
                    <td  valign="top">
                        <?PHP 
                            echo $value->getHari();
                        ?>
                    </td>
                    <td align="center"  valign="top"><?PHP echo $value->getJamMulai();?></td>
                    <td align="center"  valign="top"><?PHP echo $value->getJamSelesai();?></td>
                    <td  valign="top">
                    <?PHP
                        foreach ($value->getPengajarId() as $idPengajar){
                            $pengajar=$personaldao->getPersonal($idPengajar);
                            if($pengajar!=NULL){
                                echo $pengajar->getNamaAwal()." ".$pengajar->getNamaTengah()." ".$pengajar->getNamaAkhir()."<br>";
                            }
                        }
                    ?>
                    </td>    
                    <td  valign="top"><?PHP echo $value->getIdPelajaran()->getNamaPelajaran();?></td>
                    <td valign="top"><?PHP echo $kelas->getNamaKelas();?></td>
                    </tr>
                  <?php } ?>
              </table>
          </td>
      </tr>
      <tr>
          <td>Jumlah : <?php echo $jumlah; ?></td>
          <td align="right"> Halaman Ke :
              <?php
                for($h=1;$h<=$max;$h++){
                    $list[$h]=$row*$h-$row;
                    echo "<a href='?page=JadualForm&hal=$list[$h]'>$h</a>";
                }              
               ?>
          </td>
      </tr>
    </table>
    </form>
    </body>
</html>