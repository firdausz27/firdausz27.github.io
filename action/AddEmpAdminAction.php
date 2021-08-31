<?php
include_once './db/DBConnection.php';
$pesan=0;
$koneksi=new DBConnection();
$konnection = $koneksi->getKonnection();
$groupId=isset($_POST['kode']) ? $_POST['kode'] : '';
$listEmp=isset($_POST['searchable']) ? $_POST['searchable'] : '';
//lakukan delete untuk memperbaharui menu
$koneksi->begin();

$qDelete="delete from empgroup_admin where empgroup_id=$groupId";
$QryDelete=mysql_query($qDelete,$konnection) or die("Error query :".mysql_error());

foreach ($listEmp as $value){
    $qinsert="insert into empgroup_admin (personal_id,empgroup_id) values('".$value."',".$groupId.")";
    $qryInsert=mysql_query($qinsert,$konnection)or die("Error query :".mysql_error());
}

if($QryDelete && $qryInsert){
    $koneksi->commit();
    echo "<meta http-equiv='refresh' content='0; url=?page=EmpGroupUpdate&Kode=".$groupId."'>";
    $pesan=1;
}else{
    $koneksi->rollback();
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

