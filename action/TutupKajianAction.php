<?php
include_once './model/TutupKajian.php';
include_once './dao/tutupKajianDao.php';

$pesan=0;
if($_POST){
    $tutup=new TutupKajian();
    $tutup->setTanggal( isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : '');
    $tutup->setJadualId(isset($_POST['cboJadual']) ? $_POST['cboJadual'] : '');
    if($_GET['action']=='insert'){
         $tutupkajian=new tutupKajianDao();
            if($tutup!=null){
                    $insert = $tutupkajian->insert($tutup);
                    if($insert){
                        echo "<meta http-equiv='refresh' content='0; url=?page=JadualForm'>";
                        $pesan=1;
                    }
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
