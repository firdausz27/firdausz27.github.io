<?php
$dataKode = buatKode("keuangan_peng_kategori", "KP");
?>
<! DOCTYPE html>
<html>
<head>
    <script>    
        function validasi(){
            var txtKode=document.getElementById("txtId").value;
            var txtNama=document.getElementById("txtNamaKategori").value;
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                return false;
            }else if(txtNama===""){
                alert("Text Nama kategori harus diisi !");
                return false;
            }else{
                document.forms["fPersonal"].submit();
                return true;
            }
        }
    </script>
</head>
<body>
<form id="fPersonal" name="fPersonal" method="post"  action="?page=KeuanganPengKategoriAction&action=insert">
    <table width="62%" border="0" cellspacing="1" cellpadding="5" class="table-shadow">
    <tr>
        <td colspan="4" align="left" class="title-form"><img src="./images/form_add.png">&nbsp;<b>Keuangan | Input Kategori Keuangan</b></td>
    </tr>
    <tr>
      <td width="70">&nbsp;</td>
      <td width="122">&nbsp;</td>
      <td width="4">&nbsp;</td>
      <td width="515">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kode</td>
      <td>:</td>
      <td>
          <input name="txtId" type="text" id="txtId" size="12" maxlength="10" value="<?php echo $dataKode; ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Kategori</td>
      <td>:</td>
      <td>
      <input name="txtNamaKategori" type="text" id="txtNamaKategori" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Keterangan</td>
      <td>:</td>
      <td>
      <input name="txtKeterangan" type="text" id="txtKeterangan" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td colspan="4"><hr width="90%" color="#ccc"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td ><input type="button" name="bSimpan" id="bSimpan" value="Simpan" onClick="validasi();" />
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
