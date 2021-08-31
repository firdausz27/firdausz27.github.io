<?php
include_once './model/Absensi.php';
include_once './model/AbsensiPersonal.php';
include_once './dao/AbsensiDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$absensi=NULL;
if($_POST){
    $absensi=new Absensi();
    $absensi->setIdAbsen( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $absensi->setTanggal(isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : '');
    $absensi->setPengajarId(isset($_POST['cboPengajar']) ? $_POST['cboPengajar'] : '');
    $absensi->setJdualId(isset($_POST['cboJadual']) ? $_POST['cboJadual'] : '');
    
    $jumlah=isset($_POST['record']) ? $_POST['record'] : '0';
    $listAbsen=array();
    for($i=1;$i<=$jumlah;$i++){
        $idEmp='empid_'.$i;
        $stat='cboStatus_'.$i;
        $ket='ket_'.$i;
        $id = $_POST[$idEmp]; 
        $status=$_POST[$stat];
        $keterangan=$_POST[$ket];
        $absenPersonal=new AbsensiPersonal();
        $absenPersonal->setIdSiswa($id);
        $absenPersonal->setStatus($status);
        $absenPersonal->setKeterangan($keterangan);
        $listAbsen[]=$absenPersonal;
    }
}

if($_GET['action']=='insert'){
    $absensiDao=new AbsensiDao();
    if($absensi!=null){
        $absensi0 = $absensiDao->getAbsensi($absensi);
        if($absensi0==NULL){
            $insert = $absensiDao->insert($absensi,$listAbsen);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=Kelas'>";
                $pesan=1;
            }
        }else{
            echo "<meta http-equiv='refresh' content='0; url=?page=Kelas'>";
            $pesan=2;
        }
    }
}else if($_GET['action']=='update'){
    $absensiDao=new AbsensiDao();
    if($absensi!=null){
        $insert = $absensiDao->update($absensi,$listAbsen);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=Kelas'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='delete'){
    $absensiDao=new AbsensiDao();
    if($absensi!=null){
        $insert = $absensiDao->delete($absensi,$listAbsen);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=Kelas'>";
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
    else if(pesan===2){
        alert("Absen sudah ada, untuk merubah silahkan masuk menu ubah absen");
    }
</script>