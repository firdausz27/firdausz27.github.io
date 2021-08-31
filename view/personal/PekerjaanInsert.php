<?php
include_once './dao/PendidikanDao.php';
include_once './model/User.php';
$dataKode = buatKode("pekerjaan", "PK");

$pendidikan=new Pendidikan();
if(isset($_GET['personalId'])){
    $kode=$_GET['personalId'];
}

?>
<! DOCTYPE html>
<html>
<head>
    <script>    
        function valid(){
            var txtKode=document.getElementById("txtId").value;
            var txtNamaPekerjaan=document.getElementById("txtNamaPekerjaan").value;
            var cboKategoriPekerjaan=document.getElementById("cboKategoriPekerjaan").value;
            var txtAlamat=document.getElementById("txtAlamat").value;
            
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                return false;
            }
            else if(txtNamaPekerjaan==""){
                alert("Nama pekerjaan masih kosong !");
                document.getElementById("txtNamaPekerjaan").focus();
            }else if(cboKategoriPekerjaan==="blank"){
                alert("Kategori pekerjaan belum dipilih !");
                document.getElementById("cboKategoriPekerjaan").focus();
            }else if(txtAlamat==""){
                alert("Institusi belum di isi");
                document.getElementById("txtAlamat").focus();
            }else{
		document.forms["fEdu"].action="?page=PekerjaanAction&action=insert";
                document.forms["fEdu"].submit();
                return true;
            }
        }
       
    </script>
</head>
<body>
<form id="fEdu" name="fEdu" method="post" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Pekerjaan | Input Pekerjaan</b></td>
    </tr>
    <tr>
      <td width="58">&nbsp;</td>
      <td width="133">&nbsp;</td>
      <td width="4">&nbsp;</td>
      <td width="500">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kode&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtId" type="text" id="txtId" size="15" maxlength="15" value="<?php echo $dataKode; ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Pekerjaan&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td><input name="txtNamaPekerjaan" type="text" id="txtNamaPekerjaan" size="50" maxlength="100"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kategori Pekerjaan&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboKategoriPekerjaan" id="cboKategoriPekerjaan">
         <option value="blank">- Pilih Salah satu -</option>
         <option>Teknik</option>
         <option>Bangunan</option>
         <option>Keuangan</option>
         <option>Otomotif</option>
         <option>Niaga</option>
         <option>Pendidikan</option>
         <option>Lain-Lain</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Perusahaan</td>
      <td>:</td>
      <td><input name="txtNamaPerusahaan" type="text" id="txtNamaPerusahaan" size="50" maxlength="100"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Telepon Perusahaan</td>
      <td>:</td>
      <td>
          <input name="txtTeepon" type="text" id="txtTeepon" size="20" maxlength="15" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Alamat Perusahaan&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtAlamat" type="text" id="txtAlamat" size="50" maxlength="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Keterangan</td>
      <td>:</td>
      <td><textarea name="txtKeterangan" cols="50" rows="5" id="txtKeterangan" maxlength="225"></textarea></td>
    </tr>
    <input type="hidden" id="txtPersonalId" name='txtPersonalId' value="<?php echo $kode;?>"/>
    <tr>
        <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="3"><font color="red">*</font>&nbsp;Harus diisi</td>
    </tr>
    <tr>
      <td colspan="4"><hr width="90%" color="#ccc"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td ><input type="button" name="bEdit" id="bInsert" value="Simpan" onClick="valid();" />
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
