<?php
include_once './db/DBConnection.php';
$pesan=0;
$koneksi=new DBConnection();
$konnection = $koneksi->getKonnection();
$groupId=isset($_POST['kode']) ? $_POST['kode'] : '';
//lakukan delete untuk memperbaharui menu
$koneksi->begin();
$qDelete="delete from group_menu where group_id=$groupId";
$QryDelete=mysql_query($qDelete,$konnection) or die("Error query :".mysql_error());

$qry1="select * from menu";
$result1=mysql_query($qry1,$konnection)or die("Error query :".mysql_error());
while($row = mysql_fetch_array($result1)){ 
    $checkName=$row['menu_id'];
    if(isset($_POST[$checkName])){
        $qinsert="insert into group_menu (menu_id,group_id) values(".$checkName.",".$groupId.")";
        $qryInsert=mysql_query($qinsert,$konnection)or die("Error query :".mysql_error());
    }
}

if($QryDelete && $qryInsert){
    $koneksi->commit();
    echo "<meta http-equiv='refresh' content='0; url=?page=GroupUpdate&Kode=".$groupId."'>";
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

