<?php
include_once './dao/KeuanganKasDao.php';
$kategoriDa=new KeuanganKasDao();
$allKas = $kategoriDa->getAllKas();
$row=20;
$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$jumlah = sizeof($allKas);
$max= ceil($jumlah/$row);
$allKaryawanPage = $kategoriDa->getAllKasPage($hal, $row);
$nomor=0;
$select='';
$text='';
if($_POST){
    $allKaryawanPage=$kategoriDa->getCariKas($_POST['cboCari'], $_POST['txtCari']);
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
                    document.forms["fKas"].action="?page=KasKeuanganForm";
                    document.forms["fKas"].submit();
                    return true;
                }
            }
        </script>
    </head>
    <body>
    <form name="fKas" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">    
            <tr>
                <td width="839" colspan="9" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Keuangan | Kas </b></td>
            </tr>
            <tr>
            	<td>Cari 
            	  <select name="cboCari" id="cboCari">
                    <option value="blank" <?php if($select=='blank') echo 'selected=""'; ?>>- All -</option>
            	    <option value="id_kas" <?php if($select=='id_kas') echo 'selected=""'; ?>>Kode</option>
            	    <option value="nama_kas" <?php if($select=='nama_kas') echo 'selected=""'; ?>>Nama</option>
            	    <option value="jumlah" <?php if($select=='jumlah') echo 'selected=""'; ?>>Jumlah</option>
       	        </select>
            	  Kata Kunci
                  <input type="text" name="txtCari" id="txtCari" value="<?php echo $text;?>">
                      <input type="button" name="bCari" id="bCari" value="Cari" onClick="validasi();"></td>
            </tr>
            <tr>
              <td colspan="9"><a href="?page=KasKeuangan">Tambah Kas</a></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <th width="6%" >No</th>
                          <th width="16%" >Kode</th>
                          <th width="54%" >Nama</th>
                          <th width="24%" style="text-align: right;">Jumlah</th>
                        </tr>
                  
                  <?php
                      foreach ($allKaryawanPage as $value) {
                          $nomor++;
                          $id=$value->getKode();                   
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
                    <td><?PHP echo $nomor;?></td>
                    <td><a href="?page=KasKeuanganEdit&Kode=<?php echo $id;?>"><?PHP echo $value->getKode();?></a></td>
                    <td><?PHP echo $value->getNamaKas()?></td>                   
                    <td align="right">Rp <?PHP echo number_format($value->getJumlah());?></td>
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
                    echo "<a href='?page=KasKeuanganForm&hal=$list[$h]'>$h</a>";
                }              
               ?>
          </td>
      </tr>
    </table>
    </form>
    </body>
</html>