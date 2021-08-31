<?php
include_once './dao/TampilFormDao.php';
include_once './model/TampilForm.php';
include_once './library/inc.library.php';
$dataKode = buatKode("tampil_form", "");
$tampil=new TampilForm();
if($_POST){
    $tampil->setKode(isset($_POST['txtKide']) ? $_POST['txtKide'] : '');
    $tampil->setUrl(isset($_POST['txtUrl']) ? $_POST['txtUrl'] : '');
    $tampil->setNamaForm(isset($_POST['txtNamaForm']) ? $_POST['txtNamaForm'] : '');
    $tampil->setMenu(isset($_POST['txtMenu']) ? $_POST['txtMenu'] : '');
    $tampil->setModul(isset($_POST['txtModul']) ? $_POST['txtModul'] : '');
    $fileDao=new TampilFormDao();
    $insert = $fileDao->insert($tampil);
    if($insert){
        echo "<meta http-equiv='refresh' content='0; url=?page=BukaFile'>";
        //$pesan=1;
    }
}
?>
<form id="form1" name="form1" method="post" action="?page=insertFile">
  <table width="750" border="0" cellspacing="1" cellpadding="2">
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="36">&nbsp;</td>
      <td width="141">&nbsp;</td>
      <td width="3">&nbsp;</td>
      <td width="549">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kode</td>
      <td>:</td>
      <td><input type="text" name="txtKide" id="txtKide" value="<?php echo $dataKode;?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>URL</td>
      <td>:</td>
      <td><input name="txtUrl" type="text" id="txtUrl" size="50" maxlength="500" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Form</td>
      <td>:</td>
      <td><input name="txtNamaForm" type="text" id="txtNamaForm" size="30" maxlength="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Digunakan Di Menu</td>
      <td>:</td>
      <td><input name="txtMenu" type="text" id="txtMenu" size="50" maxlength="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Modul</td>
      <td>:</td>
      <td><input name="txtModul" type="text" id="txtModul" size="50" maxlength="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="bSave" id="bSave" value="Submit" />
      <input type="reset" name="bReset" id="bReset" value="Reset" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
