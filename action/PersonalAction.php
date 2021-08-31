<?php
include_once './dao/PersonalDao.php';
include_once './model/User.php';

$pesan=0;
$personal=NULL;
$user=NULL;
if($_POST){
    $ukuran_berkas = $_FILES['txtGamabr']['size'];
    //lakukan validasi ukuran berkas
    
        //membuat objek personal
        $personal=new Personal();
        $personal->setIdPersonal( isset($_POST['txtId']) ? $_POST['txtId'] : '');
        $personal->setNis(isset($_POST['txtNIS']) ? $_POST['txtNIS'] : '');
        $personal->setNamaAwal(isset($_POST['txtNamaAwal']) ? $_POST['txtNamaAwal'] : '');
        $personal->setNamaTengah(isset($_POST['txtNamaTengah']) ? $_POST['txtNamaTengah'] : '');
        $personal->setNamaAkhir( isset($_POST['txtNamaAkhir']) ? $_POST['txtNamaAkhir'] : '');
        $personal->setTempatLahir(isset($_POST['txtTempatLahir']) ? $_POST['txtTempatLahir'] : '');
        $personal->setTglLahir(isset($_POST['txtTglLahir']) ? $_POST['txtTglLahir'] : '');
        $personal->setTelepon(isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : '');    
        $personal->setAlamat( isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '');
        $personal->setKota(isset($_POST['txtKota']) ? $_POST['txtKota'] : '');
        $personal->setPropinsi(isset($_POST['txtPropinsi']) ? $_POST['txtPropinsi'] : '');
        $personal->setNegara(isset($_POST['txtNegara']) ? $_POST['txtNegara'] : '');
        $personal->setEmail( isset($_POST['cboEmail']) ? $_POST['cboEmail'] : '');
        $personal->setTglGabung(isset($_POST['tglGabung']) ? $_POST['tglGabung'] : '');
        
        $personal->setKelamin(isset($_POST['Kelamin']) ? $_POST['Kelamin'] : '');
        $personal->setKategoriSantri(isset($_POST['cboKatSantri']) ? $_POST['cboKatSantri'] : '');
        $personal->setListMenu(isset($_POST['listMenu']) ? $_POST['listMenu'] : '');
        $personal->setListInstitusi(isset($_POST['listInstitusi']) ? $_POST['listInstitusi'] : '');
        $personal->setStatusPerkawinan(isset($_POST['cboStatusPerkawinan']) ? $_POST['cboStatusPerkawinan'] : '');
        $personal->setKegiatan(isset($_POST['txtKegiatan']) ? $_POST['txtKegiatan'] : '');
        $personal->setNamaPanggilan(isset($_POST['txtNamaPanggilan']) ? $_POST['txtNamaPanggilan'] : '');
        //menbuat objek user
        $user=new User();
        $user->setUserId(isset($_POST['txtIdUser']) ? $_POST['txtIdUser'] : '');
        $user->setUsername(isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '');
        $user->setPassword(isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '');
        $user->setPertanyaan(isset($_POST['txtPertanyaan']) ? $_POST['txtPertanyaan'] : '');
        $user->setJawaban(isset($_POST['txtJawaban']) ? $_POST['txtJawaban'] : '');
        $user->setLevel(isset($_POST['cboLevel']) ? $_POST['cboLevel'] : '');

        $mode=isset($_POST['mode']) ? $_POST['mode'] : '';
    //  if($ukuran_berkas <= 100000){
        $personal->setFoto($personal->getIdPersonal()."_".$_FILES['txtGamabr']['name']);
        $folder="./foto/";
        $folder=$folder.basename($personal->getIdPersonal()."_".$_FILES['txtGamabr']['name']); 
    //  }
    
}

if($_GET['action']=='insert'){
    // if($ukuran_berkas <= 100000){
        $personalDao=new PersonalDao();
        if($personal!=null){
            $validaiUsername = $personalDao->getValidaiUsername($user->getUsername());
            if($validaiUsername ==NULL){
                if($personal->getFoto() !=$personal->getIdPersonal()."_"){
                    move_uploaded_file($_FILES['txtGamabr']['tmp_name'], $folder);
                }else{
                    $personal->setFoto("images2.jpg");
                }
                $insert = $personalDao->insert($personal, $user);
                if($insert){
                    echo "<meta http-equiv='refresh' content='0; url=?page=PersonalForm'>";
                    $pesan=1;
                }
            }else{
                 echo "<meta http-equiv='refresh' content='0; url=?page=Personal'>";
                 $pesan=2;
            }
        }
    // }
    // else{
    //     ?>
    //     <script>
    //         alert("Ukuran Foto maksimal 0,1 MB !");
    //         history.back();
    //     </script>
    //     <?php
    // }
}if($_GET['action']=='insert&complate'){
    $personalDao=new PersonalDao();
    if($personal!=null){
        if($personal->getFoto() !=$personal->getIdPersonal()."_"){
            move_uploaded_file($_FILES['txtGamabr']['tmp_name'], $folder);
        }else{
            $personal->setFoto("images2.jpg");
        }
        $insert = $personalDao->insert($personal, $user);
        if($insert){
             echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=3&Kode=".urlencode(encrypt_url($personal->getIdPersonal()))."'>";
            $pesan=1;
        }
    }
}else if($_GET['action']=='update'){
    if($ukuran_berkas <= 100000){
        $personalDao=new PersonalDao();
        if($personal!=null){
            if($personal->getFoto() !=$personal->getIdPersonal()."_"){
                move_uploaded_file($_FILES['txtGamabr']['tmp_name'], $folder);
            }else{
                $personal0 = $personalDao->getPersonal($personal->getIdPersonal());
                $personal->setFoto($personal0->getFoto());
            }
            $insert = $personalDao->update($personal,$user);
            if($insert){
                //echo "<meta http-equiv='refresh' content='0; url=?page=PersonalForm'>";
                echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=1&Kode=".urlencode(encrypt_url($personal->getIdPersonal()))."'>";
                $pesan=1;

            }
        }
    }else{
        ?>
        <script>
            alert("Ukuran Foto maksimal 0,1 MB !");
        </script>
        <?php
        echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&mode=1&Kode=".urlencode(encrypt_url($personal->getIdPersonal()))."'>";
    }
}else if($_GET['action']=='delete'){
    $personalDao=new PersonalDao();
    if($personal!=null){
        $insert = $personalDao->delete($personal);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=PersonalForm'>";
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
        alert("Username sudah ada, ganti dengan yang lain !");
    }
</script>