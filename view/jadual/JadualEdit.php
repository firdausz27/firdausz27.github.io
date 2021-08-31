<?php
include_once './dao/RuanganDao.php';
include_once './dao/PelajaranDao.php';
include_once './dao/PersonalDao.php';
include_once './dao/JadualDao.php';
include_once './dao/AddKajianDao.php';
include_once './model/User.php';
include_once './dao/KelasDao.php';
//$tglTransaksi=  isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('d-m-y');
$dataKode = buatKode("jadual", "JD");
//digunakan untuk meload seluruh ruangan
$ruanganDao=new RuanganDao();
$allRuangan = $ruanganDao->getAllRuangan();
//digunakan untuk meload seluruh pelajaran
$pelajaranDao=new PelajaranDao();
$allPelajaran = $pelajaranDao->getAllPelajaran();
//digunakan untuk meload personal dengan type guru
$personalDao=new PersonalDao();
$allPersonal = $personalDao->getAllPersonal();
$cariPersonal = $personalDao->getAllPersonal();
//lakukan load jam seleasi max untuk jam awal jadual baru
$jadualDao=new JadualDao();
$maxJamselesai=new Jadual();
//lakukan load untuk kelas 
$kelasDao=new KelasDao();
$allKelas = $kelasDao->getAllKelas();
$idruangan=0;
$idPelajaran=0;
$KelasId=0;
$empkelas=array();
$jadual=new Jadual();
if(isset($_GET['Kode'])){
    $kode=$_GET['Kode'];
    $jadual = $jadualDao->getJadual($kode);
    //$maxJamselesai = $jadualDao->getMaxJamselesai($jadual);
    $idruangan=$jadual->getIdRuangan()->getRunaganId();
    $idPelajaran=$jadual->getIdPelajaran()->getIdPelajran();
    //untuk validasi
    $AddKajianDao=new AddKajianDao();
    $kajianByJadual = $AddKajianDao->getKajianByJadual($kode,"1");
    $listLulus=array();
    foreach ($kajianByJadual as $values){
        $listLulus[]=$values->getIdPersonal();
    }
    $KelasId=$jadual->getKeals();
    if($KelasId!=''){
        $kelas = $kelasDao->getKelas($KelasId);
        foreach ($kelas->getKelasPersonal() as $value){
            $empkelas[]=$value->getPersonalid();
        }
    }
}
if($_POST){ 
    $kode=$_POST['idpost'];
    $jadual = $jadualDao->getJadual($kode);
    $jadual->setJadualId( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $jadual->setHari(isset($_POST['cboHari']) ? $_POST['cboHari'] : '');
    //untuk kelas
    $KelasId=isset($_POST['cboKelas']) ? $_POST['cboKelas'] : '';
    $kelas = $kelasDao->getKelas($KelasId);
    foreach ($kelas->getKelasPersonal() as $value){
        $empkelas[]=$value->getPersonalid();
    }
    $ruangan=new RuanganDao();
    $jadual->setIdRuangan($ruangan->getRuangan(isset($_POST['cboRuangan']) ? $_POST['cboRuangan'] : ''));
    $pelajaran=new PelajaranDao();
    $jadual->setIdPelajaran($pelajaran->getPelajaran(isset($_POST['cboPelajaran']) ? $_POST['cboPelajaran'] : ''));
    $maxJamselesai = $jadualDao->getMaxJamselesai($jadual);
    $hr=$maxJamselesai->getHari();
            if($hr=='7'){
                $hari= 'Minggu';
            }else if($hr=='6'){
                $hari= 'Sabtu';
            }else if($hr=='5'){
                $hari= 'Jumat';
            }else if($hr=='4'){
                $hari= 'Kamis';
            }else if($hr=='3'){
                $hari= 'Rabu';
            }else if($hr=='2'){
                $hari= 'Selasa';
            }else{
                $hari= 'Senin';
            }
    $maxJamselesai->setHari($hari);
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
        
        function valid(mode){
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
                if(mode==="delete"){
                    if(confirm('Apakah anda yakin mau menghapus ?')){
                        document.forms["fEdu"].action="?page=JadualAction&action=delete";
                        document.forms["fEdu"].submit();
                        return true;
                    }
                }else if(mode==="update"){
                    document.forms["fEdu"].action="?page=JadualAction&action=update";
                    document.forms["fEdu"].submit();
                    return true;
                }
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
		document.forms["fEdu"].action="?page=JadualEdit";
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
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Transaksi | Edit Jadual</b></td>
    </tr>
    <tr>
      <td width="30">&nbsp;</td>
      <td width="109">&nbsp;</td>
      <td width="3">&nbsp;</td>
      <td width="779">&nbsp;</td>
    </tr>
    <input type="hidden"  name="idpost" id="idpost" value="<?php echo $kode;?>"/>
    <tr>
      <td>&nbsp;</td>
      <td>Kode&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtId" type="text" id="txtId" size="15" maxlength="15" value="<?php echo $jadual->getJadualId(); ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Hari<font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboHari" id="cboHari" style="width: 200px;">
        <option value="blank">- Pilih salah satu -</option>
        <option value="1" <?php if($jadual->getHari()=='Senin')  echo 'selected=""';?>>Senin</option>
        <option value="2" <?php if($jadual->getHari()=='Selasa')  echo 'selected=""';?>>Selasa</option>
        <option value="3" <?php if($jadual->getHari()=='Rabu')  echo 'selected=""';?>>Rabu</option>
        <option value="4" <?php if($jadual->getHari()=='Kamis')  echo 'selected=""';?>>Kamis</option>
        <option value="5" <?php if($jadual->getHari()=='Jumat')  echo 'selected=""';?>>Jumat</option>
        <option value="6" <?php if($jadual->getHari()=='Sabtu')  echo 'selected=""';?>>Sabtu</option>
        <option value="7" <?php if($jadual->getHari()=='Minggu')  echo 'selected=""';?>>Minggu</option>
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
            <?php if($KelasId==$value->getIdKelas()) echo 'selected=""';?>>
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
            <?php if($idPelajaran==$value->getIdPelajran()) echo 'selected=""';?>>
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
            <?php if($idruangan==$value->getRunaganId()) echo 'selected=""';?>>
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
      <td><input name="txtJamMulai" type="text" id="txtJamMulai" size="6" maxlength="6" value="<?php echo substr($jadual->getJamMulai(),0,5);?>">&nbsp; format ( HH:mm )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Jam Selesai <font color="red">*</font></td>
      <td>:</td>
      <td><input name="txtJamSelesai" type="text" id="txtJamSelesai" size="6" maxlength="6" value="<?php echo substr($jadual->getJamSelesai(),0,5);?>">&nbsp; format ( HH:mm )</td>
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
              <option value="<?php echo $val->getIdPersonal() ?>" <?php if(in_array($val->getIdPersonal(), $jadual->getPengajarId()))echo 'selected=""' ?>>
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
                if(in_array($val->getIdPersonal(), $listLulus)){
                  }else{
            ?>
              <option value="<?php echo $val->getIdPersonal() ?>" <?php if(in_array($val->getIdPersonal(), $jadual->getPelajar()))echo 'selected=""' ?>>
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
      <td ><input type="button" name="bEdit" id="bEdit" value="Edit" onClick="valid('update');" />
          <input type="button" name="bDelete" id="bDelete" value="Delete" onClick="valid('delete');" />
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
