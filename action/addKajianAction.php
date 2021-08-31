<?php
include_once './dao/AddKajianDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if($_POST){
    $siswa=isset($_POST['cboSiswa']) ? $_POST['cboSiswa'] : '';
    $listJadual=isset($_POST['searchable']) ? $_POST['searchable'] : '';
}
if($_GET['action']=='insert'){
    $addKajian=new AddKajianDao();
    if($siswa!=''&&$listJadual!=''){
        $insert = $addKajian->insert($siswa,$listJadual);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=AddKajian'>";
            $pesan=1;
        }
    }else{
        echo "<meta http-equiv='refresh' content='0; url=?page=AddKajian'>";
        $pesan=2;
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
    }else if(pesan===2){
        alert("List Jadual masih kosong !");
    }
</script>