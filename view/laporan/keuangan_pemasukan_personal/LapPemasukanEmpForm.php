<?php
include_once './dao/PersonalDao.php';
$personalDao=new PersonalDao();
$allPersonal = $personalDao->getAllPersonal();
$tglTransaksi="";
?>
<! DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript" src="js/jquery.multiselect2side.js" ></script>
<script type="text/javascript">
    
    
    function validasi(){
        var txtTglFrom=document.getElementById("txtTglFrom").value;
        var txtTglTo=document.getElementById("txtTglTo").value;
        var cboKas=document.getElementById("cboKas").value;
        //alert(pilihan);
        if(txtTglFrom==''){
                alert("Tanggal dari masih kosong !");
                document.getElementById("txtTglFrom").focus();
        }else if(txtTglTo==''){
                alert("Tanggal sampai masih kosong !");
                document.getElementById("txtTglTo").focus();
        }else if(cboKas=='blank'){
                alert("Cbo kas masih kosong !");
                document.getElementById("cboKas").focus();
        }else{
           var w=950;
            var h=600;
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            document.forms["form1"].target="DoSubmit"
            document.forms["form1"].action="./view/laporan/keuangan_pemasukan_personal/PrintPemasukan.php"
            DoSubmit=window.open('about:blank','DoSubmit','scrollbars=1,status=1, width='+w+', height='+h+', top='+top+', left='+left)
            return true;
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
           <td colspan="1" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Laporan | Pinjaman</b></td>
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
                  foreach ($allPersonal as $value){
                   ?>
                      <option value="<?php echo $value->getIdPersonal(); ?>">
                          <?php 
                          echo $value->getNamaAwal().' '.$value->getNamaTengah().' '.$value->getNamaAkhir(); 
                          if($value->getKelamin()==1){
                                            echo ' [ Ikhwan ]';
                                        }else{
                                            echo ' [ Akhwat ]';
                                        }
                          ?>
                      </option>;
                  <?php
                  }
                  ?>
              </select></td>
            </tr>
			
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
                                <td><input name="bprint" type="submit" value="Print" onClick="validasi();">
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
