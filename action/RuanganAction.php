<?php
include_once './dao/RuanganDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$ruangan=NULL;
if($_POST){
    $ruangan=new Ruangan();
    $ruangan->setRunaganId( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $ruangan->setNama(isset($_POST['txtNamaRuangan']) ? $_POST['txtNamaRuangan'] : '');
    $ruangan->setKeterangan(isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '');
}
if($_GET['action']=='insert'){
    $ruanganDao=new RuanganDao();
    if($ruangan!=null){
        $insert = $ruanganDao->insert($ruangan);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=RuaganForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='update'){
    $ruanganDao=new RuanganDao();
    if($ruangan!=null){
        $insert = $ruanganDao->update($ruangan);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=RuaganForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='delete'){
    $ruanganDao=new RuanganDao();
    if($ruangan!=null){
        $insert = $ruanganDao->delete($ruangan);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=RuaganForm'>";
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