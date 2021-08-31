<?php
include_once './dao/InstitusiDao.php';

$institusiDao=new InstitusiDao();
$allInstitusi = $institusiDao->getAllInstitusi();
$institusi=new Institusi();
foreach ($allInstitusi as $value){
    $institusi=$value;
}
?>
<! DOCTYPE html>
<html>
<head>
    <script type="text/javascript">
        function valid(mode){
            var txtNama=document.getElementById("txtNama").value;
            var txtTelepon=document.getElementById("txtTelepon").value;
            var txtAlamat=document.getElementById("txtAlamat").value;
            var txtVisi=document.getElementById("txtVisi").value;
            var txtMisi=document.getElementById("txtMisi").value;

            
            if(txtNama===""){
                alert("Nama institusi Masih Kosong !");
                document.getElementById("txtNama").focus();
            }
            else if(txtTelepon==""){
                alert("Telepon masih dipilih !");
                document.getElementById("txtTelepon").focus();
            }else if(txtAlamat==""){
                alert("Alamat masih kosong !");
                document.getElementById("txtAlamat").focus();           
            }else if(txtVisi==""){
                alert("Visi masih kosong !");
                document.getElementById("txtVisi").focus();
            }else if(txtMisi ==""){
                alert("Misi masih kosong !");
                document.getElementById("txtMisi").focus();
            }else{
                if(mode=="insert"){
                    document.forms["fEdu"].action="?page=InstitusiAction&action=insert";
                    document.forms["fEdu"].submit();
                    return true;
                }else{
                    document.forms["fEdu"].action="?page=InstitusiAction&action=update";
                    document.forms["fEdu"].submit();
                    return true;
                }
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
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Setting | Institusi</b></td>
    </tr>
    <tr>
      <td width="67">&nbsp;</td>
      <td width="129">&nbsp;</td>
      <td width="3">&nbsp;</td>
      <td width="775">&nbsp;</td>
    </tr>
    <input type="hidden" name="txtId" value="<?php echo $institusi->getKode();?>"/>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Lembaga <font color="red">*</font></td>
      <td>:</td>
      <td><input name="txtNama" type="text" id="txtNama" size="50" maxlength="100" value="<?php echo $institusi->getNamaInstitusi();?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Telepon<font color="red">*</font></td>
      <td>:</td>
      <td><input name="txtTelepon" type="number" id="txtTelepon" size="25" maxlength="15" value="<?php echo $institusi->getTeleon();?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Alamat<font color="red">*</font></td>
      <td>:</td>
      <td><textarea name="txtAlamat" cols="50" rows="5" id="txtAlamat" maxlength="250"><?php echo $institusi->getAlamat();?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Visi<font color="red">*</font></td>
      <td>:</td>
      <td><textarea name="txtVisi" cols="50" rows="5" id="txtVisi" maxlength="250"><?php echo $institusi->getVisi();?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Misi<font color="red">*</font></td>
      <td>:</td>
      <td><textarea name="txtMisi" cols="50" rows="5" id="txtMisi" maxlength="250"><?php echo $institusi->getMisi();?></textarea></td>
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
      <td ><input type="button" name="bEdit" id="bInsert" value="Simpan" onClick="<?php if($allInstitusi==NULL){echo "valid('insert');";}else{echo "valid('update');";}?>" />
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
