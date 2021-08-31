<?php
include_once './dao/JadualDao.php';
include_once './dao/PersonalDao.php';
include_once './dao/AddKajianDao.php';
include_once './model/Nilai.php';
include_once './dao/NilaiDao.php';
$kode=buatKodeYear("nilai");
$tanggl= date('m/d/Y');

$jadualDao=new JadualDao();
$allJadual = $jadualDao->getAllJadual();

$AddKajianDao=new AddKajianDao();
$personalDao=new PersonalDao();
$cariPersonal = $personalDao->getCariPersonal("personal_type", "Guru");

$idSiswa='';
$idJa='';
$nomor=0;
//$kajianByJadual=NULL;
$nilaiDetail=NULL;
if($_POST){
    $absen=new Nilai();
    $absen->setTanggal($_POST['txtTanggal']);
    $tanggl=$_POST['txtTanggal'];
    if(isset($_POST['cboPengajar'])){
        $idSiswa=$_POST['cboPengajar'];
        $absen->setIdPengajar($idSiswa);
        //$allJadual=$jadualDao->getJadualByGuru($idSiswa);
    }
    if(isset($_POST['cboJadual'])){
        $idJa=$_POST['cboJadual'];
        $absen->setIdJadual($idJa);
        //$kajianByJadual = $AddKajianDao->getKajianByJadual($idJa);
    }
    $absendao=new NilaiDao();
    $nilai = $absendao->getNilai($absen);
    if($nilai!=NULL){
        $kode=$nilai->getIdNilai();
        $nilaiDetail = $absendao->getNilaiDetail($nilai->getIdNilai());
    }
}
?>
<script type="text/javascript">
   function valid(){
            var txtId=document.getElementById("txtId").value;
            var txtTanggal=document.getElementById("txtTanggal").value;
            var cboPengajar=document.getElementById("cboPengajar").value;
            var cboJadual=document.getElementById("cboJadual").value;
            var record=document.getElementById("record").value;
            
            
            if(txtId==""){
                alert("Kode masih kosong !");
                return false;
            }if(txtTanggal==""){
                alert("Tanggal masih kosong !");
                return false;
            }if(cboPengajar=="blank"){
                alert("Pengajar masih kosong !");
                return false;
            }if(cboJadual=="blank"){
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
                                    return false;
                                }else{
                                    hasil= true;
                                }
                            }
               }
                if(hasil==true){
                    document.forms["form1"].action="?page=PenilainAction&action=update";
                    document.forms["form1"].submit();
                    return true;
                }
            }
        }
        
        
   function kirim(){
        var txtTanggal=document.getElementById("txtTanggal").value;
        var cboPengajar=document.getElementById("cboPengajar").value;
        if(txtTanggal==""){
            alert("Tanggal masih kosong !");
            return false;
        }if(cboPengajar=="blank"){
            alert("Pengajar masih kosong !");
            return false;
        }else{
            document.forms["form1"].action="?page=PenilaianEdit";
            document.forms["form1"].submit();
            return true;
        }
   }
   
    $(function() {
                $('#txtTanggal').datepick();
        });
   
</script>
<form id="form1" name="form1" method="post" action="">
  <table  width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="5" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Transaksi |Edit Nilai Peseta Didik</b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="3"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Id Nilai</td>
      <td width="3">:</td>
      <td><input type="text" name="txtId" id="txtId" value="<?php echo $kode;?>" readonly=""/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Tanggal</td>
      <td width="3">:</td>
      <td><input type="text" name="txtTanggal" id="txtTanggal" value="<?php echo $tanggl;?>"/> &nbsp;&nbsp;format tanggal ( mm/dd/YYY )</td>
    </tr>
    <tr>
      <td width="50">&nbsp;</td>
      <td width="176">Pengajar</td>
      <td width="3">:</td>
      <td width="930"><select name="cboPengajar" id="cboPengajar" <!--onchange="kirim();"-->>
        <option value="blank">- Pilih salah satu -</option>
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
        <td width="50">&nbsp;</td>
        <td width="176">Edit Nilai Santri</td>
        <td width="3">:</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="table-list">
        <tr>
          <th width="4%" scope="col">No</th>
          <th width="25%" scope="col">Nama Santri</th>
          <th width="5%" scope="col"><!--Lulus--></th>
          <th width="8%" scope="col">Sopan</th>
          <th width="8%" scope="col">Rajinan</th>
          <th width="8%" scope="col">Displin</th>
          <th width="10%" scope="col">Nilai Kajian</th>
          <th width="25%" scope="col">Keterangan</th>
        </tr>
        <?php
        if($nilaiDetail!=null){
            foreach ($nilaiDetail as $val){
                $nomor++;
                
          ?>
        <tr>
            <td><?php echo $nomor;?></td>
            <td><b><?php echo $val->getIdSiswa()->getNamaAwal().' '.$val->getIdSiswa()->getNamaTengah().' '.$val->getIdSiswa()->getNamaAkhir();?></b>
                <input type="hidden"  name="<?php echo 'empid_'.$nomor;?>" value="<?php echo $val->getIdSiswa()->getIdPersonal();?>"/>
            </td>
            <td align='center'><input type="checkbox" hidden="" name="<?php echo 'check_'.$nomor;?>" 
                                      id="<?php echo 'check_'.$nomor;?>" <?php if($val->getNilaiKajian()!='')echo 'checked=""'?>/></td>
            <td>
                <select name="<?php echo 'cboSopan_'.$nomor;?>" id="<?php echo 'cboSopan_'.$nomor;?>">
                    <option value="A" <?php if($val->getKesopanan()=='A')echo 'selected=""'?>>A</option>
                    <option value="B" <?php if($val->getKesopanan()=='B')echo 'selected=""'?>>B</option>
                    <option value="C" <?php if($val->getKesopanan()=='C')echo 'selected=""'?>>C</option>
                    <option value="D" <?php if($val->getKesopanan()=='D')echo 'selected=""'?>>D</option>
                    <option value="E" <?php if($val->getKesopanan()=='E')echo 'selected=""'?>>E</option>
                </select>
            </td>
            <td>
                <select name="<?php echo 'cboRajin_'.$nomor;?>" id="<?php echo 'cboSopan_'.$nomor;?>">
                    <option value="A" <?php if($val->getKerajinan()=='A')echo 'selected=""'?>>A</option>
                    <option value="B" <?php if($val->getKerajinan()=='B')echo 'selected=""'?>>B</option>
                    <option value="C" <?php if($val->getKerajinan()=='C')echo 'selected=""'?>>C</option>
                    <option value="D" <?php if($val->getKerajinan()=='D')echo 'selected=""'?>>D</option>
                    <option value="E" <?php if($val->getKerajinan()=='E')echo 'selected=""'?>>E</option>
                </select>
            </td>
            <td>
                <select name="<?php echo 'cboDisplin_'.$nomor;?>" id="<?php echo 'cboSopan_'.$nomor;?>">
                    <option value="A" <?php if($val->getDisiplin()=='A')echo 'selected=""'?>>A</option>
                    <option value="B" <?php if($val->getDisiplin()=='B')echo 'selected=""'?>>B</option>
                    <option value="C" <?php if($val->getDisiplin()=='C')echo 'selected=""'?>>C</option>
                    <option value="D" <?php if($val->getDisiplin()=='D')echo 'selected=""'?>>D</option>
                    <option value="E" <?php if($val->getDisiplin()=='E')echo 'selected=""'?>>E</option>
                </select>
            </td>
            <td><input type="number" name="<?php echo 'nilai_'.$nomor;?>" id="<?php echo 'nilai_'.$nomor;?>" size="15" maxlength="15" value="<?php echo $val->getNilaiKajian();?>"/></td>
            <td><input type="text" name="<?php echo 'ket_'.$nomor;?>" id="<?php echo 'ket_'.$nomor;?>" size="30" maxlength="100" value="<?php echo $val->getKeterangan();?>"/></td>
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
          <input type="button" name="bSimpan" id="bSimpan" value="Ubah" onClick="valid();"/>
          <input type="reset" name="bReset" id="bReset" value="Reset" />
      </td>
      <td width="1">&nbsp;</td>
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
