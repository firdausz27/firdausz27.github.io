<?php
//$dataKode = buatKode("ruangan", "R");
include_once './dao/RuanganDao.php';
$ruangan=NULL;
if($_GET){
    $dataKode =$_GET['Kode'];
    $ruanganDao=new RuanganDao();
    $ruangan=$ruanganDao->getRuangan($dataKode);
}
?>
<! DOCTYPE html>
<html>
<head>
    <script>    
        function validasi(mode){
            var txtKode=document.getElementById("txtId").value;
            var txtNama=document.getElementById("txtNamaRuangan").value;
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                return false;
            }else if(txtNama===""){
                alert("Text Nama ruangan Wajib Diisi !");
                return false;
            }else{
		if(mode==="delete"){
                    if(confirm('Apakah anda yakin mau menghapus ?')){
                        document.forms["fPersonal"].action="?page=RuaganAction&action=delete";
                        document.forms["fPersonal"].submit();
                        return true;
                    }
                }else if(mode==="update"){
                    document.forms["fPersonal"].action="?page=RuaganAction&action=update";
                    document.forms["fPersonal"].submit();
                    return true;
                }
            }
        }
    </script>
</head>
<body>
<form id="fPersonal" name="fPersonal" method="post">
    <table width="79%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><img src="./images/form_add.png">&nbsp;<b>Mster | Input Ruangan</b></td>
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
          <input name="txtId" type="text" id="txtId" size="12" maxlength="10" value="<?php echo $ruangan->getRunaganId(); ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Ruangan</td>
      <td>:</td>
      <td><label for="txtNamaRuangan"></label>
          <input name="txtNamaRuangan" type="text" id="txtNamaRuangan" size="50" maxlength="50" value="<?php echo $ruangan->getNama(); ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Keterangan</td>
      <td>:</td>
      <td>
          <input name="txtKeterangan" type="text" id="txtKeterangan" size="50" maxlength="10" value="<?php echo $ruangan->getKeterangan(); ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
