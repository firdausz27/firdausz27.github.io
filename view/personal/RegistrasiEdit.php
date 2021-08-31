<?php
include_once './dao/PersonalDao.php';
include_once './model/User.php';
include_once './dao/PropinsiDao.php';
//$tglTransaksi=  isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('d-m-y');
//$dataKode = buatKode("personal", "PS");
//$buatKode=  buatKode("user", "U");
$personal=new Personal();
$user=new User();
if($_GET){
    $kode=$_GET['Kode'];
    $personalDao=new PersonalDao();
    $personal = $personalDao->getPersonal($kode);
    $user = $personalDao->getUser($kode);
}
?>
<! DOCTYPE html>
<html>
<head>
    <script>    
        function validasi(mode){
            var txtKode=document.getElementById("txtId").value;
            var txtNIS=document.getElementById("txtNIS").value;
            var txtNamaAwal=document.getElementById("txtNamaAwal").value;
            var txtTempatLahir=document.getElementById("txtTempatLahir").value;
            var txtTglLahir=document.getElementById("txtTglLahir").value;
            var txtTelepon=document.getElementById("txtTelepon").value;
            var txtAlamat=document.getElementById("txtAlamat").value;
            var txtPropinsi=document.getElementById("txtPropinsi").value;
            var txtNegara=document.getElementById("txtNegara").value;
            var cboEmail=document.getElementById("cboEmail").value;
            var tglGabung=document.getElementById('tglGabung').value;
            var txtUsername=document.getElementById("txtUsername").value;
            var txtPassword=document.getElementById("txtPassword").value;
            var txtUlangPwd=document.getElementById("txtUlangPwd").value;
            var txtPertanyaan=document.getElementById("txtPertanyaan").value;
            var txtJawaban=document.getElementById("txtJawaban").value;
            var cboLevel=document.getElementById("cboLevel").value;
            
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                return false;
            }
            else if(txtNIS==""){
                alert("Text NIS Diisi !");
                document.getElementById("txtNIS").focus();
            }else if(txtNamaAwal===""){
                alert("Nama Masih Kosong !");
                document.getElementById("txtNamaAwal").focus();
                
            }else if(txtTempatLahir===""){
                alert("Tempat Lahir Masih Kosong !");
                document.getElementById("txtTempatLahir").focus();
            }else if(isValidDate(txtTglLahir)==false){
                alert("Tanggal lahir tidak valid");
                document.getElementById("txtTglLahir").focus();
            }else if(isNaN(txtTelepon)===true){
                alert("Text Telpon bukan angka !");
                document.getElementById("txtTelepon").focus();
            }else if(txtAlamat===""){
                alert("Alamat masih kosong !");
                document.getElementById("txtAlamat").focus();
            }else if(txtPropinsi===""){
                alert("Propinsi Masih kosong !");
                document.getElementById("txtPropinsi").focus();
            }else if(txtNegara===""){
                alert("Negara masih kosong !");
                document.getElementById("txtNegara").focus();
            }else if(cboEmail=="blank"){
                alert("Cbo Personal type belum dipilih !");
                document.getElementById("cboEmail").focus();
            }else if(isValidDate(tglGabung)==false){
                alert("Tanggal bergabung tidak valid");
                document.getElementById("tglGabung").focus();
            }else if(txtUsername==""){
                alert("Username masih kosong !");
                document.getElementById("txtUsername").focus();
            }else if(txtPassword==""){
                alert("Password masih kosong !");
                document.getElementById("txtPassword").focus();
            }else if(txtPassword.length<4){
                alert("Password kurang dari 4 karakter !");
                document.getElementById("txtPassword").focus();
            }else if(txtUlangPwd==""){
                alert("Ulangi password masih kosong !");
                document.getElementById("txtUlangPwd").focus();
            }else if(txtUlangPwd != txtPassword){
                alert("Ulangi password tidak sama !");
                document.getElementById("txtUlangPwd").focus();
            }else if(txtPertanyaan==""){
                alert("Pertanyaa ketika lupa password masih kosong !");
                document.getElementById("txtPertanyaan").focus();
            }else if(txtJawaban==""){
                alert("jawaban pertanyaan masih kosong !");
                document.getElementById("txtJawaban").focus();
            }else if(cboLevel=="blank"){
                alert("Level belum dipilih !");
                document.getElementById("cboLevel").focus();
            }else{
		if(mode==="delete"){
                    if(confirm('Apakah anda yakin mau menghapus ?')){
                        document.forms["fPersonal"].action="?page=PersonalAction&action=delete";
                        document.forms["fPersonal"].submit();
                        return true;
                    }
                }else if(mode==="update"){
                    document.forms["fPersonal"].action="?page=PersonalAction&action=update";
                    document.forms["fPersonal"].submit();
                    return true;
                }
            }
        }
       
        $(function() {
                $('#tglGabung').datepick();
                $('#txtTglLahir').datepick();
        });
        
    </script>
</head>
<body>
<form id="fPersonal" name="fPersonal" method="post" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><img src="./images/form_add.png">&nbsp;<b>Mster | Input Data Pribadi</b></td>
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
          <input name="txtId" type="text" id="txtId" size="12" maxlength="10" value="<?php echo $personal->getIdPersonal(); ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>NIS&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtNIS" type="text" id="txtNIS" size="50" maxlength="50" value="<?php echo $personal->getNis();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Awal&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtNamaAwal" type="text" id="txtNamaAwal" size="50" maxlength="50" value="<?php echo $personal->getNamaAwal();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Tengah</td>
      <td>:</td>
      <td>
          <input name="txtNamaTengah" type="text" id="txtNamaTengah" size="50" maxlength="50" value="<?php echo $personal->getNamaTengah();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Akhir</td>
      <td>:</td>
      <td>
          <input name="txtNamaAkhir" type="text" id="txtNamaAkhir" size="50" maxlength="50" value="<?php echo $personal->getNamaAkhir();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tempat Lahir&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtTempatLahir" type="text" id="txtTempatLahir" size="50" maxlength="50" value="<?php echo $personal->getTempatLahir();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tanggal Lahir&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <?php
          $date=new DateTime($personal->getTglLahir());
          ?>
          <input type="text" id="txtTglLahir" name="txtTglLahir" size="20" maxlength="20" value="<?php echo $date->format("m/d/Y");?>"/>&nbsp; format ( mm/dd/yyyy )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Telepon</td>
      <td>:</td>
      <td>
          <input name="txtTelepon" type="text" id="txtTelepon" size="20" maxlength="15" value="<?php echo $personal->getTelepon();?>"/>&nbsp; Masukan angka</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Alamat&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtAlamat" type="text" id="txtAlamat" size="50" maxlength="100" value="<?php echo $personal->getAlamat();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kota</td>
      <td>:</td>
      <td><input name="txtKota" type="text" id="txtKota" size="50" maxlength="100" value="<?php echo $personal->getKota();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Propinsi&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtPropinsi" type="text" id="txtPropinsi" size="50" maxlength="100" value="<?php echo $personal->getPropinsi();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Negara&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtNegara" type="text" id="txtNegara" size="50" maxlength="50" value="<?php echo $personal->getNegara();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Email&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td><!--<select name="cboEmail" id="cboEmail">
              <option value="blank">- Kosong -</option>
              <option value="Siswa" <?php //if($personal->getEmail()=="Siswa") echo "selected=''";?> >Siswa</option>
              <option value="Guru" <?php //if($personal->getEmail()=="Guru") echo "selected=''";?>>Guru</option>
           </select>-->
          <input type="text" name="cboEmail" id="cboEmail" value="<?php echo $personal->getEmail();?>" />
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tanggal Bergabung&nbsp;<font color="red">*</font></td>
      <td>:</td>
        <?php
        $dateGabung=new DateTime($personal->getTglGabung());
        ?>
      <td><input type="text" id="tglGabung" name="tglGabung" value="<?php echo $dateGabung->format("m/d/Y");?>"/>&nbsp; format ( mm/dd/yyyy )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Foto</td>
      <td>:</td>
      <td><input type="file" name="txtGamabr" id="txtGamabr"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>username&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td><label for="txtPropinsi"></label>
          <input name="txtUsername" type="text" id="txtUsername" size="50" maxlength="100" value="<?php echo $user->getUsername();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>password&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtPassword" type="password" id="txtPassword" size="20" maxlength="50" /> &nbsp;Minimal 4 Karakter</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Ulang password&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtUlangPwd" type="password" id="txtUlangPwd" size="20" maxlength="50" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Pertanyaan Lupa&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtPertanyaan" type="text" id="txtPertanyaan" size="50" maxlength="50" value="<?php echo $user->getPertanyaan();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Jawaban&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtJawaban" type="text" id="txtJawaban" size="50" maxlength="50" value="<?php echo $user->getJawaban();?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Level&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboLevel" id="cboLevel">
        <option value="blank">- Kosong -</option>
        <option value="Admin" <?php if($user->getLevel()=="Admin") echo 'selected=""';?>>Admin</option>
        <option value="Kepala Sekolah" <?php if($user->getLevel()=="Kepala Sekolah") echo 'selected=""';?>>Kepala Sekolah</option>
        <option value="Guru" <?php if($user->getLevel()=="Guru") echo 'selected=""';?>>Guru</option>
        <option value="Siswa" <?php if($user->getLevel()=="Siswa") echo 'selected=""';?>>Siswa</option>
      </select></td>
    </tr>
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
      <td ><input type="button" name="bEdit" id="bEdit" value="Ubah" onClick="validasi('update');" />
          <input type="button" name="bDelete" id="bDelete" value="Hapus" onClick="validasi('delete');" />
        <input type="reset" name="bReset" id="bReset" value="Reset" /></td>
    </tr>
   <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <input type="hidden" name="txtIdUser" id="txtIdUser" value="<?php echo $user->getUserId();?>"/>
  </table>
</form>
</body>
</html>
