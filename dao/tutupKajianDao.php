<?php
include_once './model/TutupKajian.php';
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
class tutupKajianDao {
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
    
    public function insert(TutupKajian $tutup){
        $kembali=false;
        $this->koneksi->begin();
        $sql="insert into tutup_kajian (tanggal,jadual_id) values 
            ('".InggrisTgl($tutup->getTanggal())."',
                '".$tutup->getJadualId()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
       //untuk merubah status jadual supaya tidak muncul lagi
        $sql2="update jadual set status=1 where id_jadual='".$tutup->getJadualId()."'";
        $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
        
        if($myQry && $myQry2){
            $this->koneksi->commit();
            $kembali=true;
        }else{
            $this->koneksi->rollback();
        }
        return $kembali;
        $this->koneksi->closeConnection();
    }
    
    public function update(Jadual $tutup){
        $kembali=false;
        $this->koneksi->begin();
        $sql="update jadual set 
                hari='".$tutup->getHari()."',
                    jam_mulai='".$tutup->getJamMulai()."',
                       jam_selesai='".$tutup->getJamSelesai()."',
                           id_ruangan='".$tutup->getIdRuangan()->getRunaganId()."',
                               id_pelajaran='".$tutup->getIdPelajaran()->getIdPelajran()."'
                                   where  id_jadual='".$tutup->getJadualId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        
        //ini untuk prosess pengajar
        //ambil data dari tabel jadual pengajar
        $sqlGet="select personal_id from jadual_pengajar where jadual_id='".$tutup->getJadualId()."'";
        $myGet =  mysql_query($sqlGet, $this->connection)or die("Error query :".mysql_error());
        $jumlahD=  array();
        while ($dataRow=  mysql_fetch_array($myGet)){
            $jumlahD[]=$dataRow['personal_id'];
        }
        $jumlahData=count($jumlahD);
        $JumlahKirim=  count($tutup->getPengajarId());
        if($jumlahData<=$JumlahKirim){
            foreach ($tutup->getPengajarId() as $value){
                if(in_array($value, $jumlahD)){
                       $sql2="select jadual_id from jadual_pengajar where jadual_id='0'";
                       $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }else{
                     $sql2="insert into jadual_pengajar (jadual_id,personal_id) values (
                        '".$tutup->getJadualId()."','".$value."')";
                    $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }
            }
        }else{
            foreach ($jumlahD as $value){
                if(in_array($value, $tutup->getPengajarId())){
                       //jangan jalankan apa-apa
                }else{
                     $sql2="delete from jadual_pengajar where jadual_id='".$tutup->getJadualId()."' 
                         and personal_id='".$value."'";
                    $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }
            }
        }
        
        //ini prosess untuk pelajar
        //ambil data dari tabel jadual pengajar
        $sqlPel="select personal_id from jadual_personal where id_jadual='".$tutup->getJadualId()."'  and status='0'";
        $myGetPel =  mysql_query($sqlPel, $this->connection)or die("Error query :".mysql_error());
        $jumlahPel=  array();
        while ($dataRow=  mysql_fetch_array($myGetPel)){
            $jumlahPel[]=$dataRow['personal_id'];
        }
        $jumlahDataPel=count($jumlahPel);
        $JumlahKirimPel=  count($tutup->getPelajar());
        if($jumlahDataPel<=$JumlahKirimPel){
            foreach ($tutup->getPelajar() as $valuep){
                if(in_array($valuep, $jumlahPel)){
                       $sql2="select id_jadual from jadual_personal where id_jadual='0'";
                       $myQry3  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }else{
                     $sql2="insert into jadual_personal (id_jadual,personal_id,status) values (
                        '".$tutup->getJadualId()."','".$valuep."','0')";
                    $myQry3  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }
            }
        }else{
            foreach ($jumlahPel as $valuepel){
                if(in_array($valuepel, $tutup->getPelajar())){
                       //jangan jalankan apa-apa
                }else{
                     $sql2="delete from jadual_personal where id_jadual='".$tutup->getJadualId()."' 
                         and personal_id='".$valuepel."'";
                    $myQry3  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }
            }
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
    
    public function delete(Jadual $tutup){
        $sql="delete from jadual where id_jadual='".$tutup->getJadualId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllJadualPage($hal,$row){
        $tutups=array();
        $sql="select * from jadual order by id_ruangan,hari,jam_mulai asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tutup=new Jadual();
          $tutup->setJadualId($dataRow['id_jadual']);
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
          $tutup->setHari($hari);
          $tutup->setJamMulai($dataRow['jam_mulai']);
          $tutup->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $tutup->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $tutup->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPelajar($data);
          $tutup->setStatus($dataRow['status']);
          $tutups[]=$tutup;
        }
        return $tutups;
    }
    
     public function getAllJadual(){
        $tutups=array();
        $sql="select * from jadual order by id_pelajaran,hari asc ";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tutup=new Jadual();
          $tutup->setJadualId($dataRow['id_jadual']);
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
          $tutup->setHari($hari);
          $tutup->setJamMulai($dataRow['jam_mulai']);
          $tutup->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $tutup->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $tutup->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPelajar($data);
          $tutup->setStatus($dataRow['status']);
          $tutups[]=$tutup;
        }
        return $tutups;
    }
    
    public function getJadual($id){
        $sql="select * from jadual where id_jadual='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tutup=new Jadual();
          $tutup->setJadualId($dataRow['id_jadual']);
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
          $tutup->setHari($hari);
          $tutup->setJamMulai($dataRow['jam_mulai']);
          $tutup->setJamSelesai($dataRow['jam_selesai']);//untuk mendapatkan objek ruangan
          $tutup->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $tutup->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPelajar($data);
          $tutup->setStatus($dataRow['status']);
        }
        return $tutup;
    }
    
    public function getCariJadual($field, $text){
        $tutups=array();
        $sql="select * from jadual where $field like '%$text%' order by status,hari,jam_mulai";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tutup=new Jadual();
          $tutup->setJadualId($dataRow['id_jadual']);
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
          $tutup->setHari($hari);
          $tutup->setJamMulai($dataRow['jam_mulai']);
          $tutup->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $tutup->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $tutup->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
         // $tutup->setPengajarId($this->personalDao->getPersonal($dataRow['personal_id']));
           $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPelajar($data);
          $tutup->setStatus($dataRow['status']);
          $tutups[]=$tutup;
        }
        return $tutups;
    }
    
    public function getValidasiJadual(Jadual $tutup){
        $sql="SELECT * from jadual where hari='".$tutup->getHari()."' 
            and (jam_mulai >'".$tutup->getJamMulai()."' and jam_mulai<'".$tutup->getJamSelesai()."')
            or (jam_selesai>'".$tutup->getJamMulai()."' and jam_selesai<'".$tutup->getJamSelesai()."')
            and id_ruangan='".$tutup->getIdRuangan()->getRunaganId()."'";
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
          $tutup->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPelajar($data);
          $jadu->setStatus($dataRow['status']);
        }
        return $jadu;
    }
    
    public function  getJadualByGuru($personalId){
        $tutups=array();
        $sql="SELECT * from jadual 
            inner join jadual_pengajar on(jadual_pengajar.jadual_id=jadual.id_jadual)
            where jadual_pengajar.personal_id ='".$personalId."'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tutup=new Jadual();
          $tutup->setJadualId($dataRow['id_jadual']);
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
          $tutup->setHari($hari);
          $tutup->setJamMulai($dataRow['jam_mulai']);
          $tutup->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $tutup->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $tutup->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          //$tutup->setPengajarId($this->personalDao->getPersonal($dataRow['personal_id']));
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPelajar($data);
          $tutup->setStatus($dataRow['status']);
          $tutups[]=$tutup;
        }
        return $tutups;
    }
    
    public function getJadualNotInPer($personalId){
        $tutups=array();
        $sql="SELECT * from jadual where id_jadual not in
            (select id_jadual from jadual_personal where personal_id='".$personalId."')";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tutup=new Jadual();
          $tutup->setJadualId($dataRow['id_jadual']);
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
          $tutup->setHari($hari);
          $tutup->setJamMulai($dataRow['jam_mulai']);
          $tutup->setJamSelesai($dataRow['jam_selesai']);
          //untuk mendapatkan objek ruangan
          $tutup->setIdRuangan($this->ruanganDao->getRuangan($dataRow['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $tutup->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRow['id_pelajaran']));
          //untuk mendapatkan objek personal
          //$tutup->setPengajarId($this->personalDao->getPersonal($dataRow['personal_id']));
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRow['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRow['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $tutup->setPelajar($data);
          $tutup->setStatus($dataRow['status']);
          $tutups[]=$tutup;
        }
        return $tutups;
    }
    
    public function getMaxJamselesai(Jadual $tutup){
        //$jadu=NULL;
        $sql="SELECT max(jam_selesai) jam_selesai from jadual where hari='".$tutup->getHari()."' 
            and id_ruangan='".$tutup->getIdRuangan()->getRunaganId()."'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tutup->setJamMulai(minutesToHours(hoursToMinutes($dataRow['jam_selesai'])));
          if($dataRow['jam_selesai']==""){
              $tutup->setJamMulai("06:00");
          }
          $sks=hoursToMinutes($tutup->getIdPelajaran()->getSks());
          $jamAwal=hoursToMinutes($tutup->getJamMulai());
          
          $tutup->setJamSelesai(minutesToHours($jamAwal+$sks));
        }
        return $tutup;
    }
    
    
    
}

?>
