<?php
include_once './dao/PropinsiDao.php';
$propinsiDao=new PropinsiDao();
$allPropinsi = $propinsiDao->getAllPropinsi();
$row=20;
$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$jumlah = sizeof($allPropinsi);
$max= ceil($jumlah/$row);
$allPropinsiPage = $propinsiDao->getAllPropinsiPage($hal, $row);
$nomor=0;
$select='';
$text='';
if($_POST){
    $allPropinsiPage=$propinsiDao->getCariPropinsi($_POST['cboCari'], $_POST['txtCari']);
    //$jumlah=  sizeof($allPropinsiPage);
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
                    document.forms["fPropinsi"].action="?page=PropinsiForm";
                    document.forms["fPropinsi"].submit();
                    return true;
                }
            }
        </script>
    </head>
    <body>
    <form name="fPropinsi" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">    
            <tr>
                <td width="839" colspan="9" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Setting | Tabel Referesnsi | Propinsi</b></td>
            </tr>
            <tr>
            	<td>Cari 
            	  <select name="cboCari" id="cboCari">
                    <option value="blank" <?php if($select=='blank') echo 'selected=""'; ?>>- All -</option>
            	    <option value="id_propinsi" <?php if($select=='id_propinsi') echo 'selected=""'; ?>>Kode</option>
            	    <option value="nama_propinsi" <?php if($select=='nama_propinsi') echo 'selected=""'; ?>>Nama Propinsi</option>
            	    <option value="keterangan" <?php if($select=='keterangan') echo 'selected=""'; ?>>Keterangan</option>
       	        </select>
            	  Kata Kunci
                  <input type="text" name="txtCari" id="txtCari" value="<?php echo $text;?>">
                      <input type="button" name="bCari" id="bCari" value="Cari" onclick="validasi();"></td>
            </tr>
            <tr>
              <td colspan="9"><a href="?page=PropinsiInsert">Tambah Propinsi</a></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <th width="51">No</th>
                          <th width="139">Kode</th>
                          <th width="330">Nama Propinsi</th>
                          <th width="239">Keterangan</th>
                        </tr>
                  
                  <?php
                      foreach ($allPropinsiPage as $value) {
                          $nomor++;
                          $id=$value->getKode();                   
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
                    <td><?PHP echo $nomor;?></td>
                    <td><?PHP echo $value->getKode();?></td>
                    <td><a href="?page=PropinsiEdit&Kode=<?php echo $id;?>"><?PHP echo $value->getNama()?></a></td>                   
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
                    echo "<a href='?page=PropinsiForm&hal=$list[$h]'>$h</a>";
                }              
               ?>
          </td>
      </tr>
    </table>
    </form>
    </body>
</html>