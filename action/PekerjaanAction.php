<?php
include_once './dao/PekerjaanDao.php';
$pesanKel=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$pekerjaan=NULL;
if($_POST){
    $pekerjaan=new Pekerjaan();
    $pekerjaan->setPekerjaanId( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $pekerjaan->setNamaPekerjaan(isset($_POST['txtNamaPekerjaan']) ? $_POST['txtNamaPekerjaan'] : '');
    $pekerjaan->setKategoriPekerjaan(isset($_POST['cboKategoriPekerjaan']) ? $_POST['cboKategoriPekerjaan'] : '');
    $pekerjaan->setNamaPerusahaan(isset($_POST['txtNamaPerusahaan']) ? $_POST['txtNamaPerusahaan'] : '');
    $pekerjaan->setTelepon( isset($_POST['txtTeepon']) ? $_POST['txtTeepon'] : '');
    $pekerjaan->setAlamat(isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '0');
    $pekerjaan->setKeterangan(isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '');
    $pekerjaan->setPersonalId(isset($_POST['txtPersonalId']) ? $_POST['txtPersonalId'] : '');
}

if($_GET['action']=='insert'){
    $pekerjaanDao=new PekerjaanDao();
    if($pekerjaan!=null){
        $pekerjaanCheck = $pekerjaanDao->getPekerjaanCheck($pekerjaan->getNamaPekerjaan(), $pekerjaan->getPersonalId());
        if($pekerjaanCheck){
            echo "<meta http-equiv='refresh' content='0; url=?page=FamilyInsert&&personalId=".$pekerjaan->getPersonalId()."'>";
            $pesanKel=2;
        }else{
            $insert = $pekerjaanDao->insert($pekerjaan);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=5&Kode=".urlencode(encrypt_url($pekerjaan->getPersonalId()))."'>";
                $pesanKel=1;
            }
        }
    }
}else if($_GET['action']=='update'){
    $pekerjaanDao=new PekerjaanDao();
    if($pekerjaan!=null){
        $pekerjaanCheck = $pekerjaanDao->getPekerjaanCheck($pekerjaan->getNamaPekerjaan(), $pekerjaan->getPersonalId());
        if($pekerjaanCheck && $pekerjaanCheck->getPekerjaanId() != $pekerjaan->getPekerjaanId()){
            echo "<meta http-equiv='refresh' content='0; url=?page=FamilyEdit&Kode=".urlencode(encrypt_url($pekerjaan->getPekerjaanId()))."'>";
            $pesanKel=2;
        }else{
            $insert = $pekerjaanDao->update($pekerjaan);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=5&Kode=".urlencode(encrypt_url($pekerjaan->getPersonalId()))."'>";
                $pesanKel=1;
            }
        }
    }
}else if($_GET['action']=='delete'){
    $pekerjaanDao=new PekerjaanDao();
    if($pekerjaan!=null){
        $insert = $pekerjaanDao->delete($pekerjaan);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=5&Kode=".urlencode(encrypt_url($pekerjaan->getPersonalId()))."'>";
            $pesanKel=1;
        }
    }
}
?>
<script>
    var pesankel=<?php echo $pesanKel; ?>;
    if(pesankel===1){
        alert("Proses Sukses");
    }else if(pesankel===0){
        alert("Proses gagal");
    }else if(pesankel===2){
        alert("Level pekerjaan sudah ada !");
    }
</script>