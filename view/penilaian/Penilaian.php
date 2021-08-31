<?php
include_once './dao/JadualDao.php';
include_once './dao/PersonalDao.php';
include_once './dao/AddKajianDao.php';
include_once './dao/NilaiDao.php';


$kode=buatKodeYear("nilai");
$tanggl= date('m/d/Y');

$jadualDao=new JadualDao();
$allJadual = array();//$jadualDao->getAllJadual();

$AddKajianDao=new AddKajianDao();
$personalDao=new PersonalDao();
$cariPersonal = $personalDao->getAllPersonal();

$idSiswa='';
$idJa='';
$nomor=0;
$kajianByJadual=NULL;
$tanggal=  date("m/d/Y");
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
    $nilDao=new NilaiDao();
    $idNiali = $nilDao->getIdNiali($idJa, $idSiswa);
    if($idNiali!=null){
        $kode=$idNiali->getIdNilai();
    }
}
?>
<script type="text/javascript">
    function valid(mode){
            var txtId=document.getElementById("txtId").value;
            var txtTanggal=document.getElementById("txtTanggal").value;
            var cboPengajar=document.getElementById("cboPengajar").value;
            var cboJadual=document.getElementById("cboJadual").value;
            var record=document.getElementById("record").value;
            
            
            if(txtId==""){
                alert("Kode masih kosong !");
                return false;
            }else if(txtTanggal==""){
                alert("Tanggal masih kosong !");
                return false;
            }else if(cboPengajar=="blank"){
                alert("Pengajar masih kosong !");
                return false;
            }else if(cboJadual=="blank"){
                alert("Jadual masih kosong !");
                return false;
            }else{
                var hasil=false;
                for(i=1;i<=record;i++){
                        if(document.getElementById("check_"+i).checked){
                            var status=document.getElementById("nilai_"+i).value;
                                if(status=="" || status <0 || status>100){
                                    alert("Input nilai 0 s/d 100");
                                    document.getElementById("nilai_"+i).focus();
                                }else{
                                    hasil= true;
                                }
                            }
               }
                if(hasil==true){
                    if(mode=='insert'){
                        document.forms["form1"].action="?page=PenilainAction&action=insert";
                        document.forms["form1"].submit();
                        return true;
                    }else if(mode=='update'){
                        document.forms["form1"].action="?page=PenilainAction&action=update";
                        document.forms["form1"].submit();
                        return true;
                    }else{
                        if(confirm('Apakah anda yakin mau menghapus ?')){
                            document.forms["form1"].action="?page=PenilainAction&action=delete";
                            document.forms["form1"].submit();
                            return true;
                        }
                    }
                }
            }
        }
        
        
   function kirim(){
            document.forms["form1"].action="?page=Penilaian";
            document.forms["form1"].submit();
            return true;
   }
   
</script>
<form id="form1" name="form1" method="post" action="">
  <table  width="100%" border="0" cellspacing="1" cellpadding="5" class="table-shadow">
    <tr>
        <td colspan="5" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Transaksi | Penilaian Peseta Didik</b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="3"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Id Penilaian</td>
      <td width="3">:</td>
      <td><input type="text" name="txtId" id="txtId" value="<?php echo $kode;?>" readonly=""/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tanggal</td>
      <td width="3">:</td>
      <td>
          <?php
          $tglTransaksi=  isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('m/d/Y');;
          echo form_tanggal("txtTanggal",$tglTransaksi); 
          ?>
          <!--<input type="text" name="txtTanggal" id="txtTanggal" value="<?php //echo $tanggl;?>" readonly=""/>--> &nbsp;&nbsp;format tanggal ( mm/dd/yyyy )</td>
    </tr>
    <tr>
      <td width="33">&nbsp;</td>
      <td width="188">Pengajar</td>
      <td width="3">:</td>
      <td width="917"><select name="cboPengajar" id="cboPengajar" onchange="kirim();">
        <option value="blank">- Pilih salah satu -</option>
            <?php
            foreach ($cariPersonal as $val){
            ?>
              <option value="<?php  echo $val->getIdPersonal()?>" 
              <?php if($idSiswa ==$val->getIdPersonal())     echo "selected=''";?> >
              <?php echo $val->getNamaAwal()." ".$val->getNamaTengah()." ".$val->getNamaAkhir()." -- ". $val->getIdPersonal() ?>
              </option>
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
        <td width="33">&nbsp;</td>
        <td width="188">Nilai Santri</td>
        <td width="3">:</td>
        <td><input type="button" value="Saring" onclick="kirim()" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="table-list">
        <tr>
          <th width="4%" scope="col">No</th>
          <th width="25%" scope="col">Nama Santri</th>
          <th width="5%" scope="col">Lulus</th>
          <th width="8%" scope="col">Sopan</th>
          <th width="8%" scope="col">Rajinan</th>
          <th width="8%" scope="col">Displin</th>
          <th width="10%" scope="col">Nilai Kajian</th>
          <th width="25%" scope="col">Keterangan</th>
        </tr>
        <?php
        $dataUpdate=false;
        if($kajianByJadual!=null){
            foreach ($kajianByJadual as $val){
                $nomor++;
                $nilaiDao=new NilaiDao();
                $allNilaiDetail = $nilaiDao->getAllNilaiDetail($kode, $val->getIdPersonal());
                if($allNilaiDetail!=NULL){
                    $dataUpdate=true;
                }
          ?>
        <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
            <td><?php echo $nomor;?></td>
            <td><b><?php echo $val->getNamaAwal().' '.$val->getNamaTengah().' '.$val->getNamaAkhir();?></b>
                <input type="hidden"  name="<?php echo 'empid_'.$nomor;?>" value="<?php echo $val->getIdPersonal();?>"/>
            </td>
             <td align='center'><input type="checkbox" name="<?php echo 'check_'.$nomor;?>" id="<?php echo 'check_'.$nomor;?>" 
                                       <?php if($allNilaiDetail) echo 'checked=""';?>/></td>
            <td align='center'>
                <select name="<?php echo 'cboSopan_'.$nomor;?>" id="<?php echo 'cboSopan_'.$nomor;?>">
                    <option value="A" <?php if($allNilaiDetail)if($allNilaiDetail->getKesopanan()=="A")echo 'selected=""'?>>A</option>
                    <option value="B" <?php if($allNilaiDetail)if($allNilaiDetail->getKesopanan()=="B")echo 'selected=""'?>>B</option>
                    <option value="C" <?php if($allNilaiDetail)if($allNilaiDetail->getKesopanan()=="C")echo 'selected=""'?>>C</option>
                    <option value="D" <?php if($allNilaiDetail)if($allNilaiDetail->getKesopanan()=="D")echo 'selected=""'?>>D</option>
                    <option value="E" <?php if($allNilaiDetail)if($allNilaiDetail->getKesopanan()=="E")echo 'selected=""'?>>E</option>
                </select>
            </td>
            <td align='center'>
                <select name="<?php echo 'cboRajin_'.$nomor;?>" id="<?php echo 'cboRajin_'.$nomor;?>">
                    <option value="A" <?php if($allNilaiDetail)if($allNilaiDetail->getKerajinan()=="A")echo 'selected=""'?>>A</option>
                    <option value="B" <?php if($allNilaiDetail)if($allNilaiDetail->getKerajinan()=="B")echo 'selected=""'?>>B</option>
                    <option value="C" <?php if($allNilaiDetail)if($allNilaiDetail->getKerajinan()=="C")echo 'selected=""'?>>C</option>
                    <option value="D" <?php if($allNilaiDetail)if($allNilaiDetail->getKerajinan()=="C")echo 'selected=""'?>>D</option>
                    <option value="E" <?php if($allNilaiDetail)if($allNilaiDetail->getKerajinan()=="D")echo 'selected=""'?>>E</option>
                </select>
            </td>
            <td align='center'>
                <select name="<?php echo 'cboDisplin_'.$nomor;?>" id="<?php echo 'cboDisplin_'.$nomor;?>">
                    <option value="A" <?php if($allNilaiDetail)if($allNilaiDetail->getDisiplin()=="A")echo 'selected=""'?>>A</option>
                    <option value="B" <?php if($allNilaiDetail)if($allNilaiDetail->getDisiplin()=="B")echo 'selected=""'?>>B</option>
                    <option value="C" <?php if($allNilaiDetail)if($allNilaiDetail->getDisiplin()=="C")echo 'selected=""'?>>C</option>
                    <option value="D" <?php if($allNilaiDetail)if($allNilaiDetail->getDisiplin()=="D")echo 'selected=""'?>>D</option>
                    <option value="E" <?php if($allNilaiDetail)if($allNilaiDetail->getDisiplin()=="E")echo 'selected=""'?>>E</option>
                </select>
            </td>
            <td><input type="number" name="<?php echo 'nilai_'.$nomor;?>" id="<?php echo 'nilai_'.$nomor;?>" size="15" maxlength="15" value="<?php if($allNilaiDetail)echo $allNilaiDetail->getNilaiKajian();?>"/></td>
            <td><input type="text" name="<?php echo 'ket_'.$nomor;?>" id="<?php echo 'ket_'.$nomor;?>" size="30" maxlength="100" <?php if($allNilaiDetail)echo $allNilaiDetail->getKeterangan();?>/></td>
        </tr>
        <?php
            }
        }else{            
        ?>
        <tr>
            <td colspan="8" align="center"> ------------------------------------Kosong------------------------------------</td>
        </tr>
        <?php 
        }
        ?>
        
      </table>
          <input type="hidden" name="record" id="record" value="<?php echo $nomor;?>"/>
      </td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">
           <?php
          if($dataUpdate==false){
          ?>
          <input type="button" name="bSimpan" id="bSimpan" value="Simpan" onClick="valid('insert');"/>
           <?php }else{ ?>
          <input type="button" name="bSimpan" id="bUpdate" value="Update" onClick="valid('update');"/>
          <input type="button" name="bDelete" id="bUpdate" value="Delete" onClick="valid('delete');"/>
          <?php }?>
          <input type="reset" name="bReset" id="bReset" value="Reset" />
      </td>
      <td width="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><hr width="95%" color="#ccc"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><table width="572" border="0" cellspacing="1" cellpadding="2">
        <tr>
          <td width="34">A</td>
          <td width="6">:</td>
          <td width="143">Terpuji</td>
          <td width="368">Masukan nilai kajian ( 0 S/D 100 )</td>
        </tr>
        <tr>
          <td>B</td>
          <td>:</td>
          <td>Baik</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>C</td>
          <td>:</td>
          <td>Cukup</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>D</td>
          <td>:</td>
          <td>Kurang</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>E</td>
          <td>:</td>
          <td>Buruk</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
