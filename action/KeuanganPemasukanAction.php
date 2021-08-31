<?php
include_once './model/KeuanganPemasukanDetail.php';
include_once './model/KeuanganPemasukan.php'; 
include_once './dao/KeuanganPemasukanDao.php'; 
$pesan=0;
$jumlah=isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
$pemaId=isset($_POST['txtId']) ? $_POST['txtId'] : '';
$listPemasuaknDetail=array();
$listCekEmp=array();
for($i=1;$i<=$jumlah;$i++){
    $id='txtKode_'.$i;
    $jml='txtJumlah_'.$i;
    $ket='ket_'.$i;
    $kode=isset($_POST[$id]) ? $_POST[$id] : '';
    $juml=isset($_POST[$jml]) ? $_POST[$jml] : '';
    //lakukan pengecekan data sama
    if(in_array($kode, $listCekEmp)){
        ?>
        <script>
            alert("Santri ada yang sama !");
            history.back();
        </script>
        <?php
    }
    $listCekEmp[]=$kode;
    $keterangan=isset($_POST[$ket]) ? $_POST[$ket] : '';
    $pemasukanDetail=new KeuanganPemasukanDetail();
    $pemasukanDetail->setJumlah(str_replace(',', '',$juml));
    $pemasukanDetail->setKeterangan($keterangan);
    $pemasukanDetail->setPemasukanId($pemaId);
    $pemasukanDetail->setPersonalId($kode);
    $listPemasuaknDetail[]=$pemasukanDetail;
}

$keuanganPemasukan=new KeuanganPemasukan();
$keuanganPemasukan->setKode(isset($_POST['txtId']) ? $_POST['txtId'] : '');
$keuanganPemasukan->setKategori(isset($_POST['cboKategori']) ? $_POST['cboKategori'] : '');
$keuanganPemasukan->setKas(isset($_POST['cboKas']) ? $_POST['cboKas'] : '');
$keuanganPemasukan->setTanggal(isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : '');
$keuanganPemasukan->setPemasukanDetail($listPemasuaknDetail);

if($_GET['action']=='insert'){
    $keuanganPemasukanDao=new KeuanganPemasukanDao();
    if($keuanganPemasukan!=null){
            $insert = $keuanganPemasukanDao->insert($keuanganPemasukan);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=KeuanganPemasukan'>";
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
