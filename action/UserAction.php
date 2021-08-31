<?php
include_once './dao/PersonalDao.php';
include_once './model/User.php';

$pesan=0;
$personal=new Personal();
$user=NULL;
if($_POST){
    //menbuat objek user
    $user=new User();
    $user->setUserId(isset($_POST['txtIdUser']) ? $_POST['txtIdUser'] : '');
    $user->setUsername(isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '');
    $user->setPassword(isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '');
    $user->setPertanyaan(isset($_POST['txtPertanyaan']) ? $_POST['txtPertanyaan'] : '');
    $user->setJawaban(isset($_POST['txtJawaban']) ? $_POST['txtJawaban'] : '');
    $user->setLevel(isset($_POST['cboLevel']) ? $_POST['cboLevel'] : '');
    $user->setPersonalId(isset($_POST['txtIdPersonal']) ? $_POST['txtIdPersonal'] : '');
    
}


if($_GET['action']=='update'){
    $personalDao=new PersonalDao();
    if($user!=null){  
        $validaiUsername = $personalDao->getValidaiUsername($user->getUsername());
        if($validaiUsername !=NULL){
            if($validaiUsername->getUserId()==$user->getUserId()){
                $insert = $personalDao->updateUser($user);
                if($insert){
                    echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&Kode=".urlencode(encrypt_url($user->getPersonalId()))."&mode=2'>";
                    $pesan=1;
                }
            }else{
                echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&Kode=".urlencode(encrypt_url($user->getPersonalId()))."&mode=2'>";
                $pesan=2;
            }
        }else{
            $insert = $personalDao->updateUser($user);
            if($insert){
                echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&Kode=".urlencode(encrypt_url($user->getPersonalId()))."&mode=2'>";
                $pesan=1;
            }
        }
    }
}else if($_GET['action']=='delete'){
    $personalDao=new PersonalDao();
    if($personal!=null){
        $insert = $personalDao->delete($personal);
        if($insert){
            echo "<meta http-equiv='refresh' content='0; url=?page=TabEdit&Kode=".urlencode(encrypt_url($user->getPersonalId()))."&mode=2'>'>";
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
        alert("Username sudah ada, ganti dengan yang lain");
    }
</script>