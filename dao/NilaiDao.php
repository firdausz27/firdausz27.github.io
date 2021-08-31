<?php
include_once './model/Nilai.php';
include_once './db/DBConnection.php';
include_once './model/NilaiPersonal.php';
include_once './dao/PersonalDao.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NilaiDao
 *
 * @author asep
 */
class NilaiDao {
    //put your code here
    private $connection;
    private $koneksi;
    private $personalDao;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
        $this->personalDao=new PersonalDao;
    }
    
    public function insert(Nilai $nilai, $listNilai){
        $valid=false;
        $this->koneksi->begin();
        //lakukan inset kedalam nilai
        $sql1="insert into nilai (id_nilai,tanggal,id_jadual,pengajar_id) values 
            ('".$nilai->getIdNilai()."','".InggrisTgl($nilai->getTanggal())."',
                '".$nilai->getIdJadual()."','".$nilai->getIdPengajar()."')";
        $myQry1  =  mysql_query($sql1, $this->connection)or die("Error query :".mysql_error());
       
        //lakukan insert kedalam nilai detail
        foreach ($listNilai as $value){
            $sql2="insert into nilai_personal (id_nilai,id_siswa,kesopanan,kerajinan,disiplin,nilai_kajian,nilai_huruf,keterangan) values 
                ('".$nilai->getIdNilai()."',
                    '".$value->getIdSiswa()."',
                        '".$value->getKesopanan()."',
                            '".$value->getKerajinan()."',
                                '".$value->getDisiplin()."',
                                    '".$value->getNilaiKajian()."',
                                        '".$value->getNilaiHuruf()."',
                                            '".$value->getKeterangan()."')";
            $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
             //lakkan update status personal di jadual
            $sqlUpdate="update jadual_personal set status='1' where id_jadual='".$nilai->getIdJadual()."'
                and personal_id='".$value->getIdSiswa()."'";
            $myQryUpdate= mysql_query($sqlUpdate, $this->connection)or die("Error query :".mysql_error());
        }
        if($myQry1 && $myQry2 && $myQryUpdate){
            $this->koneksi->commit();
            $valid=true;
        }else{
            $this->koneksi->rollback();
            $valid=false;
        }
        return $valid;
        $this->koneksi->closeConnection();
    }
    
    public function insertDetail($listNilai, $idJadual){
        $valid=false;
        $this->koneksi->begin();
        //lakukan insert kedalam nilai detail
        foreach ($listNilai as $value){
            $sql2="insert into nilai_personal (id_nilai,id_siswa,kesopanan,kerajinan,disiplin,nilai_kajian,nilai_huruf,keterangan) values 
                ('".$value->getIdNilai()."',
                    '".$value->getIdSiswa()."',
                        '".$value->getKesopanan()."',
                            '".$value->getKerajinan()."',
                                '".$value->getDisiplin()."',
                                    '".$value->getNilaiKajian()."',
                                        '".$value->getNilaiHuruf()."',
                                            '".$value->getKeterangan()."')";
            $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
            $sqlUpdate="update jadual_personal set status='1' where id_jadual='".$idJadual."'
                and personal_id='".$value->getIdSiswa()."'";
            $myQryUpdate= mysql_query($sqlUpdate, $this->connection)or die("Error query :".mysql_error());
        }
        if($myQry2 && $myQryUpdate){
            $this->koneksi->commit();
            $valid=true;
        }else{
            $this->koneksi->rollback();
            $valid=false;
        }
        return $valid;
        $this->koneksi->closeConnection();
    }
    
    public function update(Nilai $nilai, $listNilai){
        $valid=false;
        $this->koneksi->begin();
        //lakukan update kedalam nilai detail
        $sqlGetNilai="select id_siswa from nilai_personal where id_nilai='".$nilai->getIdNilai()."'";
        $myQryGetNilai  =  mysql_query($sqlGetNilai, $this->connection)or die("Error query :".mysql_error());
        $listEmpNilai=array();
        while ($dataRow=  mysql_fetch_array($myQryGetNilai)){
            $listEmpNilai[]=$dataRow['id_siswa'];
        }
        foreach ($listNilai as $value){
            if(in_array($value->getIdSiswa(), $listEmpNilai)){
                $sql2="update nilai_personal set kesopanan='".$value->getKesopanan()."',kerajinan='".$value->getKerajinan()."',
                    disiplin='".$value->getDisiplin()."',nilai_kajian='".$value->getNilaiKajian()."',
                        nilai_huruf='".$value->getNilaiHuruf()."',keterangan='".$value->getKeterangan()."'
                    where id_nilai='".$nilai->getIdNilai()."' and id_siswa='".$value->getIdSiswa()."'";
                $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
            }else{
                //baru insert
                $sql2="insert into nilai_personal (id_nilai,id_siswa,kesopanan,kerajinan,disiplin,nilai_kajian,nilai_huruf,keterangan) values 
                ('".$nilai->getIdNilai()."',
                    '".$value->getIdSiswa()."',
                        '".$value->getKesopanan()."',
                            '".$value->getKerajinan()."',
                                '".$value->getDisiplin()."',
                                    '".$value->getNilaiKajian()."',
                                        '".$value->getNilaiHuruf()."',
                                            '".$value->getKeterangan()."')";
            $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
             //lakkan update status personal di jadual
            $sqlUpdate="update jadual_personal set status='1' where id_jadual='".$nilai->getIdJadual()."'
                and personal_id='".$value->getIdSiswa()."'";
            $myQryUpdate= mysql_query($sqlUpdate, $this->connection)or die("Error query :".mysql_error());
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
    
    public function delete(Nilai $nilai){
        $hasil=false;
        $this->koneksi->begin();
        $sql="delete from nilai where id_nilai='".$nilai->getIdNilai()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        //lakukan update status menjadi 1
        $sqlUpdate="update jadual_personal set status=0 where id_jadual='".$nilai->getIdJadual()."'";
        $myQryUpdate  =  mysql_query($sqlUpdate, $this->connection)or die("Error query :".mysql_error());
        if($myQry && $myQryUpdate){
            $this->koneksi->commit();
            $hasil=true;
        }else{
            $this->koneksi->rollback();
        }
        return $hasil;
        $this->koneksi->closeConnection();
    }
    
    public function getAllNilaiPage($hal,$row){
        $nilais=array();
        $sql="select * from nilai order by id_nilai asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $nilai=new Nilai();
          $nilai->setRunaganId($dataRow['id_nilai']);
          $nilai->setNama($dataRow['nama_nilai']);
          $nilai->setKeterangan($dataRow['keterangan']);
          $nilais[]=$nilai;
        }
        return $nilais;
    }
    
    public function getAllNilaiDetail($idNilai,$idsiswa){
        $nilai=null;
        $sql="select * from nilai_personal where id_siswa='".$idsiswa."' and id_nilai='".$idNilai."'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $nilai=new NilaiPersonal();
          $nilai->setDisiplin($dataRow['disiplin']);
          $nilai->setIdNilai($dataRow['id_nilai']);
          $nilai->setIdSiswa($dataRow['id_siswa']);
          $nilai->setKerajinan($dataRow['kerajinan']);
          $nilai->setKesopanan($dataRow['kesopanan']);
          $nilai->setKeterangan($dataRow['keterangan']);
          $nilai->setNilaiHuruf($dataRow['nilai_huruf']);
          $nilai->setNilaiKajian($dataRow['nilai_kajian']);
        }
        return $nilai;
    }
    
     public function getValidasiNilai($jadual,$idsiswa){
        $nilai=null;
        $sql="select * from nilai_personal 
            inner join nilai on(nilai.id_nilai=nilai_personal.id_nilai)
            where id_siswa='".$idsiswa."' and id_jadual='".$jadual."'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $nilai=new NilaiPersonal();
          $nilai->setDisiplin($dataRow['disiplin']);
          $nilai->setIdNilai($dataRow['id_nilai']);
          $nilai->setIdSiswa($dataRow['id_siswa']);
          $nilai->setKerajinan($dataRow['kerajinan']);
          $nilai->setKesopanan($dataRow['kesopanan']);
          $nilai->setKeterangan($dataRow['keterangan']);
          $nilai->setNilaiHuruf($dataRow['nilai_huruf']);
          $nilai->setNilaiKajian($dataRow['nilai_kajian']);
        }
        return $nilai;
    }
    
    public function getIdNiali($idJadual,$Pengajar){
            $nilai=NULL;
            $sql="select * from nilai
                where id_jadual='".$idJadual."' 
                    and pengajar_id='".$Pengajar."'";
            $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
            while ($dataRow=  mysql_fetch_array($dataQry)){  
                $nilai=new Nilai();
                $nilai->setIdNilai($dataRow['id_nilai']);
                $nilai->setTanggal($dataRow['tanggal']);
                $nilai->setIdJadual($dataRow['id_jadual']);
                $nilai->setIdPengajar($dataRow['pengajar_id']);
                $nilai->setKeterangan($dataRow['keterangan']);
            }
            return $nilai;
    }
    
     public function getAllNilai(){
        $nilais=array();
        $sql="select * from nilai order by id_nilai";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $nilai=new Nilai();
          $nilai->setRunaganId($dataRow['id_nilai']);
          $nilai->setNama($dataRow['nama_nilai']);
          $nilai->setKeterangan($dataRow['keterangan']);
          $nilais[]=$nilai;
        }
        return $nilais;
    }
    
    public function getNilai(Nilai $nilai){
        $sql="select * from nilai where id_jadual='".$nilai->getIdJadual()."' 
            and pengajar_id='".$nilai->getIdPengajar()."'";
       $nilai=NULL;
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $nilai=new Nilai();
          $nilai->setIdNilai($dataRow['id_nilai']);
          $nilai->setTanggal($dataRow['tanggal']);
          $nilai->setIdJadual($dataRow['id_jadual']);
          $nilai->setIdPengajar($dataRow['pengajar_id']);
          $nilai->setKeterangan($dataRow['keterangan']);
        }
        return $nilai;
    }
    
    public function getNilaiDetail($idNilai){
        $nilaiDetail=array();
            $sql="select * from nilai_personal where id_nilai='".$idNilai."'";
            $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
            while ($dataRow=  mysql_fetch_array($dataQry)){  
              $nilai = new NilaiPersonal();
              $nilai->setIdNilai($dataRow['id_nilai']);
              $nilai->setIdSiswa($this->personalDao->getPersonal($dataRow['id_siswa']));
              $nilai->setKesopanan($dataRow['kesopanan']);
              $nilai->setKerajinan($dataRow['kerajinan']);
              $nilai->setDisiplin($dataRow['disiplin']);
              $nilai->setNilaiKajian($dataRow['nilai_kajian']);
              $nilai->setNilaiHuruf($dataRow['nilai_huruf']);
              $nilai->setKeterangan($dataRow['keterangan']);
              $nilaiDetail[]=$nilai;
            }
        return $nilaiDetail;
    }
    
    public function getCariNilai($field, $text){
        $nilais=array();
        $sql="select * from nilai where $field like '%$text%' order by id_nilai";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $nilai=new Nilai();
          $nilai->setRunaganId($dataRow['id_nilai']);
          $nilai->setNama($dataRow['nama_nilai']);
          $nilai->setKeterangan($dataRow['keterangan']);
          $nilais[]=$nilai;
        }
        return $nilais;
    }
}

?>
