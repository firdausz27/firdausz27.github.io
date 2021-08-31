<?php
include_once './dao/KelasDao.php';
include_once './dao/RuanganDao.php';
include_once './dao/PelajaranDao.php';
include_once './dao/PersonalDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$kelas=NULL;
if($_POST){
    $kelas=new Kelas();
    $kelas->setIdKelas( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $kelas->setNamaKelas(isset($_POST['txtNamaKelas']) ? $_POST['txtNamaKelas'] : '');
    $kelas->setKeterangan(isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '');
    $kelas->setKelasPersonal(isset($_POST['pelajar']) ? $_POST['pelajar'] : '');
}
if($_GET['action'] == 'insert'){
    $kelasDao=new KelasDao();
    if($kelas!=null){
            $insert = $kelasDao->insert($kelas);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=KelasForm'>";
                $pesan=1;
            }
    }
}else if($_GET['action']=='update'){
    $kelasDao=new KelasDao();
    if($kelas!=null){
        $insert = $kelasDao->update($kelas);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=KelasForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='delete'){
    $kelasDao=new KelasDao();
    if($kelas!=null){
        $insert = $kelasDao->delete($kelas);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=KelasForm'>";
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
    }else if(pesan===2){
        alert("Kelas sudah ada !");
    }
</script>