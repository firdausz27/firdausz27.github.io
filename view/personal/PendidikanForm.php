<?php
include_once './dao/PendidikanDao.php';
$pendidikanDa=new PendidikanDao();
//$allKategori = $pendidikanDa->getAllPendidikan();
//$row=20;
//$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
//$jumlah = sizeof($allKategori);
//$max= ceil($jumlah/$row);
$allKaryawanPage = $pendidikanDa->getAllPendidikanPage($_GET['Kode']);
$nomor=0;
/*if(isset($_POST['cboCari'])){
    $allKaryawanPage=$pendidikanDa->getCariPendidikan($_POST['cboCari'], $_POST['txtCari']);
}*/
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Karyawan</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">    
        <script>
            /*
            function validasi(){
                var field=document.getElementById("cboCari").value;
                var text=document.getElementById("txtCari").value;
                if(field==="blank"){
                    alert("Field pencarian belum dipilih !");
                    return false;
                }else if(text===""){
                    alert("Text Pencarian masih kosong !");
                }else{
                    document.forms["fPendidikan"].action="?page=PelajranForm";
                    document.forms["fPendidikan"].submit();
                    return true;
                }
            }
            */
        </script>
    </head>
    <body>
    <form name="fPendidikan" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">    
            <tr>
                <td width="950" colspan="9" align="left" class="title-form"><!--<img src="./images/application_side_list.png" ">-->&nbsp;<b>Pendidikan | Riwayat Pendidikan</b></td>
            </tr>
            <!--<tr>
            	<td>Cari 
            	  <select name="cboCari" id="cboCari">
            	    <option value="blank">- All -</option>
            	    <option value="id_pendidikan">Kode</option>
            	    <option value="nama_pendidikan">Nama</option>
            	    <option value="sks">SKS</option>
       	        </select>
            	  Kata Kunci
           	      <input type="text" name="txtCari" id="txtCari">
                      <input type="button" name="bCari" id="bCari" value="Cari" onclick="validasi();"></td>
            </tr>-->
            <tr>
                <td colspan="9"><a href='?page=EduInsert&personalId=<?php echo $kode=$_GET['Kode'];?>'>Tambah Data Pendidikan</a></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <th width="51">No</th>
                          <th width="100">Level</th>
                          <th width=250>Institusi</th>
                          <th width="100">No Ijazah</th>
                          <th width="150">Tahun Selesai</th>
                          <th width="239">Negara</th>
                        </tr>
                  
                  <?php
                  if($allKaryawanPage!=NULL){
                      foreach ($allKaryawanPage as $value) {
                          $nomor++;
                          $id=$value->getEducationId();                   
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
                    <td><?PHP echo $nomor;?></td>
                    <td><a href="?page=EduEdit&Kode=<?php echo $id;?>"><?PHP echo $value->getLevelPendidikan();?></a></td>
                    <td><?PHP echo $value->getInstitusi();?></td>    
                    <td><?PHP if($value->getNoIjazah()==NULL){echo 'N/A';}else{echo $value->getNoIjazah();} ?></td>
                    <td><?PHP echo $value->getTahunSelesai(); ?></td>
                    <td><?PHP echo $value->getNegara();?></td>
                    </tr>
                  <?php } 
                  }else{
                      echo '<tr><td colspan="6" align="center">---------------------------------.: Kosong :.-------------------------------</td></tr>';
                  }
                  ?>
              </table>
          </td>
      </tr>
      <tr>
          <!--<td>Jumlah : <?php //echo $jumlah; ?></td>
          <td align="right"> Halaman Ke :
              <?php
                /*for($h=1;$h<=$max;$h++){
                    $list[$h]=$row*$h-$row;
                    echo "<a href='?page=PendidikanForm&hal=$list[$h]'>$h</a>";
                }  */            
               ?>
          </td>-->
      </tr>
    </table>
    </form>
    </body>
</html>