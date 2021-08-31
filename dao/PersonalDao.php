<?php
include_once './model/Personal.php';
include_once './db/DBConnection.php';
include_once './dao/PersonalOtorisasiDao.php';
include_once './library/Email.php';
include_once './model/User.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonalDao
 *
 * @author asep
 */
class PersonalDao
{
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct()
    {
        $this->koneksi = new DBConnection();
        $this->connection =  $this->koneksi->getKonnection();
    }

    public function insert(Personal $personal, User $user)
    {
        $tglpass = str_replace('-','',InggrisTgl($personal->getTglLahir()));
        $valid = false;
        $sql = "insert into personal(
            id_siswa,no_induk_santri,nisn,status_awal,jenis,jenjang,kelas,nama_awal,nama_tengah,nama_akhir,tempat_lahir,
            tgl_lahir,telepon,alamat,kota,propinsi,kabupaten,kecamatan,negara,email,tgl_gabung,kelamin,kategori_santri,foto,status_perkawinan,kegiatan,nama_panggilan) values 
            ('" . $personal->getIdPersonal() . "',
                    '" . $_POST['no_induk'] . "',
                    '" . $_POST['nisn'] . "',
                    '" . $_POST['status_awal'] . "',
                    '" . $_POST['jenis'] . "',
                    '" . $_POST['jenjang'] . "',
                    '" . $_POST['kelas'] . "',
                    '" . $personal->getNamaAwal() . "',
                        '" . $personal->getNamaTengah() . "',
                            '" . $personal->getNamaAkhir() . "',
                                '" . $personal->getTempatLahir() . "',
                                    '" . InggrisTgl($personal->getTglLahir()) . "',
                                        '" . $personal->getTelepon() . "',
                                            '" . $personal->getAlamat() . "',
                                                '" . $personal->getKota() . "',
                                                    '" . $personal->getPropinsi() . "',
                                                    '" . $_POST['kabupaten'] . "',
                                                    '" . $_POST['kecamatan'] . "',
                                                        '" . $personal->getNegara() . "',
                                                            '" . $personal->getEmail() . "',
                                                                '" . InggrisTgl($personal->getTglGabung()) . "',
                                                                    " . $personal->getKelamin() . ",
                                                                        '" . $personal->getKategoriSantri() . "',
                                                                            '" . $personal->getFoto() . "',"
            . "'" . $personal->getStatusPerkawinan() . "','" . $personal->getKegiatan() . "','" . $personal->getNamaPanggilan() . "')";
        $nmaw = ($personal->getNamaAwal() !== '') ? str_replace(' ', '', $personal->getNamaAwal()) : null;
        $nmtg = ($personal->getNamaTengah() !== '') ? str_replace(' ', '', $personal->getNamaTengah()) : null;
        $nmak = ($personal->getNamaAkhir() !== '') ? str_replace(' ', '', $personal->getNamaAkhir()) : null;
        $username = $nmaw . $nmtg . $nmak;
        $sql2 = "insert into user (id_user,username,password,level,personal_id,pertanyaan,jawaban) values 
            ('" . $user->getUserId() . "','" . strtolower($username) . "','" .  encrypt_decrypt('encrypt', $tglpass) . "',
                '10','" . $personal->getIdPersonal() . "','" . $user->getPertanyaan() . "','" . $user->getJawaban() . "')";
        // $sql2 = "insert into user (id_user,username,password,level,personal_id,pertanyaan,jawaban) values 
        //     ('" . $user->getUserId() . "','" . $user->getUsername() . "','" .  encrypt_decrypt('encrypt', $user->getPassword()) . "',
        //         '" . $user->getLevel() . "','" . $personal->getIdPersonal() . "','" . $user->getPertanyaan() . "','" . $user->getJawaban() . "')";
        $this->koneksi->begin();
        $myQry  =  mysql_query($sql, $this->connection) or die("Error query :" . mysql_error());
        $myQry2  =  mysql_query($sql2, $this->connection) or die("Error query :" . mysql_error());
        // foreach ($personal->getListMenu() as $value){
        //     $sqlMenu="insert into group_personal (group_id,personal_id) values($value,'".$personal->getIdPersonal()."')";
        //     $myInsert  =  mysql_query($sqlMenu, $this->connection)or die("Error query :".mysql_error());
        // }
        //untuk memasukan kedalam lembaganya personal
        // foreach ($personal->getListInstitusi() as $value){
        //     $sqlInstitusi="insert into emp_institusi (id_institusi,id_personal) values($value,'".$personal->getIdPersonal()."')";
        //     $myInstitusi  =  mysql_query($sqlInstitusi, $this->connection)or die("Error query :".mysql_error());
        // }
        // if($myQry && $myQry2 &&$myInsert && $myInstitusi){
        if ($myQry && $myQry2) {
            $this->koneksi->commit();
            $valid = true;
            // kirimEmail($this->getPersonal($personal->getIdPersonal()));
        } else {
            $this->koneksi->rollback();
            $valid = false;
        }
        return $valid;
        $this->koneksi->closeConnection();
    }

    public function update(Personal $personal,  User $user)
    {
        $valid = false;
        $sql = "update personal set 
                    status_awal     = '$_POST[status_awal]',
                    jenis           = '$_POST[jenis]',
                    jenjang         = '$_POST[jenjang]',
                    kelas           = '$_POST[kelas]',
                    no_induk_santri = '$_POST[no_induk]',
                    nisn            = '$_POST[nisn]',
                    kabupaten       = '$_POST[kabupaten]',
                    kecamatan       = '$_POST[kecamatan]',
                    nama_awal='" . $personal->getNamaAwal() . "',
                        nama_tengah='" . $personal->getNamaTengah() . "',
                            nama_akhir='" . $personal->getNamaAkhir() . "',
                                tempat_lahir='" . $personal->getTempatLahir() . "',
                                    tgl_lahir='" . InggrisTgl($personal->getTglLahir()) . "',
                                        telepon='" . $personal->getTelepon() . "',
                                            alamat='" . $personal->getAlamat() . "',
                                                kota='" . $personal->getKota() . "',
                                                    propinsi='" . $personal->getPropinsi() . "',
                                                        negara='" . $personal->getNegara() . "',
                                                            email='" . $personal->getEmail() . "',
                                                                tgl_gabung='" . InggrisTgl($personal->getTglGabung()) . "',
                                                                    kelamin=" . $personal->getKelamin() . ",
                                                                        kategori_santri='" . $personal->getKategoriSantri() . "',
                                                                            foto='" . $personal->getFoto() . "',
                                                                                status_perkawinan='" . $personal->getStatusPerkawinan() . "',
                                                                                    kegiatan='" . $personal->getKegiatan() . "',
                                                                                        nama_panggilan='" . $personal->getNamaPanggilan() . "'
                                                                                        where  id_siswa='" . $personal->getIdPersonal() . "'";
        $sql2 = "update user set  
            username='" . $user->getUsername() . "',password='" .  encrypt_decrypt('encrypt', $user->getPassword()) . "',
                level='" . $user->getLevel() . "', personal_id='" . $user->getPersonalId() . "',
                    pertanyaan='" . $user->getPertanyaan() . "',
                    jawaban='" . $user->getJawaban() . "' where id_user='" . $user->getUserId() . "'";
        $myQry  =  mysql_query($sql, $this->connection) or die("Error query :" . mysql_error());
        $myQry2  =  mysql_query($sql2, $this->connection) or die("Error query :" . mysql_error());
        //lakukan delete dulu
        if ($personal->getListInstitusi() != '') {
            $sqlDelete = "delete from emp_institusi where id_personal='" . $personal->getIdPersonal() . "'";
            $myDelete  =  mysql_query($sqlDelete, $this->connection) or die("Error query :" . mysql_error());
            //untuk memasukan kedalam lembaganya personal
            foreach ($personal->getListInstitusi() as $value) {
                $sqlInstitusi = "insert into emp_institusi (id_institusi,id_personal) values($value,'" . $personal->getIdPersonal() . "')";
                $myInstitusi  =  mysql_query($sqlInstitusi, $this->connection) or die("Error query :" . mysql_error());
            }

            if ($myQry && $myQry2 && $myDelete && $myInstitusi) {
                $this->koneksi->commit();
                $valid = true;
            } else {
                $this->koneksi->rollback();
                $valid = false;
            }
        } else {
            if ($myQry && $myQry2) {
                $this->koneksi->commit();
                $valid = true;
            } else {
                $this->koneksi->rollback();
                $valid = false;
            }
        }
        return $valid;
        $this->koneksi->closeConnection();
    }


    public function updateUser(User $user)
    {
        $valid = false;
        $sql2 = "update user set  
            username='" . $user->getUsername() . "',password='" . encrypt_decrypt('encrypt', $user->getPassword()) . "',
                level='" . $user->getLevel() . "', personal_id='" . $user->getPersonalId() . "',
                    pertanyaan='" . $user->getPertanyaan() . "',
                    jawaban='" . $user->getJawaban() . "' where id_user='" . $user->getUserId() . "'";
        $myQry2  =  mysql_query($sql2, $this->connection) or die("Error query :" . mysql_error());
        if ($myQry2) {
            $this->koneksi->commit();
            $valid = true;
        } else {
            $this->koneksi->rollback();
            $valid = false;
        }
        return $valid;
        $this->koneksi->closeConnection();
    }

    public function delete(Personal $personal)
    {
        $sql = "delete from personal where id_siswa='" . $personal->getIdPersonal() . "'";
        $sql2 = "delete from user where personal_id='" . $personal->getIdPersonal() . "'";
        $myQry  =  mysql_query($sql, $this->connection) or die("Error query :" . mysql_error());
        $myQry2  =  mysql_query($sql2, $this->connection) or die("Error query :" . mysql_error());
        if ($myQry && $myQry2) {
            $this->koneksi->commit();
            $valid = true;
        } else {
            $this->koneksi->rollback();
            $valid = false;
        }
        return $valid;
        $this->koneksi->closeConnection();
    }

    public function getAllPersonalPage($hal, $row)
    {
        $otorisasidao = new PersonalOtorisasiDao();
        $otorisasi = $otorisasidao->getOtorisasi($_SESSION['SES_LOGIN']);
        if ($otorisasi == NULL) {
            $otorisasi[] = $_SESSION['SES_LOGIN'];
        }
        $listSiswa = implode("','", $otorisasi);
        $personals = array();
        $sql = "select * from personal where id_siswa in('" . $listSiswa . "') order by id_siswa asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection) or die("Query error :" .  mysql_error());
        while ($dataRow =  mysql_fetch_array($dataQry)) {
            $personal = new Personal();
            $personal->setIdPersonal($dataRow['id_siswa']);
            $personal->setNISN($dataRow['nisn']);
            $personal->setNamaAwal($dataRow['nama_awal']);
            $personal->setNamaTengah($dataRow['nama_tengah']);
            $personal->setNamaAkhir($dataRow['nama_akhir']);
            $personal->setNamaPanggilan($dataRow['nama_panggilan']);
            $personal->setTempatLahir($dataRow['tempat_lahir']);
            $personal->setTglLahir($dataRow['tgl_lahir']);
            $personal->setTelepon($dataRow['telepon']);
            $personal->setAlamat($dataRow['alamat']);
            $personal->setKota($dataRow['kota']);
            $personal->setPropinsi($dataRow['propinsi']);
            $personal->setNegara($dataRow['negara']);
            $personal->setEmail($dataRow['email']);
            $personal->setTglGabung($dataRow['tgl_gabung']);
            $personal->setKelamin($dataRow['kelamin']);
            $personal->setKategoriSantri($dataRow['kategori_santri']);
            $personal->setStatusPerkawinan($dataRow['status_perkawinan']);
            $personal->setKegiatan($dataRow['kegiatan']);
            $personal->setFoto($dataRow['foto']);
            $personals[] = $personal;
        }
        return $personals;
    }

    public function getAllPersonal()
    {
        $otorisasidao = new PersonalOtorisasiDao();
        $otorisasi = $otorisasidao->getOtorisasi($_SESSION['SES_LOGIN']);
        if ($otorisasi == NULL) {
            $otorisasi[] = $_SESSION['SES_LOGIN'];
        }
        $listSiswa = implode("','", $otorisasi);
        $personals = array();
        $sql = "select * from personal where id_siswa in('" . $listSiswa . "') order by nama_awal,nama_tengah,nama_akhir";
        $dataQry  =  mysql_query($sql, $this->connection) or die("Query error :" .  mysql_error());
        while ($dataRow =  mysql_fetch_array($dataQry)) {
            $personal = new Personal();
            $personal->setIdPersonal($dataRow['id_siswa']);
            $personal->setNISN($dataRow['nisn']);
            $personal->setNamaAwal($dataRow['nama_awal']);
            $personal->setNamaTengah($dataRow['nama_tengah']);
            $personal->setNamaAkhir($dataRow['nama_akhir']);
            $personal->setNamaPanggilan($dataRow['nama_panggilan']);
            $personal->setTempatLahir($dataRow['tempat_lahir']);
            $personal->setTglLahir($dataRow['tgl_lahir']);
            $personal->setTelepon($dataRow['telepon']);
            $personal->setAlamat($dataRow['alamat']);
            $personal->setKota($dataRow['kota']);
            $personal->setPropinsi($dataRow['propinsi']);
            $personal->setNegara($dataRow['negara']);
            $personal->setEmail($dataRow['email']);
            $personal->setTglGabung($dataRow['tgl_gabung']);
            $personal->setKelamin($dataRow['kelamin']);
            $personal->setKategoriSantri($dataRow['kategori_santri']);
            $personal->setStatusPerkawinan($dataRow['status_perkawinan']);
            $personal->setKegiatan($dataRow['kegiatan']);
            $personal->setFoto($dataRow['foto']);
            $personals[] = $personal;
        }
        return $personals;
    }

    public function getAllPersonalFreeAccess()
    {
        $personals = array();
        $sql = "select * from personal order by id_siswa";
        $dataQry  =  mysql_query($sql, $this->connection) or die("Query error :" .  mysql_error());
        while ($dataRow =  mysql_fetch_array($dataQry)) {
            $personal = new Personal();
            $personal->setIdPersonal($dataRow['id_siswa']);
            $personal->setNamaAwal($dataRow['nama_awal']);
            $personal->setNamaTengah($dataRow['nama_tengah']);
            $personal->setNamaAkhir($dataRow['nama_akhir']);
            $personal->setNamaPanggilan($dataRow['nama_panggilan']);
            $personal->setTempatLahir($dataRow['tempat_lahir']);
            $personal->setTglLahir($dataRow['tgl_lahir']);
            $personal->setTelepon($dataRow['telepon']);
            $personal->setAlamat($dataRow['alamat']);
            $personal->setKota($dataRow['kota']);
            $personal->setPropinsi($dataRow['propinsi']);
            $personal->setNegara($dataRow['negara']);
            $personal->setEmail($dataRow['email']);
            $personal->setTglGabung($dataRow['tgl_gabung']);
            $personal->setKelamin($dataRow['kelamin']);
            $personal->setKategoriSantri($dataRow['kategori_santri']);
            $personal->setStatusPerkawinan($dataRow['status_perkawinan']);
            $personal->setKegiatan($dataRow['kegiatan']);
            $personal->setFoto($dataRow['foto']);
            $personals[] = $personal;
        }
        return $personals;
    }

    public function getAllPersonalNotIn($list = array())
    {
        $personals = array();
        $listSiswa = implode("','", $list);
        $sql = "select * from personal where id_siswa not in('" . $listSiswa . "')order by id_siswa";
        echo $sql;
        $dataQry  =  mysql_query($sql, $this->connection) or die("Query error :" .  mysql_error());
        while ($dataRow =  mysql_fetch_array($dataQry)) {
            $personal = new Personal();
            $personal->setIdPersonal($dataRow['id_siswa']);
            $personal->setNamaAwal($dataRow['nama_awal']);
            $personal->setNamaTengah($dataRow['nama_tengah']);
            $personal->setNamaAkhir($dataRow['nama_akhir']);
            $personal->setNamaPanggilan($dataRow['nama_panggilan']);
            $personal->setTempatLahir($dataRow['tempat_lahir']);
            $personal->setTglLahir($dataRow['tgl_lahir']);
            $personal->setTelepon($dataRow['telepon']);
            $personal->setAlamat($dataRow['alamat']);
            $personal->setKota($dataRow['kota']);
            $personal->setPropinsi($dataRow['propinsi']);
            $personal->setNegara($dataRow['negara']);
            $personal->setEmail($dataRow['email']);
            $personal->setTglGabung($dataRow['tgl_gabung']);
            $personal->setKelamin($dataRow['kelamin']);
            $personal->setKategoriSantri($dataRow['kategori_santri']);
            $personal->setStatusPerkawinan($dataRow['status_perkawinan']);
            $personal->setKegiatan($dataRow['kegiatan']);
            $personal->setFoto($dataRow['foto']);
            $personals[] = $personal;
        }
        return $personals;
    }

    public function getPersonal($id)
    {
        $personal = NULL;
        $lembaga = array();
        $sqlLmbg = "select * from emp_institusi where id_personal='$id' ";
        $dataLm  =  mysql_query($sqlLmbg, $this->connection) or die("Query error :" .  mysql_error());
        while ($dataRow =  mysql_fetch_array($dataLm)) {
            $lembaga[] = $dataRow['id_institusi'];
        }
        $sql = "select * from personal where id_siswa='$id' order by nama_awal,nama_tengah,nama_akhir";
        $dataQry  =  mysql_query($sql, $this->connection) or die("Query error :" .  mysql_error());
        while ($dataRow =  mysql_fetch_array($dataQry)) {
            $personal = new Personal();
            $personal->setIdPersonal($dataRow['id_siswa']);
            $personal->setNISN($dataRow['nisn']);
            $personal->setNoInduk($dataRow['no_induk_santri']);
            $personal->setStatusAwal($dataRow['status_awal']);
            $personal->setJenis($dataRow['jenis']);
            $personal->setJenjang($dataRow['jenjang']);
            $personal->setKelas($dataRow['kelas']);
            $personal->setNamaAwal($dataRow['nama_awal']);
            $personal->setNamaTengah($dataRow['nama_tengah']);
            $personal->setNamaAkhir($dataRow['nama_akhir']);
            $personal->setNamaPanggilan($dataRow['nama_panggilan']);
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
            $personal->setStatusPerkawinan($dataRow['status_perkawinan']);
            $personal->setKegiatan($dataRow['kegiatan']);
            $personal->setTglGabung($dataRow['tgl_gabung']);
            $personal->setFoto($dataRow['foto']);
            $personal->setUser($this->getUser($dataRow['id_siswa']));
            $personal->setProv($dataRow['propinsi']);
            $personal->setKab($dataRow['kabupaten']);
            $personal->setKec($dataRow['kecamatan']);
            $personal->setListInstitusi($lembaga);
        }
        return $personal;
    }

    public function getUser($id)
    {
        $sql = "select * from user where personal_id='$id'";
        $dataQry  =  mysql_query($sql, $this->connection) or die("Query error :" .  mysql_error());
        while ($dataRow =  mysql_fetch_array($dataQry)) {
            $personal = new User();
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

    public function getLogin($username, $password)
    {
        $username = mysql_real_escape_string($username);
        $password =  mysql_real_escape_string($password);
        $sql = "select * from user where username='$username' and password='$password'";
        $dataQry  =  mysql_query($sql, $this->connection) or die("Query error :" .  mysql_error());
        while ($dataRow =  mysql_fetch_array($dataQry)) {
            $personal = new User();
            $personal->setUserId($dataRow['id_user']);
            $personal->setUsername($dataRow['username']);
            $personal->setPassword($dataRow['password']);
            $personal->setLevel($dataRow['level']);
            $personal->setPersonalId($dataRow['personal_id']);
            $personal->setPertanyaan($dataRow['pertanyaan']);
            $personal->setJawaban($dataRow['jawaban']);
            $personal->setPersonal(getPersonal($dataRow['personal_id']));
        }
        return $personal;
    }

    public function getValidaiUsername($username)
    {
        $sql = "select * from user where username='$username'";
        $personal = NULL;
        $dataQry  =  mysql_query($sql, $this->connection) or die("Query error :" .  mysql_error());
        while ($dataRow =  mysql_fetch_array($dataQry)) {
            $personal = new User();
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

    public function getCariPersonal($field, $text)
    {
        $personals = array();
        $sql = "select * from personal where $field like '%$text%' order by id_siswa";
        $dataQry  =  mysql_query($sql, $this->connection) or die("Query error :" .  mysql_error());
        while ($dataRow =  mysql_fetch_array($dataQry)) {
            $personal = new Personal();
            $personal->setIdPersonal($dataRow['id_siswa']);
            $personal->setNamaAwal($dataRow['nama_awal']);
            $personal->setNamaTengah($dataRow['nama_tengah']);
            $personal->setNamaAkhir($dataRow['nama_akhir']);
            $personal->setNamaPanggilan($dataRow['nama_panggilan']);
            $personal->setTempatLahir($dataRow['tempat_lahir']);
            $personal->setTglLahir($dataRow['tgl_lahir']);
            $personal->setTelepon($dataRow['telepon']);
            $personal->setAlamat($dataRow['alamat']);
            $personal->setKota($dataRow['kota']);
            $personal->setPropinsi($dataRow['propinsi']);
            $personal->setNegara($dataRow['negara']);
            $personal->setEmail($dataRow['email']);
            $personal->setTglGabung($dataRow['tgl_gabung']);
            $personal->setKelamin($dataRow['kelamin']);
            $personal->setKategoriSantri($dataRow['kategori_santri']);
            $personal->setStatusPerkawinan($dataRow['status_perkawinan']);
            $personal->setKegiatan($dataRow['kegiatan']);
            $personal->setFoto($dataRow['foto']);
            $personals[] = $personal;
        }
        return $personals;
    }
}
