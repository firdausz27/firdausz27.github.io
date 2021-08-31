<?php
include_once './dao/PendidikanDao.php';
include_once './model/User.php';
//$tglTransaksi=  isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('d-m-y');
//$dataKode = buatKode("education_history", "EH");
//$buatKode=  buatKode("user", "U");
/*$pendidikan=new Pendidikan();
$user=new User();*/
$pendidikan=new Pendidikan();
if($_GET){
    $kode=$_GET['Kode'];
    $pendidikanDao=new PendidikanDao();
    $pendidikan = $pendidikanDao->getPendidikan($kode);
    //$user = $pendidikanDao->getUser($kode);
}
?>
<! DOCTYPE html>
<html>
<head>
    <script>    
        function valid(mode){
            var txtKode=document.getElementById("txtId").value;
            var cboLevel=document.getElementById("cboLevel").value;
            var cboTahunMulai=document.getElementById("cboTahunMulai").value;
            var cboTahunSelesai=document.getElementById("cboTahunSelesai").value;
            var txtInstitusi=document.getElementById("txtInstitusi").value;
            //var txtTglIjazah=document.getElementById("txtTglIjazah").value;
            var txtNegara=document.getElementById("txtNegara").value;

            
            if(txtKode===""){
                alert("Text Kode Masih Kosong !");
                return false;
            }
            else if(cboLevel==="blank"){
                alert("Level pendidikan belum dipilih !");
                document.getElementById("cboLevel").focus();
            }else if(cboTahunMulai==="blank"){
                alert("Tahun mulai pendidikan belum dipilih !");
                document.getElementById("cboTahunMulai").focus();           
            }else if(cboTahunSelesai==="blank"){
                alert("Tahun selesai belum dipilih !");
                document.getElementById("cboTahunSelesai").focus();
            }else if(cboTahunSelesai <=cboTahunMulai){
                alert("Tahun selesai <= tahun mulai !");
                document.getElementById("cboTahunSelesai").focus();
            }else if(txtInstitusi==""){
                alert("Institusi belum di isi");
                document.getElementById("txtInstitusi").focus();
            }/*else if(isValidDate(txtTglIjazah)==false){
                alert("Tanggal Ijasah tidak valid !");
                document.getElementById("txtTglIjazah").focus();
            }*/else if(txtNegara===""){
                alert("Negara masih kosong !");
                document.getElementById("txtNegara").focus();
            }else{
		if(mode==="delete"){
                    if(confirm('Apakah anda yakin mau menghapus ?')){
                        document.forms["fEdu"].action="?page=EduAction&action=delete";
                        document.forms["fEdu"].submit();
                        return true;
                    }
                }else if(mode==="update"){
                    document.forms["fEdu"].action="?page=EduAction&action=update";
                    document.forms["fEdu"].submit();
                    return true;
                }
            }
        }
       
        $(function() {
                $('#txtTglIjazah').datepick();
        });
        
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
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Mster | Edit Pendidikan</b></td>
    </tr>
    <tr>
      <td width="58">&nbsp;</td>
      <td width="133">&nbsp;</td>
      <td width="4">&nbsp;</td>
      <td width="500">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kode&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtId" type="text" id="txtId" size="15" maxlength="15" value="<?php echo $pendidikan->getEducationId(); ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Leval&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboLevel" id="cboLevel">
        <option value="blank">- Pilih salah satu -</option>
        <option value="TK" <?php if($pendidikan->getLevelPendidikan()=="TK") echo 'selected=""';?>>Taman Kanak-Kanak</option>
        <option value="SD" <?php if($pendidikan->getLevelPendidikan()=="SD") echo 'selected=""';?>>Sekolah Dasar</option>
        <option value="SMP" <?php if($pendidikan->getLevelPendidikan()=="SMP") echo 'selected=""';?>>Sekolah Menengah Pertama</option>
        <option value="SMA" <?php if($pendidikan->getLevelPendidikan()=="SMA") echo 'selected=""';?>>Sekolah Menengah Atas</option>
        <option value="SMK" <?php if($pendidikan->getLevelPendidikan()=="SMK") echo 'selected=""';?>>Sekolah Menengah Kejuruan</option>
        <option value="UNIVERSITAS" <?php if($pendidikan->getLevelPendidikan()=="UNIVERSITAS") echo 'selected=""';?>>Universitas</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tahun Mulai&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboTahunMulai" id="cboTahunMulai">
         <option value="blank">- Pilih Salah satu -</option>
        <?php for($i=1900;$i<3000;$i++){?>
         <option <?php if($pendidikan->getTahunMulai()==$i) echo 'selected=""';?>><?php echo $i;?></option>
        <?php }?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tahun Selesai <font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboTahunSelesai" id="cboTahunSelesai">
        <option value="blank">- Pilih Salah satu -</option>
        <?php for($i=1900;$i<3000;$i++){?>
        <option <?php if($pendidikan->getTahunSelesai()==$i) echo 'selected=""';?>><?php echo $i;?></option>
        <?php }?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Institusi <font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtInstitusi" type="text" id="txtInstitusi" size="50" maxlength="50" value="<?php echo $pendidikan->getInstitusi(); ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nilai Rata-Rata</td>
      <td>:</td>
      <td>
          <input name="txtNilaiRata" type="text" id="txtNilaiRata" size="50" maxlength="50" value="<?php echo $pendidikan->getNilaiRata(); ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tanggal Ijazah&nbsp;&nbsp;<!--<font color="red">*</font>--></td>
      <td>:</td>
      <td>
          <?php
          if($pendidikan->getTglIjazah()!=NULL){
              $date= IndonesiaTgl($pendidikan->getTglIjazah());
          }else{
              $date= date('');
          }
          echo form_tanggal("txtTglIjazah",$date); 
          ?>
          <!--<input type="text" id="txtTglIjazah" name="txtTglIjazah" size="20" maxlength="20" value="<?php //echo $date->format("m/d/Y");?>"/>-->&nbsp; format ( mm/dd/yyyy )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>No Ijazah</td>
      <td>:</td>
      <td>
          <input name="txtNoIjazah" type="text" id="txtNoIjazah" size="20" maxlength="15" value="<?php echo $pendidikan->getNoIjazah(); ?>"/>
          &nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kota&nbsp;</td>
      <td>:</td>
      <td>
          <input name="txtKota" type="text" id="txtKota" size="50" maxlength="100" value="<?php echo $pendidikan->getKota(); ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Propinsi</td>
      <td>:</td>
      <td><input name="txtPropinsi" type="text" id="txtPropinsi" size="50" maxlength="100" value="<?php echo $pendidikan->getPropinsi(); ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Negara<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtNegara" type="text" id="txtNegara" size="50" maxlength="100" value="<?php echo $pendidikan->getNegara(); ?>"/></td>
    </tr>
    <input type="hidden" id="txtPersonalId" name='txtPersonalId' value="<?php echo $pendidikan->getPersonalId();?>"/>
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
      <td ><input type="button" name="bEdit" id="bInsert" value="Ubah" onClick="valid('update');" />
          <input type="button" name="bDelete" id="bInsert" value="Hapus" onClick="valid('delete');" />
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
