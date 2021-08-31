<?php
include_once './model/Jadual.php';
include_once './db/DBConnection.php';
include_once './dao/RuanganDao.php';
include_once './dao/PelajaranDao.php';
include_once './dao/PersonalDao.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JadualDao
 *
 * @author asep
 */
class JadualDao {
    //put your code here
    private $connection;
    private $koneksi;
    private $ruanganDao;
    private $pelajaranDao;
    private $personalDao;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
        $this->ruanganDao=new RuanganDao();
        $this->pelajaranDao=new PelajaranDao();
        $this->personalDao=new PersonalDao();
    }
    
    public function insert(Jadual $jadual){
        $kembali=false;
        $this->koneksi->begin();
        $sql="insert into jadual (id_jadual,hari,jam_mulai,jam_selesai,id_ruangan,id_pelajaran) values 
            ('".$jadual->getJadualId()."',
                '".$jadual->getHari()."',
                    '".$jadual->getJamMulai()."',
                       '".$jadual->getJamSelesai()."',
                           '".$jadual->getIdRuangan()->getRunaganId()."',
                               '".$jadual->getIdPelajaran()->getIdPelajran()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
       //untuk prosess insert pengajar
        foreach ($jadual->getPengajarId() as $value1){
            $sql2="insert into jadual_pengajar (jadual_id,personal_id) values (
                '".$jadual->getJadualId()."','".$value1."')";
            $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
        }
        //untuk prosess insert pelajar
         foreach ($jadual->getPelajar() as $value2){
            $sql3="insert into jadual_personal (id_jadual,personal_id,status) values (
                '".$jadual->getJadualId()."','".$value2."','0')";
            
            $myQry3  =  mysql_query($sql3, $this->connection)or die("Error query :".mysql_error());
        }
        if($myQry && $myQry2 && $myQry3){
            $this->koneksi->commit();
            $kembali=true;
        }else{
            $this->koneksi->rollback();
        }
        return $kembali;
        $this->koneksi->closeConnection();
    }
    
    public function update(Jadual $jadual){
        $kembali=false;
        $this->koneksi->begin();
        $sql="update jadual set 
                hari='".$jadual->getHari()."',
                    jam_mulai='".$jadual->getJamMulai()."',
                       jam_selesai='".$jadual->getJamSelesai()."',
                           id_ruangan='".$jadual->getIdRuangan()->getRunaganId()."',
                               id_pelajaran='".$jadual->getIdPelajaran()->getIdPelajran()."'
                                   where  id_jadual='".$jadual->getJadualId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        
        
        //lakukan delete dan insert yang baru
        $sqlDeletePengajar="delete from jadual_pengajar where jadual_id='".$jadual->getJadualId()."'";
        $myQryDeletePengajar  =  mysql_query($sqlDeletePengajar, $this->connection)or die("Error query :".mysql_error());
        foreach ($jadual->getPengajarId() as $value){
            $sqlInsertPengajar="insert into jadual_pengajar (jadual_id,personal_id) values (
               '".$jadual->getJadualId()."','".$value."')";
           $myQryInsertPengajar  =  mysql_query($sqlInsertPengajar, $this->connection)or die("Error query :".mysql_error());
       }
        //ini prosess untuk pelajar
       $sqlDeletePelajar="delete from jadual_personal where id_jadual='".$jadual->getJadualId()."'";
       $myQryDeletePelajar  =  mysql_query($sqlDeletePelajar, $this->connection)or die("Error query :".mysql_error());
        foreach ($jadual->getPelajar() as $valuep){
            $sqlInsertPelajar="insert into jadual_personal (id_jadual,personal_id,status) values (
               '".$jadual->getJadualId()."','".$valuep."','0')";
           $myQryInsertPelajar  =  mysql_query($sqlInsertPelajar, $this->connection)or die("Error query :".mysql_error());
       }
        
         if($myQry && $myQryDeletePengajar && $myQryInsertPengajar && $myQryDeletePelajar && $myQryInsertPelajar){
            $this->koneksi->commit();
            $kembali=true;
        }else{
            $this->koneksi->rollback();
        }
        return $kembali;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Jadual $jadual){
        $sql="delete from jadual where id_jadual='".$jadual->getJadualId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllJadualPage($hal,$row){
        $jaduals=array();
        $sql="select * from jadual where (status is null or status=0) order by id_ruangan,hari,jam_mulai asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $jadual=new Jadual();
          $jadual->setJadualId($dataRow['id_jadual']);
          $hr=$dataRow['hari'];
            if($hr=='7'){
                $hari= 'Minggu';
            }else if($hr=='6'){
                $hari= 'Sabtu';
            }else if($hr=='5'){
                $hari= 'Jumat';
            }else if($hr=='4'){
                $hari= 'Kamis';
            }else if($hr=='3'){
                $hari= 'Rabu';
            }else if($hr=='2'){
                $hari= 'Selasa';
            }else{
                $hari= 'Senin';
            }
          $jadual->setHari($hari);
          $jadual->setJamMulai($dataRow['jam_mulai']);
          $jadual->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $jadual->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $jadual->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPelajar($data);
          $jadual->setSmester($dataRow['smester']);
          $jaduals[]=$jadual;
        }
        return $jaduals;
    }
    
     public function getAllJadual(){
        $jaduals=array();
        $sql="select * from jadual order by id_pelajaran,hari asc ";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $jadual=new Jadual();
          $jadual->setJadualId($dataRow['id_jadual']);
          $hr=$dataRow['hari'];
            if($hr=='7'){
                $hari= 'Minggu';
            }else if($hr=='6'){
                $hari= 'Sabtu';
            }else if($hr=='5'){
                $hari= 'Jumat';
            }else if($hr=='4'){
                $hari= 'Kamis';
            }else if($hr=='3'){
                $hari= 'Rabu';
            }else if($hr=='2'){
                $hari= 'Selasa';
            }else{
                $hari= 'Senin';
            }
          $jadual->setHari($hari);
          $jadual->setJamMulai($dataRow['jam_mulai']);
          $jadual->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $jadual->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $jadual->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPelajar($data);
          $jadual->setSmester($dataRow['smester']);
          $jaduals[]=$jadual;
        }
        return $jaduals;
    }
    
    public function getJadual($id){
        $sql="select * from jadual where id_jadual='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $jadual=new Jadual();
          $jadual->setJadualId($dataRow['id_jadual']);
          $hr=$dataRow['hari'];
            if($hr=='7'){
                $hari= 'Minggu';
            }else if($hr=='6'){
                $hari= 'Sabtu';
            }else if($hr=='5'){
                $hari= 'Jumat';
            }else if($hr=='4'){
                $hari= 'Kamis';
            }else if($hr=='3'){
                $hari= 'Rabu';
            }else if($hr=='2'){
                $hari= 'Selasa';
            }else{
                $hari= 'Senin';
            }
          $jadual->setHari($hari);
          $jadual->setJamMulai($dataRow['jam_mulai']);
          $jadual->setJamSelesai($dataRow['jam_selesai']);//untuk mendapatkan objek ruangan
          $jadual->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $jadual->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPelajar($data);
          $jadual->setSmester($dataRow['smester']);
        }
        return $jadual;
    }
    
    public function getCariJadual($field, $text){
        $jaduals=array();
        $sql="select * from jadual where $field like '%$text%' order by smester,hari,jam_mulai";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $jadual=new Jadual();
          $jadual->setJadualId($dataRow['id_jadual']);
          $hr=$dataRow['hari'];
            if($hr=='7'){
                $hari= 'Minggu';
            }else if($hr=='6'){
                $hari= 'Sabtu';
            }else if($hr=='5'){
                $hari= 'Jumat';
            }else if($hr=='4'){
                $hari= 'Kamis';
            }else if($hr=='3'){
                $hari= 'Rabu';
            }else if($hr=='2'){
                $hari= 'Selasa';
            }else{
                $hari= 'Senin';
            }
          $jadual->setHari($hari);
          $jadual->setJamMulai($dataRow['jam_mulai']);
          $jadual->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $jadual->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $jadual->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
         // $jadual->setPengajarId($this->personalDao->getPersonal($dataRow['personal_id']));
           $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPelajar($data);
          $jadual->setSmester($dataRow['smester']);
          $jaduals[]=$jadual;
        }
        return $jaduals;
    }
    
    public function getValidasiJadual(Jadual $jadual){
        $sql="SELECT * from jadual where hari='".$jadual->getHari()."' 
            and (jam_mulai >'".$jadual->getJamMulai()."' and jam_mulai<'".$jadual->getJamSelesai()."')
            or (jam_selesai>'".$jadual->getJamMulai()."' and jam_selesai<'".$jadual->getJamSelesai()."')
            and id_ruangan='".$jadual->getIdRuangan()->getRunaganId()."'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $jadu=new Jadual();
          $jadu->setJadualId($dataRow['id_jadual']);
          $hr=$dataRow['hari'];
            if($hr=='7'){
                $hari= 'Minggu';
            }else if($hr=='6'){
                $hari= 'Sabtu';
            }else if($hr=='5'){
                $hari= 'Jumat';
            }else if($hr=='4'){
                $hari= 'Kamis';
            }else if($hr=='3'){
                $hari= 'Rabu';
            }else if($hr=='2'){
                $hari= 'Selasa';
            }else{
                $hari= 'Senin';
            }
          $jadu->setHari($hari);
          $jadu->setJamMulai($dataRow['jam_mulai']);
          $jadu->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $jadu->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $jadu->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          //$jadu->setPengajarId($this->personalDao->getPersonal($dataRow['personal_id']));
           $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPelajar($data);
          $jadu->setSmester($dataRow['smester']);
        }
        return $jadu;
    }
    
    public function  getJadualByGuru($personalId){
        $jaduals=array();
        $sql="SELECT * from jadual 
            inner join jadual_pengajar on(jadual_pengajar.jadual_id=jadual.id_jadual)
            where jadual_pengajar.personal_id ='".$personalId."'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $jadual=new Jadual();
          $jadual->setJadualId($dataRow['id_jadual']);
          $hr=$dataRow['hari'];
            if($hr=='7'){
                $hari= 'Minggu';
            }else if($hr=='6'){
                $hari= 'Sabtu';
            }else if($hr=='5'){
                $hari= 'Jumat';
            }else if($hr=='4'){
                $hari= 'Kamis';
            }else if($hr=='3'){
                $hari= 'Rabu';
            }else if($hr=='2'){
                $hari= 'Selasa';
            }else{
                $hari= 'Senin';
            }
          $jadual->setHari($hari);
          $jadual->setJamMulai($dataRow['jam_mulai']);
          $jadual->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $jadual->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $jadual->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          //$jadual->setPengajarId($this->personalDao->getPersonal($dataRow['personal_id']));
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPelajar($data);
          $jadual->setSmester($dataRow['smester']);
          $jaduals[]=$jadual;
        }
        return $jaduals;
    }
    
    public function getJadualNotInPer($personalId){
        $jaduals=array();
        $sql="SELECT * from jadual where id_jadual not in
            (select id_jadual from jadual_personal where personal_id='".$personalId."')";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $jadual=new Jadual();
          $jadual->setJadualId($dataRow['id_jadual']);
          $hr=$dataRow['hari'];
            if($hr=='7'){
                $hari= 'Minggu';
            }else if($hr=='6'){
                $hari= 'Sabtu';
            }else if($hr=='5'){
                $hari= 'Jumat';
            }else if($hr=='4'){
                $hari= 'Kamis';
            }else if($hr=='3'){
                $hari= 'Rabu';
            }else if($hr=='2'){
                $hari= 'Selasa';
            }else{
                $hari= 'Senin';
            }
          $jadual->setHari($hari);
          $jadual->setJamMulai($dataRow['jam_mulai']);
          $jadual->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $jadual->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $jadual->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          //$jadual->setPengajarId($this->personalDao->getPersonal($dataRow['personal_id']));
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPelajar($data);
          $jadual->setSmester($dataRow['smester']);
          $jaduals[]=$jadual;
        }
        return $jaduals;
    }
    
    public function getMaxJamselesai(Jadual $jadual){
        //$jadu=NULL;
        $sql="SELECT max(jam_selesai) jam_selesai from jadual where hari='".$jadual->getHari()."' 
            and id_ruangan='".$jadual->getIdRuangan()->getRunaganId()."'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $jadual->setJamMulai(minutesToHours(hoursToMinutes($dataRow['jam_selesai'])));
          if($dataRow['jam_selesai']==""){
              $jadual->setJamMulai("06:00");
          }
          $sks=hoursToMinutes($jadual->getIdPelajaran()->getSks());
          $jamAwal=hoursToMinutes($jadual->getJamMulai());
          
          $jadual->setJamSelesai(minutesToHours($jamAwal+$sks));
        }
        return $jadual;
    }
    
    
    
}

?>
