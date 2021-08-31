<?php
include_once './dao/JadualDao.php';
include_once './dao/PersonalDao.php';
$jadualDao=new JadualDao();
$allJadual = $jadualDao->getAllJadual();
$personalDao=new PersonalDao();
$cariPersonal = $personalDao->getAllPersonal();
$idSiswa='';
if($_POST){
    $idSiswa=$_POST['cboSiswa'];
    $allJadual=$jadualDao->getJadualNotInPer($idSiswa);
}
?>
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript" src="js/jquery.multiselect2side.js" ></script>
<script type="text/javascript">
    $().ready(function() {
            $('#second').multiselect2side({
                    selectedPosition: 'right',
                    moveOptions: false,
                    labelsx: '',
                    labeldx: '',
                    autoSort: true,
                    autoSortAvailable: true
                    });
    });
    
    function valid(){
            var cboSiswa=document.getElementById("cboSiswa").value;
            var cboJadual=document.getElementById("second").value;
            if(cboSiswa=="blank"){
                alert("Santri belum dipilih !");
                return false;
            }else if(cboJadual==''){
                alert("List jadual masih kosong !");
                return false;
            }else{
		document.forms["form1"].action="?page=AddKajianAction&action=insert";
                document.forms["form1"].submit();
                return true;
            }
        }
        
   function post(){
        document.forms["form1"].action="?page=AddKajian";
        document.forms["form1"].submit();
        return true;
   }
</script>
<form id="form1" name="form1" method="post" action="">
  <table  width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="5" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Transaksi | Add Peseta Didik</b></td>
    </tr>
    <tr>
      <td width="52">&nbsp;</td>
      <td width="179">&nbsp;</td>
      <td width="15">&nbsp;</td>
      <td width="936">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Jadual</td>
      <td>:</td>
      <td><select name="cboSiswa" id="cboSiswa" onchange="post();">
              <option value="blank">- Pilih salah satu -</option>
              <?php
                foreach ($allJadual as $val){
              ?>
              <option value="<?php echo $val->getJadualId() ?>"
                      <?php if($idSiswa ==$val->getJadualId())     echo "selected=''";?>>
                    <?php
                    echo $val->getIdPelajaran()->getNamaPelajaran()." -- ";
                    echo $val->getHari()." -- ".$val->getIdRuangan()->getNama()
                    ?>
                 </option>
              <?php
                }
              ?>
           
      </select></td>
    </tr>
    <tr>
        <td width="52">&nbsp;</td>
        <td width="179">Tambah Kajian Santri</td>
        <td width="52">:</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">
          <select name="searchable[]" id='second' multiple='multiple'">
               <?php
                foreach ($cariPersonal as $val){
                    ?>
              <option value="<?php  echo $val->getIdPersonal()?>" 
              <?php if($idSiswa ==$val->getIdPersonal())     echo "selected=''";?> >
              <?php echo $val->getNamaAwal()." ".$val->getNamaTengah()." ".$val->getNamaAkhir()." -- ". $val->getNis() ?>
              </option>
              <?php
                }
              ?>
          </selcet>
      </td>
    </tr>
    <tr>
      <td colspan="4"><hr width="90%" color="#ccc"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">
          <input type="button" name="bSimpan" id="bSimpan" value="Simpan" onClick="valid();"/>
          <input type="reset" name="bReset" id="bReset" value="Reset" />
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
