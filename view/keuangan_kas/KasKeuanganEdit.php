<?php
include_once './dao/KeuanganKasDao.php';
include_once './model/KeuanganKas.php';
$kas=NULL;
if($_GET){
    $dataKode =$_GET['Kode'];
    $kasDao=new KeuanganKasDao();
    $kas=$kasDao->getKas($dataKode);
}
?>
<! DOCTYPE html>
<html>
<head>
    <script>    
        function validasi(mode){
            var txtKode=document.getElementById("txtId").value;
            var txtNama=document.getElementById("txtNamaKas").value;
            var txtJumlah=document.getElementById("txtJumlah").value;
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                document.getElementById("txtId").focus();
            }else if(txtNama===""){
                alert("Text Nama kas harus diisi !");
                document.getElementById("txtNamaKas").focus();
            }else if(txtJumlah===""){
                alert("Text Jumlah kas harus diisi !");
                document.getElementById("txtJumlah").focus();
            }else{
                if(mode==="delete"){
                    if(confirm('Apakah anda yakin mau menghapus ?')){
                        document.forms["fPersonal"].action="?page=KeuanganKasAction&action=delete";
                        document.forms["fPersonal"].submit();
                        return true;
                    }
                }else if(mode==="update"){
                    document.forms["fPersonal"].action="?page=KeuanganKasAction&action=update";
                    document.forms["fPersonal"].submit();
                    return true;
                }
            }
        }
        
        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '')
              .replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
              prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
              sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
              dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
              s = '',
              toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                  .toFixed(prec);
              };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
              .split('.');
            if (s[0].length > 3) {
              s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '')
              .length < prec) {
              s[1] = s[1] || '';
              s[1] += new Array(prec - s[1].length + 1)
                .join('0');
            }
            return s.join(dec);
          }

       
      function numberFormat(){
           var jumlah=document.getElementById("txtJumlah").value;
           var perubahan=number_format(jumlah);
           document.getElementById('txtJumlah').value=perubahan;
      }
    </script>
</head>
<body>
<form id="fPersonal" name="fPersonal" method="post">
    <table width="62%" border="0" cellspacing="1" cellpadding="5" class="table-shadow">
    <tr>
        <td colspan="4" align="left" class="title-form"><img src="./images/form_add.png">&nbsp;<b>Mster | Input Kas Pelajaran</b></td>
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
          <input name="txtId" type="text" id="txtId" size="12" maxlength="10" value="<?php echo $kas->getKode(); ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Kas</td>
      <td>:</td>
      <td>
          <input name="txtNamaKas" type="text" id="txtNamaKas" size="50" maxlength="50" value="<?php echo $kas->getNamaKas(); ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Jumlah</td>
      <td>:</td>
      <td>
          <input name="txtJumlah" type="text" id="txtJumlah" size="50" maxlength="50" oninput="numberFormat();" value="<?php echo number_format($kas->getJumlah()) ?>"/></td>
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
