<?php
include_once './model/Pendidikan.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PendidikanDao
 *
 * @author asep
 */
class PendidikanDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Pendidikan $pend){
        $sql="insert into education_history
            (id_education,level_pendidikan,tahun_mulai,tahun_selesai,institusi,nilai_rata,no_ijazah,negara,propinsi,kota,tgl_ijazah,personal_id)
            values 
            ('".$pend->getEducationId()."',
                '".$pend->getLevelPendidikan()."',
                    '".$pend->getTahunMulai()."',
                        '".$pend->getTahunSelesai()."',
                            '".$pend->getInstitusi()."',
                                ".$pend->getNilaiRata().",
                                    '".$pend->getNoIjazah()."',
                                        '".$pend->getNegara()."',
                                            '".$pend->getPropinsi()."',
                                                '".$pend->getKota()."',
                                                    '".$pend->getTglIjazah()."',
                                                        '".$pend->getPersonalId()."')";
        if($pend->getTglIjazah()==''){
             $sql="insert into education_history
            (id_education,level_pendidikan,tahun_mulai,tahun_selesai,institusi,nilai_rata,no_ijazah,negara,propinsi,kota,personal_id)
            values 
            ('".$pend->getEducationId()."',
                '".$pend->getLevelPendidikan()."',
                    '".$pend->getTahunMulai()."',
                        '".$pend->getTahunSelesai()."',
                            '".$pend->getInstitusi()."',
                                ".$pend->getNilaiRata().",
                                    '".$pend->getNoIjazah()."',
                                        '".$pend->getNegara()."',
                                            '".$pend->getPropinsi()."',
                                                '".$pend->getKota()."',
                                                        '".$pend->getPersonalId()."')";
        }
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Pendidikan $pend){
        $sql="update education_history set 
                level_pendidikan='".$pend->getLevelPendidikan()."',
                    tahun_mulai='".$pend->getTahunMulai()."',
                        tahun_selesai='".$pend->getTahunSelesai()."',
                            institusi='".$pend->getInstitusi()."',
                                nilai_rata=".$pend->getNilaiRata().",
                                    no_ijazah='".$pend->getNoIjazah()."',
                                        negara='".$pend->getNegara()."',
                                            propinsi='".$pend->getPropinsi()."',
                                                kota='".$pend->getKota()."',
                                                    tgl_ijazah='".$pend->getTglIjazah()."',
                                                        personal_id='".$pend->getPersonalId()."'
                                                            where id_education='".$pend->getEducationId()."'";
        if($pend->getTglIjazah()==''){
            $sql="update education_history set 
                level_pendidikan='".$pend->getLevelPendidikan()."',
                    tahun_mulai='".$pend->getTahunMulai()."',
                        tahun_selesai='".$pend->getTahunSelesai()."',
                            institusi='".$pend->getInstitusi()."',
                                nilai_rata=".$pend->getNilaiRata().",
                                    no_ijazah='".$pend->getNoIjazah()."',
                                        negara='".$pend->getNegara()."',
                                            propinsi='".$pend->getPropinsi()."',
                                                kota='".$pend->getKota()."',
                                                        personal_id='".$pend->getPersonalId()."'
                                                            where id_education='".$pend->getEducationId()."'";
        }
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Pendidikan $pendidikan){
        $sql="delete from education_history where id_education='".$pendidikan->getEducationId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllPendidikanPage($personalId){
        $pendidikans=array();
        $sql="select * from education_history where personal_id='$personalId' order by id_education asc";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pendidikan=new Pendidikan();
          $pendidikan->setEducationId($dataRow['id_education']);
          $pendidikan->setLevelPendidikan($dataRow['level_pendidikan']);
          $pendidikan->setTahunMulai($dataRow['tahun_mulai']);
          $pendidikan->setTahunSelesai($dataRow['tahun_selesai']);
          $pendidikan->setInstitusi($dataRow['institusi']);
          $pendidikan->setNilaiRata($dataRow['nilai_rata']);
          $pendidikan->setNoIjazah($dataRow['no_ijazah']);
          $pendidikan->setNegara($dataRow['negara']);
          $pendidikan->setPropinsi($dataRow['propinsi']);
          $pendidikan->setKota($dataRow['kota']);
          $pendidikan->setTglIjazah($dataRow['tgl_ijazah']);
          $pendidikan->setPersonalId($dataRow['personal_id']);
          $pendidikans[]=$pendidikan;
        }
        return $pendidikans;
    }
    
     public function getAllPendidikan(){
        $pendidikans=array();
        $sql="select * from education_history order by id_education";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pendidikan=new Pendidikan();
          $pendidikan->setEducationId($dataRow['id_education']);
          $pendidikan->setLevelPendidikan($dataRow['level_pendidikan']);
          $pendidikan->setTahunMulai($dataRow['tahun_mulai']);
          $pendidikan->setTahunSelesai($dataRow['tahun_selesai']);
          $pendidikan->setInstitusi($dataRow['institusi']);
          $pendidikan->setNilaiRata($dataRow['nilai_rata']);
          $pendidikan->setNoIjazah($dataRow['no_ijazah']);
          $pendidikan->setNegara($dataRow['negara']);
          $pendidikan->setPropinsi($dataRow['propinsi']);
          $pendidikan->setKota($dataRow['kota']);
          $pendidikan->setTglIjazah($dataRow['tgl_ijazah']);
          $pendidikan->setPersonalId($dataRow['personal_id']);
          $pendidikans[]=$pendidikan;
        }
        return $pendidikans;
    }
    
    public function getPendidikan($id){
        $sql="select * from education_history where id_education='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pendidikan=new Pendidikan();
          $pendidikan->setEducationId($dataRow['id_education']);
          $pendidikan->setLevelPendidikan($dataRow['level_pendidikan']);
          $pendidikan->setTahunMulai($dataRow['tahun_mulai']);
          $pendidikan->setTahunSelesai($dataRow['tahun_selesai']);
          $pendidikan->setInstitusi($dataRow['institusi']);
          $pendidikan->setNilaiRata($dataRow['nilai_rata']);
          $pendidikan->setNoIjazah($dataRow['no_ijazah']);
          $pendidikan->setNegara($dataRow['negara']);
          $pendidikan->setPropinsi($dataRow['propinsi']);
          $pendidikan->setKota($dataRow['kota']);
          $pendidikan->setTglIjazah($dataRow['tgl_ijazah']);
          $pendidikan->setPersonalId($dataRow['personal_id']);
        }
        return $pendidikan;
    }
    
    public function getPendidikanCheck($nama, $personalId){
        $pendidikan=NULL;
        $sql="select * from education_history where level_pendidikan='$nama' and personal_id='$personalId'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pendidikan=new Pendidikan();
          $pendidikan->setEducationId($dataRow['id_education']);
          $pendidikan->setLevelPendidikan($dataRow['level_pendidikan']);
          $pendidikan->setTahunMulai($dataRow['tahun_mulai']);
          $pendidikan->setTahunSelesai($dataRow['tahun_selesai']);
          $pendidikan->setInstitusi($dataRow['institusi']);
          $pendidikan->setNilaiRata($dataRow['nilai_rata']);
          $pendidikan->setNoIjazah($dataRow['no_ijazah']);
          $pendidikan->setNegara($dataRow['negara']);
          $pendidikan->setPropinsi($dataRow['propinsi']);
          $pendidikan->setKota($dataRow['kota']);
          $pendidikan->setTglIjazah($dataRow['tgl_ijazah']);
          $pendidikan->setPersonalId($dataRow['personal_id']);
        }
        return $pendidikan;
    }
    
    public function getCariPendidikan($field, $text){
        $pendidikans=array();
        $sql="select * from education_history where $field like '%$text%' order by id_education";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pendidikan=new Pendidikan();
          $pendidikan->setEducationId($dataRow['id_education']);
          $pendidikan->setLevelPendidikan($dataRow['level_pendidikan']);
          $pendidikan->setTahunMulai($dataRow['tahun_mulai']);
          $pendidikan->setTahunSelesai($dataRow['tahun_selesai']);
          $pendidikan->setInstitusi($dataRow['institusi']);
          $pendidikan->setNilaiRata($dataRow['nilai_rata']);
          $pendidikan->setNoIjazah($dataRow['no_ijazah']);
          $pendidikan->setNegara($dataRow['negara']);
          $pendidikan->setPropinsi($dataRow['propinsi']);
          $pendidikan->setKota($dataRow['kota']);
          $pendidikan->setTglIjazah($dataRow['tgl_ijazah']);
          $pendidikan->setPersonalId($dataRow['personal_id']);
          $pendidikans[]=$pendidikan;
        }
        return $pendidikans;
    }
}

?>
