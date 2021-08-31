<?php
include_once './dao/JadualDao.php';
include_once './dao/PersonalDao.php';
include_once './dao/AddKajianDao.php';
include_once './model/Nilai.php';
include_once './dao/NilaiDao.php';
$kode=buatKodeYear("nilai");
$tanggl= date('m/d/Y');

$jadualDao=new JadualDao();
$allJadual2 = array();//$jadualDao->getAllJadual();

$AddKajianDao=new AddKajianDao();
$personalDao=new PersonalDao();
$cariPersonal = $personalDao->getCariPersonal("personal_type", "Guru");

$idSiswa='';
$idJa='';
$nomor=0;
$kajianByJadual2=NULL;
if($_POST){
    $absen=new Nilai();
    
    if(isset($_POST['cboAjar'])){
        $idSiswa=$_POST['cboAjar'];
        $absen->setIdPengajar($idSiswa);
        $allJadual2=$jadualDao->getJadualByGuru($idSiswa);
    }
    if(isset($_POST['cboJadual'])){
        $idJa=$_POST['cboJadual'];
        $absen->setIdJadual($idJa);
        $absendao=new NilaiDao();
        $nilai = $absendao->getNilai($absen);
        //$kajianByJadual2 = $AddKajianDao->getKajianByJadual($idJa);
    }
    $absendao=new NilaiDao();
    $nilai = $absendao->getNilai($absen);
    if($nilai!=NULL){
        $kode=$nilai->getIdNilai();
        $kajianByJadual2 = $AddKajianDao->getKajianNotInNilai($idJa, $kode);
    }
}
?>
<script type="text/javascript">
    function valid2(){
            var cboPengajar=document.getElementById("cboAjar").value;
            var cboJadual=document.getElementById("cboJadual2").value;
            var record=document.getElementById("record2").value;
            
            
           if(cboPengajar=="blank"){
                alert("Pengajar masih kosong !");
                return false;
            }else if(cboJadual=="blank"){
                alert("Jadual masih kosong !");
                return false;
            }else{
                var hasil=false;
                for(i=1;i<=record;i++){
                        if(document.getElementById("check2_"+i).checked){
                            var status=document.getElementById("nilai2_"+i).value;
                                if(status=="" || status <0 || status>100){
                                    alert("Input nilai 0 s/d 100");
                                    document.getElementById("nilai2_"+i).focus();
                                }else{
                                    hasil= true;
                                }
                            }
               }
                if(hasil==true){
                    document.forms["fTambah"].action="?page=PenilainAction&action=insertDetail";
                    document.forms["fTambah"].submit();
                    return true;
                }
            }
        }
        
        
   function kirim1(){
            document.forms["fTambah"].action="?page=TabEditNilai&mode=2";
            document.forms["fTambah"].submit();
            return true;
   }
   
</script>
<form id="fTambah" name="fTambah" method="post">
  <table  width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="5" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Transaksi | Penilaian Peseta Didik</b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="3"></td>
      <td><input type="hidden" name="txtId" id="txtId" value="<?php echo $kode;?>" readonly=""/></td>
    </tr>
    <tr>
      <td width="33">&nbsp;</td>
      <td width="188">Pengajar</td>
      <td width="3">:</td>
      <td width="917"><select name="cboAjar" id="cboAjar" onchange="kirim1();">
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
      <td><select name="cboJadual" id="cboJadual2" onchange="kirim1();">
             <option value="blank">- Pilih salah satu -</option>
            <?php
                foreach ($allJadual2 as $valu){
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
        <td width="188">&nbsp;</td>
        <td width="3">&nbsp;</td>
        <td><input type="submit" name="bCari" id="bCari" value="Cari" /></td>
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
        if($kajianByJadual2!=null){
            foreach ($kajianByJadual2 as $val){
                $nomor++;
          ?>
        <tr>
            <td><?php echo $nomor;?></td>
            <td><b><?php echo $val->getNamaAwal().' '.$val->getNamaTengah().' '.$val->getNamaAkhir();?></b>
                <input type="hidden"  name="<?php echo 'empid_'.$nomor;?>" value="<?php echo $val->getIdPersonal();?>"/>
            </td>
             <td align='center'><input type="checkbox" name="<?php echo 'check_'.$nomor;?>" id="<?php echo 'check2_'.$nomor;?>"/></td>
            <td align='center'>
                <select name="<?php echo 'cboSopan_'.$nomor;?>" id="<?php echo 'cboSopan_'.$nomor;?>">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </td>
            <td align='center'>
                <select name="<?php echo 'cboRajin_'.$nomor;?>" id="<?php echo 'cboRajin_'.$nomor;?>">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </td>
            <td align='center'>
                <select name="<?php echo 'cboDisplin_'.$nomor;?>" id="<?php echo 'cboDisplin_'.$nomor;?>">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </td>
            <td><input type="number" name="<?php echo 'nilai_'.$nomor;?>" id="<?php echo 'nilai2_'.$nomor;?>" size="15" maxlength="15"/></td>
            <td><input type="text" name="<?php echo 'ket_'.$nomor;?>" id="<?php echo 'ket_'.$nomor;?>" size="30" maxlength="100"/></td>
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
          <input type="hidden" name="record" id="record2" value="<?php echo $nomor;?>"/>
      </td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">
          <input type="button" name="bSimpan" id="bSimpan" value="Simpan" onClick="valid2();"/>
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
