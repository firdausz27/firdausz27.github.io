<?php
include_once './dao/PersonalDao.php';
include_once './model/Personal.php';
include_once './db/DBConnection.php';
//untuk mendapatkan kiriman kode group
$kode=isset($_POST['kode']) ? $_POST['kode'] : '';

$personalDao=new PersonalDao();
$allPersonal = $personalDao->getAllPersonalFreeAccess();
$kelamin='';
$kategori='';
$kode=isset($_POST['kode']) ? $_POST['kode'] : '';
if(isset($_POST['cboKelamin']) && isset($_POST['cboKategori'])){
if($_POST){
    $kelamin=$_POST['cboKelamin'];
    $kategori=$_POST['cboKategori'];
    $sql='select * from personal where 1=1';
    if(isset($_POST['cboKelamin']) && $_POST['cboKelamin'] !='blank'){
           $sql=$sql.' and kelamin='.$_POST['cboKelamin'].' ';
    }
    
    if(isset($_POST['cboKategori']) && $_POST['cboKategori']!='blank'){
         $sql=$sql." and kategori_santri='".$_POST['cboKategori']."' ";
    }
    //echo $sql;
    $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
    $personals=array();
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $personal=new Personal();
          $personal->setIdPersonal($dataRow['id_siswa']);
          $personal->setNamaAwal($dataRow['nama_awal']);
          $personal->setNamaTengah($dataRow['nama_tengah']);
          $personal->setNamaAkhir($dataRow['nama_akhir']);
          $personal->setTempatLahir($dataRow['tempat_lahir']);
          $personal->setTglLahir($dataRow['tgl_lahir']);
          $personal->setTelepon($dataRow['telepon']);
          $personal->setAlamat($dataRow['alamat']);
          $personal->setKota($dataRow['kota']);
          $personal->setPropinsi($dataRow['propinsi']);
          $personal->setNegara($dataRow['negara']);
          $personal->setEmail($dataRow['email']);
          $personal->setTglGabung($dataRow['tgl_gabung']);
          $personal->setKelamin($dataRow['kelamin']);
          $personal->setKategoriSantri($dataRow['kategori_santri']);
          $personal->setFoto($dataRow['foto']);
          $personals[]=$personal;
        }
    $allPersonal= $personals;   
    
}
}

$qryCheck="select * from group_personal where group_id=$kode";
$sqlCheck  =  mysql_query($qryCheck, DBConnection::getConnection())or die("Query error :".  mysql_error());
$listPersonal=array();
while ($dataRow=  mysql_fetch_array($sqlCheck)){  
    $listPersonal[]=$dataRow['personal_id'];
}
$jumlah = sizeof($listPersonal);
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
    
    function kirim(){
        document.forms["fAll"].action="?page=addPersonal";
        document.forms["fAll"].submit();
        return true;
    }
    
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
        var cboJadual=document.getElementById("second").value;
        var pilihan=  findSelection("typeReport");
        //alert(pilihan);
        if(cboJadual==''){
                alert("List Personal masih kosong !");
                //document.getElementById("second").focus();
                return false;
        }else{
            document.forms["fAllKirim"].action="?page=AddPersonalAction";
            document.forms["fAllKirim"].submit();
            return true;
        }
    }
    </script>
</head>
<body>
    <table width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           border-bottom: none;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <tr>
           <td colspan="1" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Group | Personal</b></td>
        </tr>
        <td>
            <form id="fAll" name="fAll" method="post">
            <table width="100%" border="0" cellspacing="1" cellpadding="5">
                <input type="hidden" name="kode" id="kode" value="<?php echo $kode;?>" />
            <tr>
              <td width="30">&nbsp;</td>
              <td width="93">&nbsp;</td>
              <td width="4">&nbsp;</td>
              <td width="991">&nbsp;</td>
            </tr>
            <tr <?php //if($jumlah>0)echo 'hidden=""'; ?>>
              <td>&nbsp;</td>
              <td>Kelamin</td>
              <td>:</td>
              <td><label for="cboKelamin"></label>
                  <select name="cboKelamin" id="cboKelamin" onchange="kirim()" >
                  <option value="blank">- All -</option>
                  <option value="1" <?php if($kelamin==1)  echo 'selected=""';?>>Ikhwan</option>
                  <option value="2" <?php if($kelamin==2)  echo 'selected=""';?>>Akhwat</option>
              </select></td>
            </tr>
            <tr <?php //if($jumlah>0)echo 'hidden=""'; ?>>
              <td>&nbsp;</td>
              <td>Kategori</td>
              <td>:</td>
              <td><label for="cboKategori"></label>
                  <select name="cboKategori" id="cboKategori" onchange="kirim()" >
                  <option value="blank">- All-</option>
                  <option value="mukim" <?php if($kategori=='mukim')  echo 'selected=""';?>>Mukim</option>
                  <option value="non mukim"<?php if($kategori=='non mukim')  echo 'selected=""';?>>Nom Mukim</option>
              </select></td>
            </tr>
            </table>
            </form >
            <form id="fAllKirim" name="fAllKirim" method="post">
                     <table width="100%" border="0" cellspacing="1" cellpadding="5" >
                         <tr>
                            <td width="25">&nbsp;</td>
                            <td >
                                <input type="hidden" name="kode" id="kode" value="<?php echo $kode;?>" />
                            </td>
                        </tr>
                         <tr>
                             <td width="27">&nbsp;</td>
                             <td>List Santri <font color="red">*</font></td>
                         </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>
                           <select name="searchable[]" id='second' multiple='multiple'">
                                  <?php
                                    foreach ($allPersonal as $val){
                                  ?>
                               <option value="<?php echo $val->getIdPersonal() ?>" <?php if(in_array($val->getIdPersonal(), $listPersonal)) echo 'selected=""'; ?>>
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
                    <input type="hidden" id="txtPersonalId" name='txtPersonalId' value="<?php echo $kode;?>"/>
                    
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="1"><font color="red">*</font>&nbsp;Harus diisi</td>
                    </tr>
                    <tr>
                      <td colspan="2"><hr width="90%" color="#ccc"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="button" name="bSimpan" id="bInsert" value="Simpan" onClick="validasi();" />
                        <input type="reset" name="bReset" id="bReset" value="Reset" /></td>
                    </tr>
                   <tr>
                      <td>&nbsp;</td>
                      <td colspan="1">&nbsp;</td>
                    </tr>
              </table>
            </form>
        </td>
    </tr>
    </table>
</body>
</html>
