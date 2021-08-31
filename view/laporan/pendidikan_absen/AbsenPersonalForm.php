<?php
include_once './dao/JadualDao.php';
include_once './dao/PersonalDao.php';
include_once './dao/AddKajianDao.php';
include_once './dao/AbsensiDao.php';
include_once './model/Absensi.php';
$kode=buatKodeYear("absensi");
$tanggl= date('m/d/Y');


$jadualDao=new JadualDao();
$allJadual = array();//$jadualDao->getAllJadual();

$AddKajianDao=new AddKajianDao();
$personalDao=new PersonalDao();
$cariPersonal = $personalDao->getAllPersonal();
$allPersonal = $personalDao->getAllPersonal();
$idSiswa='';
$idJa='';
$tanggal=  date("m/d/Y");
$nomor=0;
if($_POST){
    if(isset($_POST['cboPengajar'])){
        $idSiswa=$_POST['cboPengajar'];
        $allJadual=$jadualDao->getJadualByGuru($idSiswa);
    }
    if(isset($_POST['cboJadual'])){
        $idJa=$_POST['cboJadual'];
        $allPersonal = $AddKajianDao->getKajianByJadualAll($idJa);
        $tanggal=isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : '';
    }
    $absendao=new AbsensiDao();
    $idAbsen = $absendao->getIdAbsen($idJa, $tanggal);
    if($idAbsen!=null){
        $kode=$idAbsen->getIdAbsen();
    }
}
?>
<script type="text/javascript" src="js/jquery.js" ></script>
<script type="text/javascript" src="js/jquery.multiselect2side.js" ></script>
<script type="text/javascript">
    
    
    function valid(){
            var txtTanggalAkhir=document.getElementById("txtTanggalAkhir").value;
            var txtTanggalAwal=document.getElementById("txtTanggalAwal").value;
            var cboList=document.getElementById("cboEmp").value;
            
           if(txtTanggalAwal==""){
                alert("Tanggal Awal masih kosong !");
                return false;
            }if(txtTanggalAkhir==""){
                alert("Tanggal Akhir masih kosong !");
                return false;
            }else if(cboList=="blank"){
                alert("Santri belum dipilih !");
                return false;
            }else{
                var w=950;
                var h=600;
                var left = (screen.width/2)-(w/2);
                var top = (screen.height/2)-(h/2);
                document.forms["form1"].target="DoSubmit"
                document.forms["form1"].action="./view/laporan/pendidikan_absen/LapAbsenPersonal.php"
                DoSubmit=window.open('about:blank','DoSubmit','scrollbars=1,status=1,resizable=1, width='+w+', height='+h+', top='+top+', left='+left)
                return true;
            }
    }
            
        
        
        
   function kirim(){
            document.forms["form1"].action="?page=AbsenPersonalForm";
            document.forms["form1"].submit();
            return true;
   }
   
</script>
<form id="form1" name="form1" method="post">
  <table  width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="5" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Laporan | Absensi Peseta Didik</b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="3"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Dari Tanggal <font color="red">*</font></td>
      <td width="3">&nbsp;</td>
      <td><?php
          $tglTransaksi=  isset($_POST['txtTanggalAwal']) ? $_POST['txtTanggalAwal'] : date('m/d/Y');;
          echo form_tanggal("txtTanggalAwal",$tglTransaksi); 
          ?>
        <!--<input type="text" name="txtTanggal" id="txtTanggal" value="<?php echo $tanggl;?>" readonly=""/>-->
&nbsp;&nbsp;format tanggal ( mm/dd/YYY ) </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Sampai Tanggal <font color="red">*</font></td>
      <td width="3">:</td>
      <td>
          <?php
          $tglTransaksi=  isset($_POST['txtTanggalAkhir']) ? $_POST['txtTanggalAkhir'] : date('m/d/Y');;
          echo form_tanggal("txtTanggalAkhir",$tglTransaksi); 
          ?>
          <!--<input type="text" name="txtTanggal" id="txtTanggal" value="<?php echo $tanggl;?>" readonly=""/>--> &nbsp;&nbsp;format tanggal ( mm/dd/YYY ) </td>
    </tr>
    <tr>
      <td width="50">&nbsp;</td>
      <td width="176">Pengajar</td>
      <td width="3">:</td>
      <td width="930"><select name="cboPengajar" id="cboPengajar" onchange="kirim();">
        <option value="blank">- Pilih salah satu -</option>
            <?php
            foreach ($cariPersonal as $val){
            ?>
              <option value="<?php  echo $val->getIdPersonal()?>" 
              <?php if($idSiswa ==$val->getIdPersonal())     echo "selected=''";?> >
              <?php echo $val->getNamaAwal()." ".$val->getNamaTengah()." ".$val->getNamaAkhir()." -- ". $val->getIdPersonal() ?>              </option>
              <?php
                }
              ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kajian</td>
      <td width="3">:</td>
      <td><select name="cboJadual" id="cboJadual" onchange="kirim();">
             <option value="blank">- Pilih salah satu -</option>
            <?php
                foreach ($allJadual as $valu){
              ?>
              <option value="<?php echo $valu->getJadualId() ?>"
                    <?php if($idJa ==$valu->getJadualId())echo "selected=''";?> >
                    <?php
                    echo $valu->getIdPelajaran()->getNamaPelajaran()." -- ";
                    echo $valu->getHari()." -- ".$valu->getIdRuangan()->getNama()
                    ?>
                 </option>
              <?php
                }
              ?>
      </select></td>
    </tr>
   <tr>
      <td>&nbsp;</td>
      <td>Santri <font color="red">*</font></td>
      <td width="3">:</td>
       <td>
         <select name="cboEmp" id='cboEmp'>
              <option value="blank">- Pilih Salah Satu -</option>
                <?php
                  foreach ($allPersonal as $val){
                ?>
             <option value="<?php echo $val->getIdPersonal() ?>">
                      <?php
                      echo $val->getNamaAwal()." ";
                      echo $val->getNamaTengah()." ".$val->getNamaAkhir();
                      if($val->getKelamin()==1){
                          echo ' [ Ikhwan ]';
                      }else{
                          echo ' [ Akhwat ]';
                      }
                      ?>
                   </option>
                <?php
                  }
                ?>
            </selcet>
        </td>
      </tr>
    
    <tr>
      <td colspan="4"><hr width="95%" color="#ccc"></td>
    </tr>
   <tr>
        <td>&nbsp;</td>
        <td colspan="3"><font color="red">*</font>&nbsp;Harus diisi</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="bPrint" value="Print" onclick="valid();"/>
	    <input type="reset" name="Reset" value="Reset" /></td>
    </tr>
    <tr height="50">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
