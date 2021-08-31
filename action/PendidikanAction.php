<?php
include_once './dao/PendidikanDao.php';
$pesanPend=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$pendidikan=NULL;
if($_POST){
    $pendidikan=new Pendidikan();
    $pendidikan->setEducationId( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $pendidikan->setLevelPendidikan(isset($_POST['cboLevel']) ? $_POST['cboLevel'] : '');
    $pendidikan->setTahunMulai(isset($_POST['cboTahunMulai']) ? $_POST['cboTahunMulai'] : '');
    $pendidikan->setTahunSelesai(isset($_POST['cboTahunSelesai']) ? $_POST['cboTahunSelesai'] : '');
    $pendidikan->setInstitusi( isset($_POST['txtInstitusi']) ? $_POST['txtInstitusi'] : '');
    $pendidikan->setNilaiRata(isset($_POST['txtNilaiRata']) ? $_POST['txtNilaiRata'] : '0');
    if($_POST['txtTglIjazah']!=''){
        $pendidikan->setTglIjazah(isset($_POST['txtTglIjazah']) ? InggrisTgl($_POST['txtTglIjazah']) : '');
    }else{
        $pendidikan->setTglIjazah('');
    }
    $pendidikan->setNoIjazah(isset($_POST['txtNoIjazah']) ? $_POST['txtNoIjazah'] : '');
    $pendidikan->setKota(isset($_POST['txtKota']) ? $_POST['txtKota'] : '');
    $pendidikan->setPropinsi(isset($_POST['txtPropinsi']) ? $_POST['txtPropinsi'] : '');
    $pendidikan->setNegara(isset($_POST['txtNegara']) ? $_POST['txtNegara'] : '');
    $pendidikan->setPersonalId(isset($_POST['txtPersonalId']) ? $_POST['txtPersonalId'] : '');
}

if($_GET['action']=='insert'){
    $pendidikanDao=new PendidikanDao();
    if($pendidikan!=null){
        /*$pendidikanCheck = $pendidikanDao->getPendidikanCheck($pendidikan->getLevelPendidikan(), $pendidikan->getPersonalId());
        if($pendidikanCheck){
            echo "<meta http-equiv='refresh' content='0; url=?page=EduInsert&&personalId=".$pendidikan->getPersonalId()."'>";
            $pesanPend=2;
        }else{*/
            if($pendidikan->getNilaiRata()==""){
                $pendidikan->setNilaiRata(0);
            }
            $insert = $pendidikanDao->insert($pendidikan);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=3&Kode=".urlencode(encrypt_url($pendidikan->getPersonalId()))."'>";
                $pesanPend=1;
            }
       // }
    }
}else if($_GET['action']=='update'){
    $pendidikanDao=new PendidikanDao();
    if($pendidikan!=null){
        /*$pendidikanCheck = $pendidikanDao->getPendidikanCheck($pendidikan->getLevelPendidikan(), $pendidikan->getPersonalId());
        if($pendidikanCheck && $pendidikanCheck->getEducationId() != $pendidikan->getEducationId()){
            echo "<meta http-equiv='refresh' content='0; url=?page=EduEdit&Kode=".encrypt_decrypt('encrypt',$pendidikan->getEducationId())."'>";
            $pesanPend=2;
        }else{*/
            $insert = $pendidikanDao->update($pendidikan);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=3&Kode=".urlencode(encrypt_url($pendidikan->getPersonalId()))."'>";
                $pesanPend=1;
            }
        //}
    }
}else if($_GET['action']=='delete'){
    $pendidikanDao=new PendidikanDao();
    if($pendidikan!=null){
        $insert = $pendidikanDao->delete($pendidikan);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=3&Kode=".urlencode(encrypt_url($pendidikan->getPersonalId()))."'>";
            $pesanPend=1;
        }
    }
}
?>
<script>
    var pesanpnd=<?php echo $pesanPend; ?>;
    if(pesanpnd===1){
        alert("Proses Sukses");
    }else if(pesanpnd===0){
        alert("Proses gagal");
    }else if(pesanpnd===2){
        alert("Level pendidikan sudah ada !");
    }
</script>