<?php
include_once './dao/KeuanganKasDao.php';
include_once './dao/KeuanganPengKategoriDao.php';
$kode=buatKodeYear("keuangan_kembali");
$tanggl= date('m/d/Y');
//ini untuk meload kategori dari setoran
$kategoriDao=new KeuanganPengKategoriDao();
$allKategori = $kategoriDao->getAllKategori();
//ini untuk meload jenis kas
$kasDao=new KeuanganKasDao();
$allKas = $kasDao->getAllKas();


$tanggal=  date("m/d/Y");
$nomor=0;
$kajianByJadual=NULL;

?>
<script type="text/javascript">
    function popupwindow(url, title, w, h) {
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        return window.open(url, title, 'scrollbars=1,status=1, resizable=1, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }
    
    function popup1(url){
        var w=950;
        var h=600;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var myWindow = window.open(url, "MsgWindow", "width=950, height=600, width="+w+", height="+h+", top="+top+", left="+left);
    }
    
    function validK(mode){
            var txtId=document.getElementById("txtIdK").value;
            var txtTanggalK=document.getElementById("txtTanggalK").value;
            var txtPinjamId=document.getElementById("txtPinjamId").value;
            var txtJumlahK=document.getElementById("txtJumlahK").value;
            
            if(txtId==""){
                alert("Kode masih kosong !");
                return false;
            }else if(txtTanggalK==""){
                alert("Tanggal masih kosong !");
                document.getElementById("txtTanggalK").focus();
                //return false;
            }else if(txtPinjamId==""){
                alert("Pinjaman masih kosong !");
                document.getElementById("txtPinjamId").focus();
                //return false;
            }else if(txtJumlahK==""){
                alert("Kategori masih kosong !");
                document.getElementById("txtJumlahK").focus();
                //return false;
            }else{
                if(mode=='insert'){
                    document.forms["fKembali"].action="?page=KeuanganKembaliAction&action=insert";
                    document.forms["fKembali"].submit();
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

       
      function numberFormatK(){
           var jumlah=document.getElementById("txtJumlahK").value;
           var perubahan=number_format(jumlah);
           document.getElementById('txtJumlahK').value=perubahan;
      }
   
</script>
<form id="fKembali" name="fKembali" method="post" action="">
  <table  width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="6" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Keunagan | Kembali</b></td>
    </tr>
    <tr>
      <td width="50">&nbsp;</td>
      <td width="176">&nbsp;</td>
      <td width="3"></td>
      <td width="930">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kode Kembali </td>
      <td width="3">:</td>
      <td><input type="text" name="txtIdK" id="txtIdK" value="<?php echo $kode;?>" readonly=""/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tanggal Kembali</td>
      <td width="3">:</td>
      <td>
          <?php
          $tglTransaksi=  isset($_POST['txtTanggalK']) ? $_POST['txtTanggalK'] : date('m/d/Y');;
          echo form_tanggal("txtTanggalK",$tglTransaksi); 
          ?>
          <!--<input type="text" name="txtTanggalK" id="txtTanggalK" value="<?php echo $tanggl;?>" readonly=""/>--> &nbsp;&nbsp;format tanggal ( mm/dd/YYY )      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Pinjaman</td>
      <td>:</td>
      <td>
          <input type="text" name="txtPinjamId" id="txtPinjamId" size="15" readonly="readonly" />
          <input type="text" name="txtNamaK" id="txtNamaK" size="35" readonly="readonly" />
          <input type="button" value="Cari" name="bAdd" onclick='popup1("./view/keuangan_pinjam/SearchPinjaman.php");'/>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Total Pinjam</td>
      <td>:</td>
      <td>
          <input type="text" disabled="" id="totPinjam">
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Sisa Utang</td>
      <td>:</td>
      <td>
          <input type="text" disabled="" id="sisa">
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Pinjam Terbayar</td>
      <td>:</td>
      <td>
          <input type="text" disabled="" id="credit">
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Jumlah Bayar</td>
      <td>:</td>
      <td>
          <input type="text" name="txtJumlahK" id="txtJumlahK" size="35" oninput="numberFormatK()"/>
      </td>
    </tr>
    
    
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"><input type="button" name="bSimpan" id="bSimpan" value="Simpan" onClick="validK('insert');"/>
          <input type="reset" name="bReset" id="bReset" value="Reset" />      </td>
      <td width="1">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><hr width="95%" color="#ccc"></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
