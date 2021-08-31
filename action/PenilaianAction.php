<?php
include_once './model/Nilai.php';
include_once './model/NilaiPersonal.php';
include_once './dao/NilaiDao.php';
$pesan=0;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$nilai=NULL;

if($_POST){
    $nilai=new Nilai();
    $nilai->setIdNilai( isset($_POST['txtId']) ? $_POST['txtId'] : '');
    $nilai->setTanggal(isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : '');
    $nilai->setIdPengajar(isset($_POST['cboPengajar']) ? $_POST['cboPengajar'] : '');
    $nilai->setIdJadual(isset($_POST['cboJadual']) ? $_POST['cboJadual'] : '');
    
    $jumlah=isset($_POST['record']) ? $_POST['record'] : '0';
    $listAbsen=array();
    for($i=1;$i<=$jumlah;$i++){
        //mendeskripsikan variable
        $idEmp='empid_'.$i;
        $sopan='cboSopan_'.$i;
        $rajin='cboRajin_'.$i;
        $disiplin='cboDisplin_'.$i;
        $nil='nilai_'.$i;
        $ket='ket_'.$i;
        $lulus='check_'.$i;
        if(isset($_POST[$lulus])){
            //mengambil method post dari personal yang lulus (diceklis)
            $id = $_POST[$idEmp]; 
            $kesopaan=$_POST[$sopan];
            $kerajinan=$_POST[$rajin];
            $kedisiplinan=$_POST[$disiplin];
            $nilaih=$_POST[$nil];
            $keterangan=$_POST[$ket];
            //memasikan kedalam objek nilai personal
            $nilaiPersonal=new NilaiPersonal();
            $nilaiPersonal->setIdNilai($_POST['txtId']);
            $nilaiPersonal->setIdSiswa($id);
            $nilaiPersonal->setDisiplin($kedisiplinan);
            $nilaiPersonal->setKerajinan($kerajinan);
            $nilaiPersonal->setKesopanan($kesopaan);
            $nilaiPersonal->setNilaiKajian($nilaih);
            //menentukan nilai huruf
            $nlaiAngka='';
            $hr=$nilaiPersonal->getNilaiKajian();
            if($hr>='80'){
                $nlaiAngka= 'A';
            }else if($hr>='70'){
                $nlaiAngka= 'B';
            }else if($hr>='60'){
                $nlaiAngka= 'C';
            }else if($hr>='50'){
                $nlaiAngka= 'D';
            }else{
                $nlaiAngka= 'E';
            }
            $nilaiPersonal->setNilaiHuruf($nlaiAngka);
            $nilaiPersonal->setKeterangan($keterangan);
            $listAbsen[]=$nilaiPersonal;
        }
    }
    
}

if($_GET['action']=='insert'){
    $nilaiDao=new NilaiDao();
    if($nilai!=null){
        $nilai0 = $nilaiDao->getNilai($nilai);
        if($nilai0==NULL){
            $insert = $nilaiDao->insert($nilai,$listAbsen);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=Penilaian'>";
                $pesan=1;
            }
        }else{
            echo "<meta http-equiv='refresh' content='0; url=?page=Penilaian'>";
            $pesan=2;
        }
    }
}if($_GET['action']=='insertDetail'){
    $nilaiDao=new NilaiDao();
    if($nilai!=null){
        $nilai0 = $nilaiDao->getNilai($nilai);
        if($nilai0==NULL){
            $insert = $nilaiDao->insertDetail($listAbsen, $nilai->getIdJadual());
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=Penilaian'>";
                $pesan=1;
            }
        }else{
            echo "<meta http-equiv='refresh' content='0; url=?page=Penilaian'>";
            $pesan=2;
        }
    }
}else if($_GET['action']=='update'){
    $nilaiDao=new NilaiDao();
    if($nilai!=null){
        $insert = $nilaiDao->update($nilai,$listAbsen);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=Penilaian'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='delete'){
    $nilaiDao=new NilaiDao();
    if($nilai!=null){
        $insert = $nilaiDao->delete($nilai);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=Penilaian'>";
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
        alert("Penilaian Kajian ini sudah ada, untuk merubah silahkan masuk menu ubah nilai");
    }
</script>