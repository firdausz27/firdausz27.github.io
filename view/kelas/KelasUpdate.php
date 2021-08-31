<?php
include_once './dao/PersonalDao.php';
include_once './dao/KelasDao.php';
$dataKode = buatKode("kelas", "KL");
$kelasDao=new KelasDao();
//digunakan untuk meload personal
$personalDao=new PersonalDao();
$allPersonal = $personalDao->getAllPersonal();
$kelas=null;
if($_GET){
    $id=$_GET['Kode'];
    $kelas=new Kelas();
    $kelas = $kelasDao->getKelas($id);
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
        
        function valid(){
            var txtKode=document.getElementById("txtId").value;
            var txtNamaKelas=document.getElementById("txtNamaKelas").value;
            var txtKeterangan=document.getElementById("txtKeterangan").value;
            var cboSiswa=document.getElementById("second").value;

            
            if(txtKode==""){
                alert("Text Kode Masih Kosong !");
                return false;
            }
            else if(txtNamaKelas==""){
                alert("Nama Kelas masih kosong !");
                document.getElementById("txtNamaKelas").focus();
            }else if(cboSiswa==""){
                alert("Siswa masih kosong !");
                document.getElementById("second").focus();           
            }else{
		document.forms["fEdu"].action="?page=KelasAction&action=update";
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
        <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Pendidikan | Input Kelas</b></td>
    </tr>
    <tr>
      <td width="66">&nbsp;</td>
      <td width="100">&nbsp;</td>
      <td width="3">&nbsp;</td>
      <td width="788">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Kode&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td>
          <input name="txtId" type="text" id="txtId" size="15" maxlength="15" value="<?php echo $kelas->getIdKelas(); ?>" readonly/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Nama Kelas <font color="red">*</font></td>
      <td>:</td>
      <td><input name="txtNamaKelas" type="text" id="txtNamaKelas" maxlength="100" size="40" value="<?php echo $kelas->getNamaKelas();?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Keterangan</td>
      <td>:</td>
      <td><textarea name="txtKeterangan" id="txtKeterangan" rows="4" cols="30"><?php echo $kelas->getKeterangan();?></textarea></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td valign="top">Pelajar&nbsp;&nbsp;<font color="red">*</font></td>
      <td valign="top">:</td>
      <td>
          <select name="pelajar[]" id='second' multiple='multiple'">
            <?php
            $list=array();
            foreach ($kelas->getKelasPersonal() as $detail){
                $list[]=$detail->getPersonalid();
            }
            foreach ($allPersonal as $val){
            ?>
              <option value="<?php echo $val->getIdPersonal() ?>" <?php if (in_array($val->getIdPersonal(), $list)) {
                      echo 'selected=""';
                  }
                  ?>>
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
      <td ><input type="button" name="bEdit" id="bInsert" value="Update" onClick="valid();" />
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
