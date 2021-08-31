<?php
include_once './dao/KeuanganKasDao.php';
include_once './dao/KeuanganPengKategoriDao.php';
$kode=buatKodeYear("keuangan_pengeluaran");
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
    
    function valid(mode){
            var txtId=document.getElementById("txtId").value;
            var txtTanggal=document.getElementById("txtTanggal").value;
            var cboPengajar=document.getElementById("cboKas").value;
            var cboKategori=document.getElementById("cboKategori").value;
            var record=document.getElementById("jumlah").value;
            var table = document.getElementById("tDetail");
            var rowCount=table.rows.length;
            
            if(txtId==""){
                alert("Kode masih kosong !");
                return false;
            }if(txtTanggal==""){
                alert("Tanggal masih kosong !");
                return false;
            }if(cboPengajar=="blank"){
                alert("Kas masih kosong !");
                return false;
            }if(cboKategori=="blank"){
                alert("Kategori masih kosong !");
                return false;
            }else{
                var hasil=false;
                for(i=1;i<=rowCount;i++){
                        if(document.getElementById("txtNama_"+i) && document.getElementById("txtJumlah_"+i)){
                            var kode=document.getElementById("txtNama_"+i).value;
                            var jumlah=document.getElementById("txtJumlah_"+i).value;
                                if(kode==""){
                                    alert("Nama pengeluaran masih kosong !");
                                    document.getElementById("txtNama_"+i).focus();
                                    return false;
                                }else if(jumlah==""){
                                    alert("Jumlah masih kosong !");
                                    document.getElementById("txtJumlah_"+i).focus();
                                    return false;
                                }else{
                                    hasil= true;
                                }
                            }
               }
                if(hasil==true){
                    if(mode=='insert'){
                        document.forms["form1"].action="?page=KeuanganPengeluaranAction&action=insert";
                        document.forms["form1"].submit();
                        return true;
                    }
                }
            }
        }
        
   
   function myCreateFunction() {
        var table = document.getElementById("tDetail");
        var rowCount=table.rows.length;
        document.getElementById("jumlah").value=rowCount;
        var row = table.insertRow(rowCount);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        cell1.innerHTML = rowCount;
        cell2.innerHTML = "<input type='text' name='txtNama_"+rowCount+"' id='txtNama_"+rowCount+"' size='55'/>";
        cell3.innerHTML = "<input type='text' name='txtJumlah_"+rowCount+"' id='txtJumlah_"+rowCount+"' oninput='numberFormat("+rowCount+");'/>";
        cell4.innerHTML = "<input type='text' name='ket_"+rowCount+"' id='ket_"+rowCount+"' size='50' maxlength='100'/>";
        
      
   }
   function klik(no){
       document.getElementById("add_"+no).addEventListener("click", popupwindow("./view/keuangan_pengeluaran/SearchPersonal.php?no="+no,"Cari Personal Data",950,600));
   }
   
    function myDeleteFunction() {
        var rowCount=document.getElementById("tDetail").rows.length;
        var isi=document.getElementById("jumlah").value;
        if(rowCount>2){
            document.getElementById("tDetail").deleteRow(rowCount-1);
            document.getElementById("jumlah").value=isi-1;
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

       
      function numberFormat(no){
           var jumlah=document.getElementById("txtJumlah_"+no).value;
           var perubahan=number_format(jumlah);
           document.getElementById('txtJumlah_'+no).value=perubahan;
      }
</script>
<form id="form1" name="form1" method="post" action="">
  <table  width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="5" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Keunagan | Pengeluaran</b></td>
    </tr>
    <tr>
      <td width="50">&nbsp;</td>
      <td width="176">&nbsp;</td>
      <td width="3"></td>
      <td width="930">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Id Pengeluaran </td>
      <td width="3">:</td>
      <td><input type="text" name="txtId" id="txtId" value="<?php echo $kode;?>" readonly=""/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tanggal</td>
      <td width="3">:</td>
      <td>
          <?php
          $tglTransaksi=  isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('m/d/Y');;
          echo form_tanggal("txtTanggal",$tglTransaksi); 
          ?>
          <!--<input type="text" name="txtTanggal" id="txtTanggal" value="<?php echo $tanggl;?>" readonly=""/>--> &nbsp;&nbsp;format tanggal ( mm/dd/YYY )      </td>
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
      <td>Kategori</td>
      <td>&nbsp;</td>
      <td><select name="cboKategori" id="cboKategori">
              <option value="blank">- Pilih Salah Satu -</option>
        <?php
            foreach ($allKategori as $value){
                echo '<option value="'.$value->getKode().'">'.$value->getNamaKategori().' ( '.$value->getKode().') </option>';
            }
        ?>
      </select></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><a href="#"><label onclick="myCreateFunction();">Tambah Baris</label></a> | <a href="#"><label onclick="myDeleteFunction();">Hapus Baris </label></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">
          <table width="100%" border="0" cellspacing="1" cellpadding="2" class="table-list" id="tDetail">
            <tr>
              <th width="4%" scope="col">No</th>
              <th width="42%" scope="col"><div align="left">Nama Pengeluaran</div></th>
              <th width="17%" scope="col"><div align="left">Jumlah</div></th>
              <th width="37%" scope="col"><div align="left">Keterangan</div></th>
            </tr>
            
            <tr>
                <td>1</td>
                <td><input type="text" name="txtNama_1" id="txtNama_1" size="55"/></td>
                <td align='center'><div align="left">
                        <input type="text" name="txtJumlah_1" id="txtJumlah_1" oninput="numberFormat(1);"/>
                </div></td>
                <td><input type="text" name="ket_1" id="ket_1" size="50" maxlength="100" value=""/></td>
            </tr>
      </table></td>
    <input type="hidden" name="jumlah" id="jumlah" value="1">
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
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
