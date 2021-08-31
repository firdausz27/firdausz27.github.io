<?php
include_once './dao/EmpGroupDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$group=NULL;
if($_POST){
    $group=new Group();
    $group->setKode(isset($_POST['kode']) ? $_POST['kode'] : '');
    $group->setNamaGroup( isset($_POST['txtName']) ? $_POST['txtName'] : '');
    $group->setTglDibuat(isset($_POST['txtTgl']) ? $_POST['txtTgl'] : '');
    $group->setKeterangan(isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '');
}
if($_GET['action']=='insert'){
    $groupDao=new EmpGroupDao();
    if($group!=null){
        $insert = $groupDao->insert($group);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=EmpGroupForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='update'){
    $groupDao=new EmpGroupDao();
    if($group!=null){
        $insert = $groupDao->update($group);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=EmpGroupForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='delete'){
    $groupDao=new EmpGroupDao();
    if($group!=null){
        $insert = $groupDao->delete($group);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=EmpGroupForm'>";
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