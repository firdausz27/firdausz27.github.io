<?php
include_once './dao/KeuanganKasDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$kas=NULL;
if($_POST){
    $kas=new KeuanganKas();
    $kas->setKode( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $kas->setNamaKas(isset($_POST['txtNamaKas']) ? $_POST['txtNamaKas'] : '');
    $kas->setJumlah(str_replace(',', '',isset($_POST['txtJumlah']) ? $_POST['txtJumlah'] : ''));
}
if($_GET['action']=='insert'){
    $kasDao=new KeuanganKasDao();
    if($kas!=null){
        $insert = $kasDao->insert($kas);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=KasKeuanganForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='update'){
    $kasDao=new KeuanganKasDao();
    if($kas!=null){
        $insert = $kasDao->update($kas);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=KasKeuanganForm'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='delete'){
    $kasDao=new KeuanganKasDao();
    if($kas!=null){
        $insert = $kasDao->delete($kas);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=KasKeuanganForm'>";
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