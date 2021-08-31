<?php
include_once './dao/KategoriPelajaranDao.php';
$kategoriDa=new KategoriPelajaranDao();
$allKategori = $kategoriDa->getAllKategori();
$row=20;
$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$jumlah = sizeof($allKategori);
$max= ceil($jumlah/$row);
$allKaryawanPage = $kategoriDa->getAllKategoriPage($hal, $row);
$nomor=0;
$select='';
$text='';
if($_POST){
    $allKaryawanPage=$kategoriDa->getCariKategori($_POST['cboCari'], $_POST['txtCari']);
    //$jumlah=  sizeof($allKaryawanPage);
    $select=$_POST['cboCari'];
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
                    document.forms["fKategori"].action="?page=KategoriPelajaranForm";
                    document.forms["fKategori"].submit();
                    return true;
                }
            }
        </script>
    </head>
    <body>
    <form name="fKategori" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">    
            <tr>
                <td width="839" colspan="9" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Mster | Kategori Pelajaran</b></td>
            </tr>
            <tr>
            	<td>Cari 
            	  <select name="cboCari" id="cboCari">
                    <option value="blank" <?php if($select=='blank') echo 'selected=""'; ?>>- All -</option>
            	    <option value="id_kategori" <?php if($select=='id_kategori') echo 'selected=""'; ?>>Kode</option>
            	    <option value="nama_kategori" <?php if($select=='nama_kategori') echo 'selected=""'; ?>>Nama</option>
            	    <option value="keterangan" <?php if($select=='keterangan') echo 'selected=""'; ?>>Keterangan</option>
       	        </select>
            	  Kata Kunci
                  <input type="text" name="txtCari" id="txtCari" value="<?php echo $text;?>">
                      <input type="button" name="bCari" id="bCari" value="Cari" onclick="validasi();"></td>
            </tr>
            <tr>
              <td colspan="9"><a href="?page=KategoriPelajaran">Tambah Kategori</a></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <th width="51">No</th>
                          <th width="139">Kode</th>
                          <th width="330">Nama Kategori</th>
                          <th width="239">Keterangan</th>
                        </tr>
                  
                  <?php
                      foreach ($allKaryawanPage as $value) {
                          $nomor++;
                          $id=$value->getKode();                   
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
                    <td><?PHP echo $nomor;?></td>
                    <td><a href="?page=KategoriPelajaranEdit&Kode=<?php echo $id;?>"><?PHP echo $value->getKode();?></a></td>
                    <td><?PHP echo $value->getNamaKategori()?></td>                   
                    <td><?PHP echo $value->getKeterangan();?></td>
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
                    echo "<a href='?page=KategoriPelajaranForm&hal=$list[$h]'>$h</a>";
                }              
               ?>
          </td>
      </tr>
    </table>
    </form>
    </body>
</html>