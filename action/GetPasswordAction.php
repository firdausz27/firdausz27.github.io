<?php
include_once '../library/Enkripsi.php';
include_once '../library/Email.php';
include_once '../model/Personal.php';
include_once '../db/DBConnection.php';
include_once '../model/User.php';
$email=$_POST['txtEmail'];
$pesan=1;
    function getPersonal($id){
        $personal=NULL;
        $lembaga=array();
        $sqlLmbg="select * from emp_institusi where id_personal='$id'";
        $dataLm  =  mysql_query($sqlLmbg, DBConnection::getConnection())or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataLm)){
            $lembaga[]=$dataRow['id_institusi'];
        }
        $sql="select * from personal where id_siswa='$id'";
        $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $personal=new Personal();
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
          $personal->setUser(getUser($dataRow['id_siswa']));
          $personal->setListInstitusi($lembaga);
        }
        return $personal;
    }
    
    function getUser($id){
        $sql="select * from user where personal_id='$id'";
        $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $personal=new User();
          $personal->setUserId($dataRow['id_user']);
          $personal->setUsername($dataRow['username']);
          $personal->setPassword($dataRow['password']);
          $personal->setLevel($dataRow['level']);
          $personal->setPersonalId($dataRow['personal_id']);
          $personal->setPertanyaan($dataRow['pertanyaan']);
          $personal->setJawaban($dataRow['jawaban']);
        }
        return $personal;
    }
    
    function getPersonalByEmail($email){
        $arrayEmp=array();
        $personal=NULL;
        
        $sql="select * from personal where email='$email'";
        $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $personal=new Personal();
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
          $personal->setUser(getUser($dataRow['id_siswa']));
          $lembaga=array();
            $sqlLmbg="select * from emp_institusi where id_personal='".$dataRow['id_siswa']."'";
            $dataLm  =  mysql_query($sqlLmbg, DBConnection::getConnection())or die("Query error :".  mysql_error());
            while ($dataRow=  mysql_fetch_array($dataLm)){
                $lembaga[]=$dataRow['id_institusi'];
            }
          $personal->setListInstitusi($lembaga);
          $arrayEmp[]=$personal;
        }
        return $arrayEmp;
    }
$personalByEmail = getPersonalByEmail($email);
if($personalByEmail==NULL){
    $pesan=0;
}
foreach ($personalByEmail as $value){
    $kirimEmail = kirimEmail(getPersonal($value->getIdPersonal()));
    if($kirimEmail==false){
        $pesan=0;
    }
}
?>
<script>
    var pesan=<?php echo $pesan; ?>;
    if(pesan===1){
        alert("Proses Sukses");
        window.close();
    }else if(pesan===0){
        alert("Proses gagal");
        history.back();
    }
</script>
