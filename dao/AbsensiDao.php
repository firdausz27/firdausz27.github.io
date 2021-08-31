<?php
include_once './model/Absensi.php';
include_once './db/DBConnection.php';
include_once './model/AbsensiPersonal.php';
include_once './dao/PersonalDao.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbsensiDao
 *
 * @author asep
 */
class AbsensiDao {
    //put your code here
    private $connection;
    private $koneksi;
    private $personalDao;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
        $this->personalDao=new PersonalDao;
    }
    
    public function insert(Absensi $absensi, $listAbsensi){
        $valid=false;
        $this->koneksi->begin();
        //lakukan inset kedalam absensi
        $sql1="insert into absensi (id_absensi,tanggal,id_jadual,pengajar_id) values 
            ('".$absensi->getIdAbsen()."','".InggrisTgl($absensi->getTanggal())."',
                '".$absensi->getJdualId()."','".$absensi->getPengajarId()."')";
        $myQry1  =  mysql_query($sql1, $this->connection)or die("Error query :".mysql_error());
        //lakukan insert kedalam absensi detail
        foreach ($listAbsensi as $value){
            $sql2="insert into absensi_personal (id_absensi,id_siswa,status,keterangan) values 
                ('".$absensi->getIdAbsen()."','".$value->getIdSiswa()."','".$value->getStatus()."','".$value->getKeterangan()."')";
            $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
        }
        if($myQry1 && $myQry2){
            $this->koneksi->commit();
            $valid=true;
        }else{
            $this->koneksi->rollback();
            $valid=false;
        }
        return $valid;
        $this->koneksi->closeConnection();
    }
    
    public function update(Absensi $absensi, $listAbsensi){
        $valid=false;
        $this->koneksi->begin();
        //lakukan pengecekan untuk data yang sedang eada
        $listdata=array();
        $sqlGet="select id_siswa from absensi_personal where id_absensi='".$absensi->getIdAbsen()."'";
        $myGet  =  mysql_query($sqlGet, $this->connection)or die("Error query :".mysql_error());
        while ($dataRow=  mysql_fetch_array($myGet)){ 
            $listdata[]=$dataRow['id_siswa'];
        }
        //lakukan update kedalam absensi detail
        foreach ($listAbsensi as $value){
            if(in_array($value->getIdSiswa(), $listdata)){
                $sql2="update absensi_personal set status='".$value->getStatus()."',keterangan='".$value->getKeterangan()."'
                    where id_absensi='".$absensi->getIdAbsen()."' and id_siswa='".$value->getIdSiswa()."'";
                $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
            }else{
                 $sql2="insert into absensi_personal (id_absensi,id_siswa,status,keterangan) values 
                ('".$absensi->getIdAbsen()."','".$value->getIdSiswa()."','".$value->getStatus()."','".$value->getKeterangan()."')";
                $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
            }
        }
        if($myQry2){
            $this->koneksi->commit();
            $valid=true;
        }else{
            $this->koneksi->rollback();
            $valid=false;
        }
        return $valid;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Absensi $absensi){
        $sql="delete from absensi where id_absensi='".$absensi->getIdAbsen()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllAbsensiPage($hal,$row){
        $absensis=array();
        $sql="select * from absensi order by id_absensi asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $absensi=new Absensi();
          $absensi->setIdAbsen($dataRow['id_absensi']);
          $absensi->setTanggal($dataRow['tanggal']);
          $absensi->setJdualId($dataRow['id_jadual']);
          $absensi->setPengajarId($dataRow['pengajar_id']);
          $absensi->setKeterangan($dataRow['keterangan']);
          $absensis[]=$absensi;
        }
        return $absensis;
    }
    
     public function getAllAbsensi(){
        $absensis=array();
        $sql="select * from absensi order by id_absensi";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $absensi=new Absensi();
          $absensi->setIdAbsen($dataRow['id_absensi']);
        $absensi->setTanggal($dataRow['tanggal']);
        $absensi->setJdualId($dataRow['id_jadual']);
        $absensi->setPengajarId($dataRow['pengajar_id']);
        $absensi->setKeterangan($dataRow['keterangan']);
          $absensis[]=$absensi;
        }
        return $absensis;
    }
    
    public function getAbsensi(Absensi $absen){
        $sql="select * from absensi where id_jadual='".$absen->getJdualId()."' 
            and tanggal='".  InggrisTgl($absen->getTanggal())."' and pengajar_id='".$absen->getPengajarId()."'";
        $absensi=NULL;
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $absensi=new Absensi();
          $absensi->setIdAbsen($dataRow['id_absensi']);
          $absensi->setTanggal($dataRow['tanggal']);
          $absensi->setJdualId($dataRow['id_jadual']);
          $absensi->setPengajarId($dataRow['pengajar_id']);
          $absensi->setKeterangan($dataRow['keterangan']);
          //untuk mendapatkan absensi detail
          $sqlAbsensi="select * from absensi_personal where id_absensi='".$dataRow['id_absensi']."'";
          $dataAbsensi  =  mysql_query($sqlAbsensi, $this->connection)or die("Query error :".  mysql_error());
          $listAbs=array();
          while ($dataRow=  mysql_fetch_array($dataAbsensi)){  
              $absPersonal=new AbsensiPersonal();
              $absPersonal->setIdAbsensi($dataRow['id_absensi']);
              $absPersonal->setIdSiswa($dataRow['id_siswa']);
              $absPersonal->setKeterangan($dataRow['keterangan']);
              $absPersonal->setStatus($dataRow['status']);
              $listAbs[]=$absPersonal;
          }
        }
        //$absensi->setAbsensiPersonal($listAbs);
        return $absensi;
    }
    
    public function getAbsensiDetail($idAbsensi){
        $absensiDetail=array();
            $sql="select * from absensi_personal where id_absensi='".$idAbsensi."'";
            $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
            while ($dataRow=  mysql_fetch_array($dataQry)){  
              $absen = new AbsensiPersonal();
              $absen->setIdAbsensi($dataRow['id_absensi']);
              $absen->setIdSiswa($this->personalDao->getPersonal($dataRow['id_siswa']));
              $absen->setStatus($dataRow['status']);
              $absen->setKeterangan($dataRow['keterangan']);
              $absensiDetail[]=$absen;
            }
        return $absensiDetail;
    }
    
    public function getAbsensiDtl($idAbsensi,$personalId,$tanggal){
            $absen=NULL;
            $sql="select absensi_personal.* from absensi  
                inner join absensi_personal on(absensi.id_absensi=absensi_personal.id_absensi)
                where absensi.id_jadual='".$idAbsensi."' and absensi_personal.id_siswa='".$personalId."' 
                and tanggal='".InggrisTgl($tanggal)."'";
            $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
            while ($dataRow=  mysql_fetch_array($dataQry)){  
              $absen = new AbsensiPersonal();
              $absen->setIdAbsensi($dataRow['id_absensi']);
              $absen->setIdSiswa($this->personalDao->getPersonal($dataRow['id_siswa']));
              $absen->setStatus($dataRow['status']);
              $absen->setKeterangan($dataRow['keterangan']);
            }
            return $absen;
    }
    
    public function getIdAbsen($idJadual,$tanggal){
            $absensi=NULL;
            $sql="select distinct absensi.* from absensi  
                inner join absensi_personal on(absensi.id_absensi=absensi_personal.id_absensi)
                where absensi.id_jadual='".$idJadual."' 
                and tanggal='".InggrisTgl($tanggal)."'";
            $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
            while ($dataRow=  mysql_fetch_array($dataQry)){  
                $absensi=new Absensi();
                $absensi->setIdAbsen($dataRow['id_absensi']);
                $absensi->setTanggal($dataRow['tanggal']);
                $absensi->setJdualId($dataRow['id_jadual']);
                $absensi->setPengajarId($dataRow['pengajar_id']);
                $absensi->setKeterangan($dataRow['keterangan']);
            }
            return $absensi;
    }
    
    public function getCariAbsensi($field, $text){
        $absensis=array();
        $sql="select * from absensi where $field like '%$text%' order by id_absensi";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $absensi=new Absensi();
          $absensi->setIdAbsen($dataRow['id_absensi']);
            $absensi->setTanggal($dataRow['tanggal']);
            $absensi->setJdualId($dataRow['id_jadual']);
            $absensi->setPengajarId($dataRow['pengajar_id']);
            $absensi->setKeterangan($dataRow['keterangan']);
          $absensis[]=$absensi;
        }
        return $absensis;
    }
}

?>
