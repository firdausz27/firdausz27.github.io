<?php
include_once './dao/KeuanganKategoriDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$kategori=NULL;
if($_POST){
    $kategori=new KeuanganKategori();
    $kategori->setKode( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $kategori->setNamaKategori(isset($_POST['txtNamaKategori']) ? $_POST['txtNamaKategori'] : '');
    $kategori->setKeterangan(isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '');
}
if($_GET['action']=='insert'){
    $kategoriDao=new KeuanganKategoriDao();
    if($kategori!=null){
        $insert = $kategoriDao->insert($kategori);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=TabEditKategori&mode=1'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='update'){
    $kategoriDao=new KeuanganKategoriDao();
    if($kategori!=null){
        $insert = $kategoriDao->update($kategori);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=TabEditKategori&mode=1'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='delete'){
    $kategoriDao=new KeuanganKategoriDao();
    if($kategori!=null){
        $insert = $kategoriDao->delete($kategori);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=TabEditKategori&mode=1'>";
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