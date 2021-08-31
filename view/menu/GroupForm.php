<?php
include_once './dao/GroupDao.php';
$groupDao=new GroupDao();
$allGroup = $groupDao->getAllGroup();
$row=20;
$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$jumlah = sizeof($allGroup);
$max= ceil($jumlah/$row);
$allGroup = $groupDao->getAllGroupPage($hal, $row);
$nomor=0;
$select='';
$text='';
if($_POST){
    $allGroup=$groupDao->getCariGroup($_POST['cboCari'], $_POST['txtCari']);
    //$jumlah=  sizeof($allGroup);
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
                    document.forms["fGroup"].action="?page=GroupForm";
                    document.forms["fGroup"].submit();
                    return true;
                }
            }
        </script>
    </head>
    <body>
    <form name="fGroup" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">    
            <tr>
                <td width="839" colspan="9" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Setting | Group </b></td>
            </tr>
            <tr>
            	<td>Cari 
            	  <select name="cboCari" id="cboCari">
                    <option value="blank" <?php if($select=='blank') echo 'selected=""'; ?>>- All -</option>
            	    <option value="id_group" <?php if($select=='id_kategori') echo 'selected=""'; ?>>Kode</option>
            	    <option value="nama_group" <?php if($select=='nama_kategori') echo 'selected=""'; ?>>Nama</option>
            	    <option value="keterangan" <?php if($select=='keterangan') echo 'selected=""'; ?>>Keterangan</option>
       	        </select>
            	  Kata Kunci
                  <input type="text" name="txtCari" id="txtCari" value="<?php echo $text;?>">
                      <input type="button" name="bCari" id="bCari" value="Cari" onClick="validasi();"></td>
            </tr>
            <tr>
              <td colspan="9"><a href="?page=GroupInsert">Tambah Group</a></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <th width="51">No</th>
                          <th width="330">Nama Group</th>
                          <th width="239">Tanggal Dibuat</th>
                        </tr>
                  
                  <?php
                      foreach ($allGroup as $value) {
                          $nomor++;
                          $id=$value->getKode();                   
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
                    <td><?PHP echo $nomor;?></td>
                    <td><a href="?page=GroupUpdate&Kode=<?php echo $id;?>"><?PHP echo $value->getNamaGroup();?></a></td>
                    <td><?PHP echo $value->getTglDibuat();?></td>
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
                    echo "<a href='?page=GroupKeuanganForm&hal=$list[$h]'>$h</a>";
                }              
               ?>
          </td>
      </tr>
    </table>
    </form>
    </body>
</html>