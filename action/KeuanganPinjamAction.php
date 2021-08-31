<?php
include_once './model/KeuanganPinjam.php'; 
include_once './model/Personal.php'; 
include_once './dao/KeuanganPinjamDao.php'; 
$pesan=0;
$keuanganPinjam=new KeuanganPinjam();
$keuanganPinjam->setKode(isset($_POST['txtId']) ? $_POST['txtId'] : '');
$keuanganPinjam->setTglPinjam(isset($_POST['txtTanggalPjm']) ? $_POST['txtTanggalPjm'] : '');
$keuanganPinjam->setTglKembali(isset($_POST['txtTanggalKem']) ? $_POST['txtTanggalKem'] : '');
$keuanganPinjam->setKas(isset($_POST['cboKas']) ? $_POST['cboKas'] : '');
$personal=new Personal();
$personal->setIdPersonal(isset($_POST['txtEmpId']) ? $_POST['txtEmpId'] : '');
$keuanganPinjam->setPersonal($personal);
$keuanganPinjam->setJumlah(str_replace(',', '',isset($_POST['txtJumlah']) ? $_POST['txtJumlah'] : ''));

if($_GET['action']=='insert'){
    $keuanganPinjamDao=new KeuanganPinjamDao();
    if($keuanganPinjam!=null){
            $insert = $keuanganPinjamDao->insert($keuanganPinjam);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=TabPinjam&mode=1'>";
                $pesan=1;
            }
        //}
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
