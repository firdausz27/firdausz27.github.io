<?php
include_once './dao/JadualDao.php';
include_once './dao/RuanganDao.php';
include_once './dao/PelajaranDao.php';
include_once './dao/PersonalDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$jadual=NULL;
if($_POST){
    $jadual=new Jadual();
    $jadual->setJadualId( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $jadual->setHari(isset($_POST['cboHari']) ? $_POST['cboHari'] : '');
    $jadual->setJamMulai(isset($_POST['txtJamMulai']) ? $_POST['txtJamMulai'] : '');
    $jadual->setJamSelesai( isset($_POST['txtJamSelesai']) ? $_POST['txtJamSelesai'] : '');
    $ruangan=new RuanganDao();
    $jadual->setIdRuangan($ruangan->getRuangan(isset($_POST['cboRuangan']) ? $_POST['cboRuangan'] : ''));
    $pelajaran=new PelajaranDao();
    $jadual->setIdPelajaran($pelajaran->getPelajaran(isset($_POST['cboPelajaran']) ? $_POST['cboPelajaran'] : ''));
    $personal=new PersonalDao();
    $jadual->setPengajarId(isset($_POST['pendidik']) ? $_POST['pendidik'] : '');
    $jadual->setPelajar(isset($_POST['pesertaDidik']) ? $_POST['pesertaDidik'] : '');
    $jadual->setKeals(isset($_POST['cboKelas']) ? $_POST['cboKelas'] : '');
}
if($_GET['action']=='insert'){
    $jadualDao=new JadualDao();
    if($jadual!=null){
       /* if($jadualDao->getValidasiJadual($jadual)!=NULL){
            echo "<meta http-equiv='refresh' content='0; url=?page=JadualInsert'>";
            $pesan=2;  
        }else{*/
            $insert = $jadualDao->insert($jadual);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=JadualForm'>";
                $pesan=1;
            }
        //}
    }
}else if($_GET['action']=='update'){
    $jadualDao=new JadualDao();
    if($jadual!=null){
        $insert = $jadualDao->update($jadual);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=JadualForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='delete'){
    $jadualDao=new JadualDao();
    if($jadual!=null){
        $insert = $jadualDao->delete($jadual);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=JadualForm'>";
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
        alert("Jadual sudah ada !");
    }
</script>