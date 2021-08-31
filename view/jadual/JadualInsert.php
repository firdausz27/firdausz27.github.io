<?php
include_once './dao/RuanganDao.php';
include_once './dao/PelajaranDao.php';
include_once './dao/PersonalDao.php';
include_once './dao/JadualDao.php';
include_once './model/User.php';
include_once './dao/KelasDao.php';
//$tglTransaksi=  isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('d-m-y');
$dataKode = buatKode("jadual", "JD");
//digunakan untuk meload seluruh ruangan
$ruanganDao=new RuanganDao();
$allRuangan = $ruanganDao->getAllRuangan();
//$personalDao=new PersonalDao();

//digunakan untuk meload seluruh pelajaran
$pelajaranDao=new PelajaranDao();
$allPelajaran = $pelajaranDao->getAllPelajaran();
//digunakan untuk meload personal dengan type guru
$personalDao=new PersonalDao();
$allPersonal = $personalDao->getAllPersonal();
//lakukan load untuk kelas 
$kelasDao=new KelasDao();
$allKelas = $kelasDao->getAllKelas();
//lakukan load jam seleasi max untuk jam awal jadual baru
$jadualDao=new JadualDao();
$maxJamselesai=new Jadual();
$idruangan=0;
$idPelajaran=0;
$KelasId=0;
$empkelas=array();
if($_POST){
    $jadual=new Jadual();
    $jadual->setJadualId( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $jadual->setHari(isset($_POST['cboHari']) ? $_POST['cboHari'] : '');
    //untuk kelas
    $KelasId=isset($_POST['cboKelas']) ? $_POST['cboKelas'] : '';
    //$kelas=new Kelas();
    $kelas = $kelasDao->getKelas($KelasId);
    foreach ($kelas->getKelasPersonal() as $value){
        $empkelas[]=$value->getPersonalid();
    }
    $ruangan=new RuanganDao();
    $jadual->setIdRuangan($ruangan->getRuangan(isset($_POST['cboRuangan']) ? $_POST['cboRuangan'] : ''));
    $pelajaran=new PelajaranDao();
    $jadual->setIdPelajaran($pelajaran->getPelajaran(isset($_POST['cboPelajaran']) ? $_POST['cboPelajaran'] : ''));
    $maxJamselesai = $jadualDao->getMaxJamselesai($jadual);
    $idruangan=$maxJamselesai->getIdRuangan()->getRunaganId();
    $idPelajaran=$maxJamselesai->getIdPelajaran()->getIdPelajran();
}


?>
<! DOCTYPE html>
<html>
<head>
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
        $().ready(function() {
                $('#second1').multiselect2side({
                        selectedPosition: 'right',
                        moveOptions: false,
                        labelsx: '',
                        labeldx: '',
                        autoSort: true,
                        autoSortAvailable: true
                        });
        });
        
        function valid(){
            var txtKode=document.getElementById("txtId").value;
            var cboHari=document.getElementById("cboHari").value;
            var txtJamMulai=document.getElementById("txtJamMulai").value;
            var txtJamSelesai=document.getElementById("txtJamSelesai").value;
            var cboRuangan=document.getElementById("cboRuangan").value;
            var cboPelajaran=document.getElementById("cboPelajaran").value;
            var cboPengajar=document.getElementById("second").value;
            var cboPelajar=document.getElementById("second1").value;

            
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                return false;
            }
            else if(cboHari==="blank"){
                alert("Hari belum dipilih !");
                document.getElementById("cboHari").focus();
            }else if(formatTime(txtJamMulai)==false){
                alert("Jam mulai tidak valid !");
                document.getElementById("txtJamMulai").focus();           
            }else if(formatTime(txtJamSelesai)==false){
                alert("Jam selesai tidak valid !");
                document.getElementById("txtJamSelesai").focus();
            }else if((txtJamSelesai -txtJamMulai) <=0){
                alert("jam selesai <= jam muali !");
                document.getElementById("txtJamSelesai").focus();
            }else if(cboRuangan=="blank"){
                alert("Institusi belum di isi");
                document.getElementById("cboRuangan").focus();
            }else if(cboPelajaran=="blank"){
                alert("Pelajaran belum dipilih !");
                document.getElementById("cboPelajaran").focus();
            }else if(cboPengajar==""){
                alert("Pengajar belum dipilih !");
                document.getElementById("second").focus();
            }else if(cboPelajar==""){
                alert("Pelajar belum dipilih !");
                document.getElementById("second1").focus();
            }else{
                document.getElementById("txtJamMulai").value=formatTime(txtJamMulai);
                document.getElementById("txtJamSelesai").value=formatTime(txtJamSelesai);
		document.forms["fEdu"].action="?page=JadualAction&action=insert";
                document.forms["fEdu"].submit();
                return true;
            }
        }
        
        function loadJam(){
            var txtKode=document.getElementById("txtId").value;
            var cboHari=document.getElementById("cboHari").value;
            var cboRuangan=document.getElementById("cboRuangan").value;
            var cboPelajaran=document.getElementById("cboPelajaran").value;
            var cboKelas=document.getElementById("cboKelas").value;
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                return false;
            }
            else if(cboHari==="blank"){
                alert("Hari belum dipilih !");
                return false;
            }else if(cboKelas=="blank"){
                alert("Kelas belum dipilih !");
                return false;
            }else if(cboPelajaran=="blank"){
                alert("Pelajaran belum dipilih !");
                return false;
            }else if(cboRuangan=="blank"){
                alert("Institusi belum di isi");
                return false;
            }else{
		document.forms["fEdu"].action="?page=JadualInsert";
                document.forms["fEdu"].submit();
                return true;
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
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Transaksi | Input Jadual</b></td>
    </tr>
    <tr>
      <td width="30">&nbsp;</td>
      <td width="100">&nbsp;</td>
      <td width="3">&nbsp;</td>
      <td width="788">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kode&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtId" type="text" id="txtId" size="15" maxlength="15" value="<?php echo $dataKode; ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Hari<font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboHari" id="cboHari" style="width: 200px;">
        <option value="blank">- Pilih salah satu -</option>
        <option value="1" <?php if($maxJamselesai->getHari()=='1')  echo 'selected=""';?>>Senin</option>
        <option value="2" <?php if($maxJamselesai->getHari()=='2')  echo 'selected=""';?>>Selasa</option>
        <option value="3" <?php if($maxJamselesai->getHari()=='3')  echo 'selected=""';?>>Rabu</option>
        <option value="4" <?php if($maxJamselesai->getHari()=='4')  echo 'selected=""';?>>Kamis</option>
        <option value="5" <?php if($maxJamselesai->getHari()=='5')  echo 'selected=""';?>>Jumat</option>
        <option value="6" <?php if($maxJamselesai->getHari()=='6')  echo 'selected=""';?>>Sabtu</option>
        <option value="7" <?php if($maxJamselesai->getHari()=='7')  echo 'selected=""';?>>Minggu</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kelas <font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboKelas" id="cboKelas" style="width: 200px;">
        <option value="blank">- Pilih salah satu -</option>
        <?php 
        foreach ($allKelas as $value) {
        ?>
        <option value="<?php echo $value->getIdKelas()?>" 
            <?php if($_POST)if($KelasId==$value->getIdKelas()) echo 'selected=""';?>>
           <?php echo $value->getNamaKelas()?>
        </option>        
        <?php
        }
        ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Pelajaran <font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboPelajaran" id="cboPelajaran" style="width: 200px;">
        <option value="blank">- Pilih salah satu -</option>
        <?php 
        foreach ($allPelajaran as $value) {
        ?>
        <option value="<?php echo $value->getIdPelajran()?>" 
            <?php if($_POST)if($idPelajaran==$value->getIdPelajran()) echo 'selected=""';?>>
           <?php echo $value->getNamaPelajaran()?>
        </option>        
        <?php
        }
        ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Ruangan<font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboRuangan" id="cboRuangan" onChange="loadJam()" style="width: 200px;">
        <option value="blank">- Pilih salah satu -</option>
        <?php 
        foreach ($allRuangan as $value) {
        ?>
        <option value="<?php echo $value->getRunaganId();?>"
            <?php if($_POST)if($idruangan==$value->getRunaganId()) echo 'selected=""';?>>
            <?php echo $value->getNama()?>
        </option>;
        <?php
            }
         ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Jam Mulai&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td><input name="txtJamMulai" type="text" id="txtJamMulai" size="6" maxlength="6" value="<?php echo $maxJamselesai->getJamMulai();?>">&nbsp; format ( HH:mm )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Jam Selesai <font color="red">*</font></td>
      <td>:</td>
      <td><input name="txtJamSelesai" type="text" id="txtJamSelesai" size="6" maxlength="6" value="<?php echo $maxJamselesai->getJamSelesai();?>">&nbsp; format ( HH:mm )</td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td valign="top">Pengajar&nbsp;&nbsp;<font color="red">*</font></td>
      <td valign="top">:</td>
      <td>
          <select name="pendidik[]" id='second' multiple='multiple'">
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
      <td>&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td>
          <input type="button" value="Load Pelajar" name="bLoad" onclick="loadJam();">
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td valign="top">Peserta Didik&nbsp;&nbsp;<font color="red">*</font></td>
      <td valign="top">:</td>
      <td>
          <select name="pesertaDidik[]" id='second1' multiple='multiple'">
            <?php
              foreach ($allPersonal as $val){
                  if(in_array($val->getIdPersonal(), $empkelas)){
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
              }
            ?>
        </selcet>
      </td>
    </tr>
    <input type="hidden" id="txtPersonalId" name='txtPersonalId' value="<?php echo $kode;?>"/>
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
      <td ><input type="button" name="bEdit" id="bInsert" value="Simpan" onClick="valid();" />
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
