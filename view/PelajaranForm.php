<?php
include_once './dao/PelajaranDao.php';
$pelajaranDa=new PelajaranDao();
$allKategori = $pelajaranDa->getAllPelajaran();
$row=20;
$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$jumlah = sizeof($allKategori);
$max= ceil($jumlah/$row);
$allKaryawanPage = $pelajaranDa->getAllPelajaranPage($hal, $row);
$nomor=0;
$pilihan='';
$text='';
if($_POST){
    $allKaryawanPage=$pelajaranDa->getCariPelajaran($_POST['cboCari'], $_POST['txtCari']);
    $pilihan=$_POST['cboCari'];
    $text=$_POST['txtCari'];
}
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
                    document.forms["fPelajaran"].action="?page=PelajranForm";
                    document.forms["fPelajaran"].submit();
                    return true;
                }
            }
        </script>
    </head>
    <body>
    <form name="fPelajaran" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">    
            <tr>
                <td width="839" colspan="9" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Mster | Mata Pelajaran</b></td>
            </tr>
            <tr>
            	<td>Cari 
            	  <select name="cboCari" id="cboCari">
                    <option value="blank" <?php if($pilihan=='blank')echo 'selected=""';?>>- All -</option>
            	    <option value="id_pelajaran"  <?php if($pilihan=='id_pelajaran')echo 'selected=""';?>>Kode</option>
            	    <option value="nama_pelajaran"  <?php if($pilihan=='nama_pelajaran')echo 'selected=""';?>>Nama</option>
            	    <option value="sks"  <?php if($pilihan=='sks')echo 'selected=""';?>>Jumlah Jam</option>
       	        </select>
            	  Kata Kunci
           	      <input type="text" name="txtCari" id="txtCari">
                      <input type="button" name="bCari" id="bCari" value="Cari" onclick="validasi();"></td>
            </tr>
            <tr>
              <td colspan="9"><a href="?page=Pelajran">Tambah Pelajaran</a></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <th width="51">No</th>
                          <th width="139">Kode</th>
                          <th width="330">Nama Pelajaran</th>
                          <th width="100">Jumlah Jam</th>
                          <th width="239">Kategori</th>
                        </tr>
                  
                  <?php
                      foreach ($allKaryawanPage as $value) {
                          $nomor++;
                          $id=$value->getIdPelajran();                   
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
                    <td><?PHP echo $nomor;?></td>
                    <td><a href="?page=PelajranEdit&Kode=<?php echo $id;?>"><?PHP echo $value->getIdPelajran();?></a></td>
                    <td><?PHP echo $value->getNamaPelajaran();?></td>    
                    <td><?PHP echo $value->getSks(); ?></td>
                    <td><?PHP echo $value->getKategoriPelajaran();?></td>
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
                    echo "<a href='?page=PelajaranForm&hal=$list[$h]'>$h</a>";
                }              
               ?>
          </td>
      </tr>
    </table>
    </form>
    </body>
</html>