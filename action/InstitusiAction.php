<?php
include_once './dao/InstitusiDao.php';
$pesan=0;
$institusi=new Institusi();
$institusi->setNamaInstitusi(isset($_POST['txtNama']) ? $_POST['txtNama'] : '');
$institusi->setTeleon(isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : '');
$institusi->setAlamat(isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '');
$institusi->setVisi(isset($_POST['txtVisi']) ? $_POST['txtVisi'] : '');
$institusi->setMisi(isset($_POST['txtMisi']) ? $_POST['txtMisi'] : '');
$institusi->setKode(isset($_POST['txtId']) ? $_POST['txtId'] : '');

if($_GET['action']=='insert'){
    $institusiDao=new InstitusiDao();
    if($institusi!=null){
        $insert = $institusiDao->insert($institusi);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=LembagaInsert'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='update'){
    $institusiDao=new InstitusiDao();
    if($institusi!=null){
        $insert = $institusiDao->update($institusi);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=LembagaInsert'>";
            $pesan=1;
        }
    }
}
?>
<script>
    var pesan=<?php echo $pesan; ?>;
    if(pesan===1){
        alert("Proses Sukses");
    }else if(pesan===0){
        alert("Proses gagal");
    }
</script>