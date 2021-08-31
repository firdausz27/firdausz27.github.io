<?php
include_once './dao/PelajaranDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$pelajaran=NULL;
if($_POST){
    $pelajaran=new Pelajaran();
    $pelajaran->setIdPelajran( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $pelajaran->setNamaPelajaran(isset($_POST['txtNamaPelajaran']) ? $_POST['txtNamaPelajaran'] : '');
    $pelajaran->setSks(isset($_POST['txtSks']) ? $_POST['txtSks'] : '');
    $pelajaran->setKategoriPelajaran(isset($_POST['cboKategori']) ? $_POST['cboKategori'] : '');
}

if($_GET['action']=='insert'){
    $pelajaranDao=new PelajaranDao();
    if($pelajaran!=null){
        $insert = $pelajaranDao->insert($pelajaran);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=PelajranForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='update'){
    $pelajaranDao=new PelajaranDao();
    if($pelajaran!=null){
        $insert = $pelajaranDao->update($pelajaran);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=PelajranForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='delete'){
    $pelajaranDao=new PelajaranDao();
    if($pelajaran!=null){
        $insert = $pelajaranDao->delete($pelajaran);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=PelajranForm'>";
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