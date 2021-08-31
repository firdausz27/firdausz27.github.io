<?php
include_once './model/KeuanganPengeluaranDetail.php';
include_once './model/KeuanganPengeluaran.php'; 
include_once './dao/KeuanganPengeluaranDao.php'; 
$pesan=0;
$jumlah=isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
$pemaId=isset($_POST['txtId']) ? $_POST['txtId'] : '';
$listPemasuaknDetail=array();
$listCekEmp=array();
for($i=1;$i<=$jumlah;$i++){
    $id='txtNama_'.$i;
    $jml='txtJumlah_'.$i;
    $ket='ket_'.$i;
    $kode=isset($_POST[$id]) ? $_POST[$id] : '';
    $juml=isset($_POST[$jml]) ? $_POST[$jml] : '';
    $keterangan=isset($_POST[$ket]) ? $_POST[$ket] : '';
    $pengeluaranDetail=new KeuanganPengeluaranDetail();
    $pengeluaranDetail->setJumlah(str_replace(',', '',$juml));
    $pengeluaranDetail->setKeterangan($keterangan);
    $pengeluaranDetail->setPengeluaranId($pemaId);
    $pengeluaranDetail->setNamaPengeluaran($kode);
    $listPemasuaknDetail[]=$pengeluaranDetail;
}

$keuanganPengeluaran=new KeuanganPengeluaran();
$keuanganPengeluaran->setKode(isset($_POST['txtId']) ? $_POST['txtId'] : '');
$keuanganPengeluaran->setKategori(isset($_POST['cboKategori']) ? $_POST['cboKategori'] : '');
$keuanganPengeluaran->setKas(isset($_POST['cboKas']) ? $_POST['cboKas'] : '');
$keuanganPengeluaran->setTanggal(isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : '');
$keuanganPengeluaran->setPengeluaranDetail($listPemasuaknDetail);

if($_GET['action']=='insert'){
    $keuanganPengeluaranDao=new KeuanganPengeluaranDao();
    if($keuanganPengeluaran!=null){
            $insert = $keuanganPengeluaranDao->insert($keuanganPengeluaran);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=KeuanganPengeluaran'>";
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
