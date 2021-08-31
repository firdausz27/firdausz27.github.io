<?php
include_once './dao/NegaraDao.php';
$negara=NULL;
if($_GET){
    $dataKode =$_GET['Kode'];
    $negaraDao=new NegaraDao();
    $negara=$negaraDao->getNegara($dataKode);
}
?>
<! DOCTYPE html>
<html>
<head>
    <script>    
        function validasi(mode){
            var txtKode=document.getElementById("txtId").value;
            var txtNama=document.getElementById("txtNama").value;
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                return false;
            }else if(txtNama===""){
                alert("Text Nama negara harus diisi !");
                return false;
            }else{
                if(mode==="delete"){
                    if(confirm('Apakah anda yakin mau menghapus ?')){
                        document.forms["fNegara"].action="?page=NegaraAction&action=delete";
                        document.forms["fNegara"].submit();
                        return true;
                    }
                }else if(mode==="update"){
                    document.forms["fNegara"].action="?page=NegaraAction&action=update";
                    document.forms["fNegara"].submit();
                    return true;
                }
            }
        }
    </script>
</head>
<body>
<form id="fNegara" name="fNegara" method="post">
    <table width="62%" border="0" cellspacing="1" cellpadding="5" class="table-shadow">
    <tr>
        <td colspan="4" align="left" class="title-form"><img src="./images/form_add.png">&nbsp;<b>Settng | Tabel Referensi | Edit Negara</b></td>
    </tr>
    <tr>
      <td width="70">&nbsp;</td>
      <td width="122">&nbsp;</td>
      <td width="4">&nbsp;</td>
      <td width="515">&nbsp;</td>
    </tr>
    <tr>
      <td>
          <input name="txtId" type="hidden" id="txtId" size="12" maxlength="10" value="<?php echo $negara->getKode(); ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Negara</td>
      <td>:</td>
      <td>
          <input name="txtNama" type="text" id="txtNama" size="50" maxlength="50" value="<?php echo $negara->getNama(); ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Keterangan</td>
      <td>:</td>
      <td>
          <input name="txtKeterangan" type="text" id="txtKeterangan" size="50" maxlength="50" value="<?php echo $negara->getKeterangan() ?>"/></td>
    </tr>
    <tr>
      <td colspan="4"><hr width="90%" color="#ccc"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td ><input type="button" name="bEdit" id="bEdit" value="Edit" onClick="validasi('update');" />
          <input type="button" name="bDelete" id="bDelete" value="Delete" onClick=" validasi('delete');" />
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
