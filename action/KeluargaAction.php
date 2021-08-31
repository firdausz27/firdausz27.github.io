<?php
include_once './dao/KeluargaDao.php';
include_once './dao/PropinsiDao.php'; 
include_once './dao/NegaraDao.php';
$negaraDao=new NegaraDao();
$propinsiDao=new PropinsiDao();
$pesanKel=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$keluarga=NULL;
if($_POST){
    $keluarga=new Keluarga();
    $keluarga->setKeluargaId( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $keluarga->setNama(isset($_POST['txtNama']) ? $_POST['txtNama'] : '');
    $keluarga->setTelepon(isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : '');
    $keluarga->setAlamat(isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '');
    $keluarga->setKota( isset($_POST['txtKota']) ? $_POST['txtKota'] : '');
    $propinsi = $propinsiDao->getPropinsi(isset($_POST['txtPropinsi']) ? $_POST['txtPropinsi'] : '0');
    $keluarga->setPropinsi($propinsi);
    $negara = $negaraDao->getNegara(isset($_POST['txtNegara']) ? $_POST['txtNegara'] : '');
    $keluarga->setNegara($negara);
    $keluarga->setHubungan(isset($_POST['txtHubungan']) ? $_POST['txtHubungan'] : '');
    $keluarga->setPersonalId(isset($_POST['txtPersonalId']) ? $_POST['txtPersonalId'] : '');
}

if($_GET['action']=='insert'){
    $keluargaDao=new KeluargaDao();
    if($keluarga!=null){
       /* $keluargaCheck = $keluargaDao->getKeluargaCheck($keluarga->getNama(), $keluarga->getPersonalId());
        if($keluargaCheck){
            echo "<meta http-equiv='refresh' content='0; url=?page=FamilyInsert&&personalId=".$keluarga->getPersonalId()."'>";
            $pesanKel=2;
        }else{*/
            $insert = $keluargaDao->insert($keluarga);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=4&Kode=".urlencode(encrypt_url($keluarga->getPersonalId()))."'>";
                $pesanKel=1;
            }
        //}
    }
}else if($_GET['action']=='update'){
    $keluargaDao=new KeluargaDao();
    if($keluarga!=null){
        /*$keluargaCheck = $keluargaDao->getKeluargaCheck($keluarga->getNama(), $keluarga->getPersonalId());
        if($keluargaCheck && $keluargaCheck->getKeluargaId() != $keluarga->getKeluargaId()){
            echo "<meta http-equiv='refresh' content='0; url=?page=FamilyEdit&Kode=".$keluarga->getKeluargaId()."'>";
            $pesanKel=2;
        }else{*/
            $insert = $keluargaDao->update($keluarga);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=4&Kode=".urlencode(encrypt_url($keluarga->getPersonalId()))."'>";
                $pesanKel=1;
            }
        //}
    }
}else if($_GET['action']=='delete'){
    $keluargaDao=new KeluargaDao();
    if($keluarga!=null){
        $insert = $keluargaDao->delete($keluarga);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=4&Kode=".urlencode(encrypt_url($keluarga->getPersonalId()))."'>";
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
        alert("Level keluarga sudah ada !");
    }
</script>