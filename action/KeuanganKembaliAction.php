<?php
include_once './model/KeuanganKembali.php'; 
include_once './dao/KeuanganKembaliDao.php'; 
$pesan=0;
$keuanganKembali=new KeuanganKembali();
$keuanganKembali->setKode(isset($_POST['txtIdK']) ? $_POST['txtIdK'] : '');
$keuanganKembali->setTanggal(isset($_POST['txtTanggalK']) ? $_POST['txtTanggalK'] : '');
$keuanganKembali->setIdPinjam(isset($_POST['txtPinjamId']) ? $_POST['txtPinjamId'] : '');
$keuanganKembali->setJumlah(str_replace(',', '',isset($_POST['txtJumlahK']) ? $_POST['txtJumlahK'] : ''));

if($_GET['action']=='insert'){
    $keuanganKembaliDao=new KeuanganKembaliDao();
    if($keuanganKembali!=null){
            $insert = $keuanganKembaliDao->insert($keuanganKembali);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=TabPinjam&mode=2'>";
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
