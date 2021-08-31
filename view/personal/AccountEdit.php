<?php
include_once './dao/PersonalDao.php';
include_once './model/User.php';
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
            var txtUsername=document.getElementById("txtUsername").value;
            var txtPassword=document.getElementById("txtPassword").value;
            var txtUlangPwd=document.getElementById("txtUlangPwd").value;
            
           
            var txtPertanyaan=document.getElementById("txtPertanyaan").value;
            var txtJawaban=document.getElementById("txtJawaban").value;
            
            if(txtUsername==""){
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
            }else{
		if(mode==="delete"){
                    if(confirm('Apakah anda yakin mau menghapus ?')){
                        document.forms["fPersonal"].action="?page=PersonalAction&action=delete";
                        document.forms["fPersonal"].submit();
                        return true;
                    }
                }else if(mode==="update"){
                    document.forms["fPersonal"].action="?page=UserAction&action=update";
                    document.forms["fPersonal"].submit();
                    return true;
                }
            }
        }
    </script>
</head>
<body>
<form id="fPersonal" name="fPersonal" method="post" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="1" cellpadding="5"  class="table-shadow">
    <tr>
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Mster | Edit Account</b></td>
    </tr>
    <tr>
      <td width="58">&nbsp;</td>
      <td width="133">&nbsp;</td>
      <td width="4">&nbsp;</td>
      <td width="500">&nbsp;</td>
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
    <!--<tr>
      <td>&nbsp;</td>
      <td>Level&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboLevel" id="cboLevel">
        <option value="blank">- Kosong -</option>
        <option value="Admin" <?php //if($user->getLevel()=="Admin") echo 'selected=""';?>>Admin</option>
        <option value="Kepala Sekolah" <?php //if($user->getLevel()=="Kepala Sekolah") echo 'selected=""';?>>Kepala Sekolah</option>
        <option value="Guru" <?php //if($user->getLevel()=="Guru") echo 'selected=""';?>>Guru</option>
        <option value="Siswa" <?php //if($user->getLevel()=="Siswa") echo 'selected=""';?>>Siswa</option>
      </select></td>
    </tr>-->
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
        <input type="reset" name="bReset" id="bReset" value="Reset" /></td>
    </tr>
   <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <input type="hidden" name="txtIdUser" id="txtIdUser" value="<?php echo $user->getUserId();?>"/>
    <input type="hidden" name="txtIdPersonal" id="txtIdPersonal" value="<?php echo $user->getPersonalId();?>"/>
  </table>
</form>
</body>
</html>
