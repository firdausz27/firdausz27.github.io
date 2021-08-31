<?php
session_start();
include_once '../db/DBConnection.php';
include_once '../model/Personal.php';
include_once '../model/User.php';
include_once '../library/Enkripsi.php';
$error = 0;
function getLogin($username, $password)
{
    $usr = mysql_real_escape_string($username, DBConnection::getConnection()); //strip_tags($username); //untuk mencegah sql injektion
    $pwd = mysql_real_escape_string($password, DBConnection::getConnection()); //strip_tags($password); //untuk encegah sql injektion
    $user = NULL;
    $sql = "select * from user where username='$usr' and password='" . encrypt_decrypt('encrypt', $pwd) . "'";
    // $sql="select * from user where username='$usr' and password='$pwd' ";
    $dataQry  =  mysql_query($sql, DBConnection::getConnection()) or die("Query error :" .  mysql_error());
    while ($dataRow =  mysql_fetch_array($dataQry)) {
        $user = new User();
        $user->setUserId($dataRow['id_user']);
        $user->setUsername($dataRow['username']);
        $user->setPassword($dataRow['password']);
        $user->setLevel($dataRow['level']);
        $user->setPersonalId($dataRow['personal_id']);
        $user->setPertanyaan($dataRow['pertanyaan']);
        $user->setJawaban($dataRow['jawaban']);
        $user->setPersonal(getPersonal($dataRow['personal_id']));
        // $user->setPersonal($dataRow['personal_id']);
    }
    return $user;
}

function getPersonal($id)
{
    $personal = NULL;
    $sql = "select * from personal where id_siswa='$id'";
    $dataQry  =  mysql_query($sql, DBConnection::getConnection()) or die("Query error :" .  mysql_error());
    while ($dataRow =  mysql_fetch_array($dataQry)) {
        $personal = new Personal();
        $personal->setIdPersonal($dataRow['id_siswa']);
        $personal->setNamaAwal($dataRow['nama_awal']);
        $personal->setNamaTengah($dataRow['nama_tengah']);
        $personal->setNamaAkhir($dataRow['nama_akhir']);
        $personal->setTempatLahir($dataRow['tempat_lahir']);
        $personal->setTglLahir($dataRow['tgl_lahir']);
        $personal->setTelepon($dataRow['telepon']);
        $personal->setAlamat($dataRow['alamat']);
        $personal->setKota($dataRow['kota']);
        $personal->setPropinsi($dataRow['propinsi']);
        $personal->setNegara($dataRow['negara']);
        $personal->setEmail($dataRow['email']);
        $personal->setKelamin($dataRow['kelamin']);
        $personal->setKategoriSantri($dataRow['kategori_santri']);
        $personal->setTglGabung($dataRow['tgl_gabung']);
        $personal->setFoto($dataRow['foto']);
    }
    return $personal;
}
if ($_POST) {
    $loginPersonal = getLogin($_POST['txtUser'], $_POST['txtPassword']);
    if ($loginPersonal == NULL) {
        echo "<meta http-equiv='refresh' content='0; url=../'>";
        $error = 1;
    } else {
        /* @var $_SESSION type */
        $_SESSION['SES_LOGIN'] = $loginPersonal->getPersonalId();
        $_SESSION['SES_USER'] = $loginPersonal->getUsername();
        $_SESSION['SES_NAMA'] = $loginPersonal->getPersonal()->getNamaAwal() . " " . $loginPersonal->getPersonal()->getNamaTengah() . " " . $loginPersonal->getPersonal()->getNamaAkhir();
        $_SESSION['SES_PERSONALID'] = $loginPersonal->getPersonalId();
        echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
    }
}
?>
<script>
    var pesan = <?php echo $error; ?>;
    if (pesan === 1) {
        alert("Login Gagal Username Atau Password Tidak Valid !");
    }
</script>