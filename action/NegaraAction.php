<?php
include_once './dao/NegaraDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$negarai=NULL;
if($_POST){
    $negarai=new Negara();
    $negarai->setKode( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $negarai->setNama(isset($_POST['txtNama']) ? $_POST['txtNama'] : '');
    $negarai->setKeterangan(isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '');
}
if($_GET['action']=='insert'){
    $negaraDao=new NegaraDao();
    if($negarai!=null){
        $insert = $negaraDao->insert($negarai);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=NegaraForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='update'){
    $negaraDao=new NegaraDao();
    if($negarai!=null){
        $insert = $negaraDao->update($negarai);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=NegaraForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='delete'){
    $negaraDao=new NegaraDao();
    if($negarai!=null){
        $insert = $negaraDao->delete($negarai);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=NegaraForm'>";
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