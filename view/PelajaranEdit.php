<?php
//$dataKode = buatKode("pelajaran", "PL");
include_once './dao/KategoriPelajaranDao.php';
include_once './dao/PelajaranDao.php';

$kategori=new KategoriPelajaranDao();
$allKategori = $kategori->getAllKategori();
$pelajaran=new Pelajaran();
if($_GET){
    $kode=$_GET['Kode'];
    $pelajarandao=new PelajaranDao();
    $pelajaran=$pelajarandao->getPelajaran($kode);
}
?>
<! DOCTYPE html>
<html>
<head>
    <script>    
        function validasi(mode){
            var txtKode=document.getElementById("txtId").value;
            var txtNama=document.getElementById("txtNamaPelajaran").value;
            var txtSks=document.getElementById("txtSks").value;
            var cboKategori=document.getElementById("cboKategori").value;
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                return false;
            }else if(txtNama===""){
                alert("Text Nama pelajaran Wajib Diisi !");
                return false;
            }else if(txtSks===""){
                alert("Text SKS Masih Kosong !");
                return false;
            }else if(cboKategori==="blank"){
                alert("Kategori belum dipilih !");
                return false;
            }else{
		if(mode==="delete"){
                    if(confirm('Apakah anda yakin mau menghapus ?')){
                        document.forms["fPelajaran"].action="?page=PelajranAction&action=delete";
                        document.forms["fPelajaran"].submit();
                        return true;
                    }
                }else if(mode==="update"){
                    document.forms["fPelajaran"].action="?page=PelajranAction&action=update";
                    document.forms["fPelajaran"].submit();
                    return true;
                }
            }
        }
    </script>
</head>
<body>
<form id="fPelajaran" name="fPelajaran" method="post">
    <table width="79%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><img src="./images/form_add.png">&nbsp;<b>Mster | Input Pelajaran</b></td>
    </tr>
    <tr>
      <td width="71">&nbsp;</td>
      <td width="188">&nbsp;</td>
      <td width="5">&nbsp;</td>
      <td width="651">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kode</td>
      <td>:</td>
      <td><label for="txtId"></label>
          <input name="txtId" type="text" id="txtId" size="12" maxlength="10" value="<?php echo $pelajaran->getIdPelajran(); ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Pelajaran</td>
      <td>:</td>
      <td><label for="txtNamaPelajaran"></label>
          <input name="txtNamaPelajaran" type="text" id="txtNamaPelajaran" size="50" maxlength="50" value="<?php echo $pelajaran->getNamaPelajaran(); ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Jumlah Jam</td>
      <td>:</td>
      <td>
          <input name="txtSks" type="number" id="txtSks" size="50" maxlength="10" value="<?php echo $pelajaran->getSks(); ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kategori Pelajaran</td>
      <td>:</td>
      <td><label for="txtNamaAkhir">
        <select name="cboKategori" id="cboKategori">
            <option value="blank">- Pilih Salah Satu -</option>
            <?php 
            foreach ($allKategori as $value) {
            ?>
                <option value="<?php echo $value->getKode(); ?> " <?php if($value->getKode()==$pelajaran->getKategoriPelajaran()) echo 'selected';?>> <?php echo $value->getNamaKategori(); ?></option>
            <?php
            }
            ?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td colspan="4"><hr width="90%" color="#ccc"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td ><input type="button" name="bEdit" id="bEdit" value="Edit" onClick="validasi('update');" />
         <input type="button" name="bDelete" id="bDelete" value="Delete" onClick="validasi('delete');" />
        <input type="reset" name="bReset" id="bReset" value="Reset" /></td>
    </tr>
   <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
