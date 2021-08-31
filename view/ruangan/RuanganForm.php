<?php
include_once './dao/RuanganDao.php';
$ruanganDa=new RuanganDao();
$allKategori = $ruanganDa->getAllRuangan();
$row=20;
$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$jumlah = sizeof($allKategori);
$max= ceil($jumlah/$row);
$allKaryawanPage = $ruanganDa->getAllRuanganPage($hal, $row);
$nomor=0;
if($_POST){
    $allKaryawanPage=$ruanganDa->getCariRuangan($_POST['cboCari'], $_POST['txtCari']);
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
                    document.forms["fRuangan"].action="?page=RuaganForm";
                    document.forms["fRuangan"].submit();
                    return true;
                }
            }
        </script>
    </head>
    <body>
    <form name="fRuangan" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">    
            <tr>
                <td width="839" colspan="9" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Mster | Ruangan</b></td>
            </tr>
            <tr>
            	<td>Cari 
            	  <select name="cboCari" id="cboCari">
            	    <option value="blank">- All -</option>
            	    <option value="id_ruangan">Kode</option>
            	    <option value="nama_ruangan">Nama</option>
            	    <option value="keterangan">Keterangan</option>
       	        </select>
            	  Kata Kunci
           	      <input type="text" name="txtCari" id="txtCari">
                      <input type="button" name="bCari" id="bCari" value="Cari" onclick="validasi();"></td>
            </tr>
            <tr>
              <td colspan="9"><a href="?page=Ruagan">Tambah Ruangan</a></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <th width="51">No</th>
                          <th width="139">Kode</th>
                          <th width="330">Nama Ruangan</th>
                          <th width="239">Keteranan</th>
                        </tr>
                  
                  <?php
                      foreach ($allKaryawanPage as $value) {
                          $nomor++;
                          $id=$value->getRunaganId();                   
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
                    <td><?PHP echo $nomor;?></td>
                    <td><a href="?page=RuaganEdit&Kode=<?php echo $id;?>"><?PHP echo $value->getRunaganId();?></a></td>
                    <td><?PHP echo $value->getNama();?></td>    
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
                    echo "<a href='?page=RuanganForm&hal=$list[$h]'>$h</a>";
                }              
               ?>
          </td>
      </tr>
    </table>
    </form>
    </body>
</html>