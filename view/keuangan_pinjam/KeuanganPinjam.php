<?php
include_once './dao/KeuanganKasDao.php';
include_once './dao/KeuanganPengKategoriDao.php';
$kode=buatKodeYear("keuangan_pinjam");
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
<head>
<script type="text/javascript">
    function popupwindow(url, title, w, h) {
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        return window.open(url, title, 'scrollbars=1,status=1, resizable=1, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }
    
    function popup(url){
        var w=950;
        var h=600;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var myWindow = window.open(url, "MsgWindow", "width=950, height=600, width="+w+", height="+h+", top="+top+", left="+left);
    }
    
    function valid(mode){
            var txtId=document.getElementById("txtId").value;
            var txtTanggalPjm=document.getElementById("txtTanggalPjm").value;
            var txtTanggalKem=document.getElementById("txtTanggalKem").value;
            var cboKas=document.getElementById("cboKas").value;
            var txtEmpId=document.getElementById("txtEmpId").value;
            var jumlah=document.getElementById("txtJumlah").value;
            
            if(txtId==""){
                alert("Kode masih kosong !");
                return false;
            }else if(txtTanggalPjm==""){
                alert("Tanggal masih kosong !");
                document.getElementById("txtTanggalPjm").focus();
                //return false;
            }else if(txtTanggalKem==""){
                alert("Tanggal masih kosong !");
                document.getElementById("txtTanggalKem").focus();
                //return false;
            }else if(cboKas=="blank"){
                alert("Kas masih kosong !");
                document.getElementById("cboKas").focus();
                //return false;
            }else if(txtEmpId==""){
                alert("Peminjam masih kosong !");
                document.getElementById("txtEmpId").focus();
                //return false;
            }else if(jumlah=="" || jumlah=="0"){
                alert("Jumlah masih kosong !");
                document.getElementById("txtJumlah").focus();
                //return false;
            }else{
                if(mode=='insert'){
                    document.forms["fPinjam"].action="?page=KeuanganPinjamAction&action=insert";
                    document.forms["fPinjam"].submit();
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
<form id="fPinjam" name="fPinjam" method="post" action="">
  <table  width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="6" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Keunagan | Peminjaman</b></td>
    </tr>
    <tr>
      <td width="50">&nbsp;</td>
      <td width="176">&nbsp;</td>
      <td width="3"></td>
      <td width="930">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kode Peminjaman </td>
      <td width="3">:</td>
      <td><input type="text" name="txtId" id="txtId" value="<?php echo $kode;?>" readonly=""/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tanggal Pinjam</td>
      <td width="3">:</td>
      <td>
          <?php
          $tglTransaksi=  isset($_POST['txtTanggalPjm']) ? $_POST['txtTanggalPjm'] : date('m/d/Y');;
          echo form_tanggal("txtTanggalPjm",$tglTransaksi); 
          ?>
          <!--<input type="text" name="txtTanggal" id="txtTanggal" value="<?php //echo $tanggl;?>" readonly=""/>--> &nbsp;&nbsp;format tanggal ( mm/dd/YYY )      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tanggal Kembali</td>
      <td width="3">:</td>
      <td>
          <?php
          $tglTransaksi=  isset($_POST['txtTanggalKem']) ? $_POST['txtTanggalKem'] : date('m/d/Y');;
          echo form_tanggal("txtTanggalKem",$tglTransaksi); 
          ?>
          <!--<input type="text" name="txtTanggal" id="txtTanggal" value="<?php //echo $tanggl;?>" readonly=""/>--> &nbsp;&nbsp;format tanggal ( mm/dd/YYY )      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kas</td>
      <td width="3">:</td>
      <td><select name="cboKas" id="cboKas">
             <option value="blank">- Pilih salah satu -</option>
            <?php
                foreach ($allKas as $valu){
              ?>
             <option value="<?php echo $valu->getKode() ?>">
                    <?php
                    echo $valu->getNamakas();
                    ?>
                 </option>
              <?php
                }
              ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Peminjam</td>
      <td>:</td>
      <td>
          <input type="text" name="txtEmpId" id="txtEmpId"value="" size="15" readonly="readonly" />
          <input type="text" name="txtNama" id="txtNama" value="" size="35" readonly="readonly" />
          <!--<input type="button" value="Cari" name="bAdd" onclick="popupwindow('./view/keuangan_pinjam/SearchPersonal.php','Cari Personal Data',950,600);"/>-->
          <input type="button" value="Cari" name="bAdd" onclick='popup("./view/keuangan_pinjam/SearchPersonal.php");'/>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Jumlah Pinjam</td>
      <td>:</td>
      <td>
          <input type="text" name="txtJumlah" id="txtJumlah" value="" size="20" oninput="numberFormat();"/>
      </td>
    </tr>
    
    
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"><input type="button" name="bSimpan" id="bSimpan" value="Simpan" onClick="valid('insert');"/>
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
</body>