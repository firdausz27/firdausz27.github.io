<?php
include_once './dao/KeuanganKasDao.php';
$kasDao=new KeuanganKasDao();
$allKas = $kasDao->getAllKas();
$tglTransaksi="";
?>
<! DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript" src="js/jquery.multiselect2side.js" ></script>
<script type="text/javascript">
    
    function findSelection(field) {
        var test = document.getElementsByName(field);
        var sizes = test.length;
        //alert(sizes);
        for (i=0; i < sizes; i++) {
                if (test[i].checked==true) {
                //alert(test[i].value + ' you got a value');     
                return test[i].value;
            }
        }
    }

    
    function validasi(){
        var txtTglFrom=document.getElementById("txtTglFrom").value;
        var txtTglTo=document.getElementById("txtTglTo").value;
        var cboKas=document.getElementById("cboKas").value;
        var pilihan=  findSelection("radiobutton");
        //alert(pilihan);
        if(txtTglFrom==''){
                alert("Tanggal dari masih kosong !");
                return false;
        }else if(txtTglTo==''){
                alert("Tanggal sampai masih kosong !");
                return false;
        }else if(cboKas=='blank'){
                alert("Cbo kas masih kosong !");
                return false;
        }else{
           var w=950;
            var h=600;
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            document.forms["form1"].target="DoSubmit"
            if(pilihan==1){
                document.forms["form1"].action="./view/laporan/keuangan_pengeluaran/PrintPengeluaran.php"
                DoSubmit=window.open('about:blank','DoSubmit','scrollbars=1,status=1, width='+w+', height='+h+', top='+top+', left='+left)
                return true;
            }else if(pilihan==2){
                document.forms["form1"].action="./view/laporan/keuangan_pengeluaran/PrintPengeluaranResume.php"
                DoSubmit=window.open('about:blank','DoSubmit','scrollbars=1,status=1, width='+w+', height='+h+', top='+top+', left='+left)
                return true;
            }
        }
    }
    </script>
</head>
<body>
<form id="form1" name="form1" method="post">
    <table width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           border-bottom: none;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <tr>
           <td colspan="1" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Laporan | Pengeluaran</b></td>
        </tr>
        <td>
        
            <table width="100%" border="0" cellspacing="1" cellpadding="5">
            
            <tr>
              <td width="30">&nbsp;</td>
              <td width="93">&nbsp;</td>
              <td width="4">&nbsp;</td>
              <td width="991">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Dari Tangal </td>
              <td>:</td>
              <td>
			  <?php echo form_tanggal("txtTglFrom",$tglTransaksi); ?> 
			  Sampai Tgl 
			  <?php echo form_tanggal("txtTglTo",$tglTransaksi);  ?>
			  </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Nama Kas </td>
              <td>:</td>
              <td><label for="cboKas"></label>
                  <select name="cboKas" id="cboKas" >
                  <option value="blank">- Pilih Salah Satu -</option>
                  <?php 
                  foreach ($allKas as $value){
                      echo '<option value="'.$value->getKode().'">'.$value->getNamakas().'</option>';
                  }
                  ?>
              </select></td>
            </tr>
			<tr>
              <td>&nbsp;</td>
              <td>Jenis Tamilan </td>
              <td>:</td>
              <td><input name="radiobutton" type="radio" value="1" checked="">
              Detail
                <input name="radiobutton" type="radio" value="2">
                Ringkasan
              </td>
			</tr>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
                                <td><input name="bprint" type="submit" value="Print" onclick="validasi();">
                                    <input name="bReset" type="reset" value="Reset">
                                </td>
			</tr>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
            </table>
            
        </td>
    </tr>
    </table>
</form >
</body>
</html>
