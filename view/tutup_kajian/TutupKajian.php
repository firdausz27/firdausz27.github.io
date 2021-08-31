<?php
include_once './dao/JadualDao.php';
include_once './dao/PersonalDao.php';
include_once './dao/AddKajianDao.php';
include_once './dao/AbsensiDao.php';
include_once './dao/NilaiDao.php';
include_once './model/Absensi.php';
$kode=buatKodeYear("absensi");
$tanggl= date('m/d/Y');

$jadualDao=new JadualDao();
$allJadual = array();//$jadualDao->getAllJadual();

$AddKajianDao=new AddKajianDao();
$personalDao=new PersonalDao();
$cariPersonal = $personalDao->getAllPersonal();

$idSiswa='';
$idJa='';
$tanggal=  date("m/d/Y");
$nomor=0;
$kajianByJadual=NULL;
if($_POST){
    if(isset($_POST['cboPengajar'])){
        $idSiswa=$_POST['cboPengajar'];
        $allJadual=$jadualDao->getJadualByGuru($idSiswa);
    }
    if(isset($_POST['cboJadual'])){
        $idJa=$_POST['cboJadual'];
        $kajianByJadual = $AddKajianDao->getKajian($idJa);
        $tanggal=isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : '';
    }
    $absendao=new AbsensiDao();
    $idAbsen = $absendao->getIdAbsen($idJa, $tanggal);
    if($idAbsen!=null){
        $kode=$idAbsen->getIdAbsen();
    }
}
?>
<script type="text/javascript">
    function valid(mode){
            var txtTanggal=document.getElementById("txtTanggal").value;
            var cboPengajar=document.getElementById("cboPengajar").value;
            var cboJadual=document.getElementById("cboJadual").value;
            
            
            if(txtTanggal==""){
                alert("Tanggal masih kosong !");
                return false;
            }if(cboPengajar=="blank"){
                alert("Pengajar masih kosong !");
                return false;
            }if(cboJadual=="blank"){
                alert("Jadual masih kosong !");
                return false;
            }else{
                
                    if(mode=='insert'){
                        document.forms["form1"].action="?page=TutupKajianAction&action=insert";
                        document.forms["form1"].submit();
                        return true;
                    }else if(mode=='update'){
                        document.forms["form1"].action="?page=AbsenAction&action=update";
                        document.forms["form1"].submit();
                        return true;
                    }else{
                        if(confirm('Apakah anda yakin mau menghapus ?')){
                            document.forms["form1"].action="?page=AbsenAction&action=delete";
                            document.forms["form1"].submit();
                            return true;
                        }
                    }
                }
            }
        
        
   function kirim(){
            document.forms["form1"].action="?page=TutupKajian";
            document.forms["form1"].submit();
            return true;
   }
   
</script>
<form id="form1" name="form1" method="post" action="">
  <table  width="100%" border="0" cellspacing="1" cellpadding="5"class="table-shadow">
    <tr>
        <td colspan="5" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Pendidikan | Tutup Kajian</b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="30"></td>
      <td>&nbsp;</td>
    </tr>
    <!--<tr>
      <td>&nbsp;</td>
      <td>Kode</td>
      <td width="30">:</td>
      <td><input type="text" name="txtId" id="txtId" value="<?php// echo $kode;?>" readonly=""/></td>
    </tr>-->
    <tr>
      <td>&nbsp;</td>
      <td>Tanggal</td>
      <td width="30">:</td>
      <td>
          <?php
          $tglTransaksi=  isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('m/d/Y');;
          echo form_tanggal("txtTanggal",$tglTransaksi); 
          ?>
          <!--<input type="text" name="txtTanggal" id="txtTanggal" value="<?php echo $tanggl;?>" readonly=""/>--> &nbsp;&nbsp;format tanggal ( mm/dd/YYY )      </td>
    </tr>
    <tr>
      <td width="27">&nbsp;</td>
      <td width="118">Pengajar</td>
      <td width="30">:</td>
      <td width="786"><select name="cboPengajar" id="cboPengajar" onchange="kirim();">
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
      <td width="30">:</td>
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
        <td width="27">&nbsp;</td>
        <td width="118">&nbsp;</td>
        <td width="30">&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><table width="58%" border="0" cellspacing="1" cellpadding="2" class="table-list">
        <tr>
          <th width="10%" scope="col">No</th>
          <th width="90%" scope="col">Nama Santri</th>
          </tr>
        <?php
        $dataUpdate=false;
        if($kajianByJadual!=null){
            
            foreach ($kajianByJadual as $val){
                $nomor++;
                $nilaiDao=new NilaiDao();
                $allNilaiDetail = $nilaiDao->getValidasiNilai($idJa, $val->getIdPersonal());
                if($allNilaiDetail==NULL){
                    $dataUpdate=true;
                }
          ?>
        <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
            <td><?php echo $nomor;?></td>
            <td>
                <b>
                    <?php 
                         echo $val->getNamaAwal().' '.$val->getNamaTengah().' '.$val->getNamaAkhir();
                    ?></b>
                <input type="hidden"  name="<?php echo 'empid_'.$nomor;?>" value="<?php echo $val->getIdPersonal();?>"/>            </td>
          </tr>
        <?php
            }
        }else{            
        ?>
        <tr>
            <td colspan="2" align="center"> ------------------------------------Kosong------------------------------------</td>
        </tr>
        <?php 
        }
        ?>
        
      </table>
          <input type="hidden" name="record" id="record" value="<?php echo $nomor;?>"/>      </td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">
          <?php if($dataUpdate!=true){?>
          <input type="button" name="bSimpan" id="bSimpan" value="Simpan" onClick="valid('insert');"/>
          <?php } ?>
          <input type="reset" name="bReset" id="bReset" value="Reset" />      </td>
      <td width="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><hr width="95%" color="#ccc"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="30">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<script>
    var pesan=<?php echo $dataUpdate; ?>;
    if(pesan==true){
        alert("Penilaian belum semuanya");
    }
</script>
