<?php
include_once './dao/PendidikanDao.php';
include_once './model/User.php';
include_once './dao/PropinsiDao.php'; 
include_once './dao/NegaraDao.php';
//untuk mendapatkan list Negara
$negaraDao=new NegaraDao();
$allNegara = $negaraDao->getAllNegara();
//untuk mendapatkan propinsi
$propinsiDao=new PropinsiDao();
$allPropinsi = $propinsiDao->getAllPropinsi();
$dataKode = buatKode("family", "F");
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
            var txtNama=document.getElementById("txtNama").value;
            var txtAlamat=document.getElementById("txtAlamat").value;
            var txtNegara=document.getElementById("txtNegara").value;
            var txtHubungan=document.getElementById("txtHubungan").value;
            var txtPropinsi=document.getElementById("txtPropinsi").value;

            
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                return false;
            }
            else if(txtNama===""){
                alert("Nama Masih kosong !");
                document.getElementById("txtNama").focus();
            }else if(txtAlamat===""){
                alert("Alamat masih kosong !");
                document.getElementById("txtAlamat").focus();           
            }else if(txtPropinsi==""){
                alert("Propinsi masih kosong !");
                document.getElementById("txtAlamat").focus();           
            }else if(txtNegara===""){
                alert("Negara masih kosong !");
                document.getElementById("txtNegara").focus();
            }else if(txtHubungan==""){
                alert("Hubungan keluarga belum di isi");
                document.getElementById("txtHubungan").focus();
            }else{
		document.forms["fFamily"].action="?page=FamilyAction&action=insert";
                document.forms["fFamily"].submit();
                return true;
            }
        }
    </script>
</head>
<body>
<form id="fFamily" name="fFamily" method="post" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Mster | Input Keluarga</b></td>
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
      <td>Nama<font color="red">*</font></td>
      <td>:</td>
      <td><input name="txtNama" type="text" id="txtNama" size="50" maxlength="100"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Telepon&nbsp;</td>
      <td>:</td>
      <td><input name="txtTelepon" type="text" id="txtTelepon" size="20" maxlength="15"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Alamat<font color="red">*</font></td>
      <td>:</td>
      <td><input name="txtAlamat" type="text" id="txtAlamat" size="50" maxlength="100"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kota</td>
      <td>:</td>
      <td>
          <input name="txtKota" type="text" id="txtKota" size="50" maxlength="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Propinsi</td>
      <td>:</td>
      <td>
          <!--<input name="txtPropinsi" type="text" id="txtPropinsi" size="50" maxlength="100" />-->
           <select name="txtPropinsi" id="txtPropinsi" style="width: 200px;">
              <option value="">- Pilih Salah satu -</option>
              <?php 
                foreach ($allPropinsi as $value){
                ?>
              <option value="<?php echo $value->getKode() ?>" > <?php echo $value->getNama()?></option>
                <?php
                }
              ?>
          </select>  
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Negara&nbsp;&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <!--<input name="txtNegara" type="text" id="txtNegara" size="50" maxlength="100">-->
          <select name="txtNegara" id="txtNegara" style="width: 200px;">
              <option value="">- Pilih Salah satu -</option>
              <?php 
                foreach ($allNegara as $value){
                ?>
              <option value="<?php echo $value->getKode()?>" ><?php echo $value->getNama()?></option>
                <?php
                }
              ?>
          </select> 
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Hubungan<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtHubungan" type="text" id="txtHubungan" size="50" maxlength="50" />
          &nbsp;</td>
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
