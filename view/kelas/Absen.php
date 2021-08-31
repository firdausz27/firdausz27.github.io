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

$idSiswa='';
$idJa='';
$tanggal=  date("m/d/Y");
$nomor=0;
$idAbsen=NULL;
$kajianByJadual=NULL;
if($_POST){
    if(isset($_POST['cboPengajar'])){
        $idSiswa=$_POST['cboPengajar'];
        $allJadual=$jadualDao->getJadualByGuru($idSiswa);
    }
    if(isset($_POST['cboJadual'])){
        $idJa=$_POST['cboJadual'];
        $kajianByJadual = $AddKajianDao->getKajianByJadual($idJa,"0");
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
                        if(document.getElementById("cboStatus_"+i) && document.getElementById("ket_"+i)){
                            var status=document.getElementById("cboStatus_"+i).value;
                            var ket=document.getElementById("ket_"+i).value;
                            var pilih=document.getElementById("check_"+i).checked;
                                if(status=="PRS"&& pilih==false){
                                    alert("Status PRS, kehadiran harus di ceklis");
                                    return false;
                                }else if(ket=="" && pilih==false && status!="ABS"){
                                    alert("Keterangan masih kosong !");
                                    document.getElementById("ket_"+i).focus();
                                    return false;
                                }else{
                                    hasil= true;
                                }
                            }
               }
                if(hasil==true){
                    if(mode=='insert'){
                        document.forms["form1"].action="?page=AbsenAction&action=insert";
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
        }
        
        function actionCheck(){
            var record=document.getElementById("record").value;
            if(document.getElementById("chkSts").checked==true){
                for(i=1;i<=record;i++){
                    document.getElementById("check_"+i).checked=true;
                }
            }
            else{
                for(i=1;i<=record;i++){
                    document.getElementById("check_"+i).checked=false;
                }
            }
        }
        
        
   function kirim(){
            document.forms["form1"].action="?page=Kelas";
            document.forms["form1"].submit();
            return true;
   }
   
</script>
<form id="form1" name="form1" method="post" action="">
  <table  width="100%" border="0" cellspacing="1" cellpadding="5" class="table-shadow">
    <tr>
        <td colspan="5" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Transaksi | Absensi Peseta Didik</b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="3"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Id Absensi</td>
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
          <!--<input type="text" name="txtTanggal" id="txtTanggal" value="<?php echo $tanggl;?>" readonly=""/>--> &nbsp;&nbsp;format tanggal ( mm/dd/YYY )
      </td>
    </tr>
    <tr>
      <td width="50">&nbsp;</td>
      <td width="176">Pengajar</td>
      <td width="3">:</td>
      <td width="930"><select name="cboPengajar" id="cboPengajar" onchange="kirim();" >
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
        <td width="50">&nbsp;</td>
        <td width="176">Absensi Santri</td>
        <td width="3">:</td>
        <td> <input type="button" value="Filter" name="bLoad" onclick="kirim()"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="table-list">
        <tr>
          <th width="3%" scope="col">No</th>
          <th width="32%" scope="col">Nama Santri</th>
          <th width="12%" scope="col"><input type="checkbox" name="chkSts" id="chkSts" onchange="actionCheck()"/>Kehadiran</th>
          <th width="8%" scope="col">Status</th>
          <th width="45%" scope="col">Keterangan</th>
        </tr>
        <?php
        $dataUpdate=false;
        if($kajianByJadual!=null){
            
            foreach ($kajianByJadual as $val){
                $nomor++;
                $absenDao=new AbsensiDao();
                $absensiDtl = $absenDao->getAbsensiDtl($idJa, $val->getIdPersonal(),$tanggal);
                if($absensiDtl!=NULL){
                    $dataUpdate=true;
                }
          ?>
        <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
            <td><?php echo $nomor;?></td>
            <td>
                <b>
                    <?php 
                    if($absensiDtl!=NULL){
                        echo '<a href="#">'.$val->getNamaAwal().' '.$val->getNamaTengah().' '.$val->getNamaAkhir().'</a>';
                    }else{
                         echo $val->getNamaAwal().' '.$val->getNamaTengah().' '.$val->getNamaAkhir();
                    }
                    ?></a>
                </b>
                <input type="hidden"  name="<?php echo 'empid_'.$nomor;?>" value="<?php echo $val->getIdPersonal();?>"/>
            </td>
            <td align='center'>
                <input type="checkbox" 
                                      name="<?php echo 'check_'.$nomor;?>" 
                                      id="<?php echo 'check_'.$nomor;?>" 
                                      <?php if($absensiDtl!=NULL)if($absensiDtl->getStatus()=="PRS")echo 'checked=""'?>/>
            </td>
            <td>
                <select name="<?php echo 'cboStatus_'.$nomor;?>" id="<?php echo 'cboStatus_'.$nomor;?>">
                    <option value="PRS" <?php if($absensiDtl!=NULL)if($absensiDtl->getStatus()=="PRS")echo 'selected=""'?>>PRS</option>
                    <option value="ABS" <?php if($absensiDtl!=NULL)if($absensiDtl->getStatus()=="ABS")echo 'selected=""'?>>ABS</option>
                    <option value="IJN" <?php if($absensiDtl!=NULL)if($absensiDtl->getStatus()=="IJN")echo 'selected=""'?>>IJN</option>
                    <option value="SCK" <?php if($absensiDtl!=NULL)if($absensiDtl->getStatus()=="SCK")echo 'selected=""'?>>SCK</option>
                </select> 
            </td>
            <td><input type="text" name="<?php echo 'ket_'.$nomor;?>" id="<?php echo 'ket_'.$nomor;?>" size="50" maxlength="100" value="<?php if($absensiDtl!=NULL) echo $absensiDtl->getKeterangan();?>"/></td>
        </tr>
        <?php
            }
        }else{            
        ?>
        <tr>
            <td colspan="5" align="center"> ------------------------------------Kosong------------------------------------</td>
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
          if($idAbsen==null){
          ?>
          <input type="button" name="bSimpan" id="bSimpan" value="Simpan" onClick="valid('insert');"/>
          <?php }else{ ?>
          <input type="button" name="bSimpan" id="bUpdate" value="Update" onClick="valid('update');"/>
          <input type="button" name="bDelete" id="bUpdate" value="Delete" onClick="valid('delete');"/>
          <?php }?>
          <input type="reset" name="bReset" id="bReset" value="Reset" />
      </td>
      <td width="1">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><hr width="95%" color="#ccc"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><table width="750" border="0" cellspacing="1" cellpadding="2">
        <tr>
          <td width="49">PRS</td>
          <td width="8">:</td>
          <td width="677">Hadir</td>
        </tr>
        <tr>
          <td>ABS</td>
          <td>:</td>
          <td>Tidak ada kabar</td>
        </tr>
        <tr>
          <td>IJN</td>
          <td>:</td>
          <td>Ijin</td>
        </tr>
        <tr>
          <td>SCK</td>
          <td>:</td>
          <td>Sakit</td>
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
