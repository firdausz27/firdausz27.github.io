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
        $sql="insert into jadual (id_jadual,hari,jam_mulai,jam_selesai,id_ruangan,id_pelajaran,kelas_id) values 
            ('".$jadual->getJadualId()."',
                '".$jadual->getHari()."',
                    '".$jadual->getJamMulai()."',
                       '".$jadual->getJamSelesai()."',
                           '".$jadual->getIdRuangan()->getRunaganId()."',
                               '".$jadual->getIdPelajaran()->getIdPelajran()."','".$jadual->getKeals()."')";
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
                               id_pelajaran='".$jadual->getIdPelajaran()->getIdPelajran()."',
                                   kelas_id='".$jadual->getKeals()."'
                                       where  id_jadual='".$jadual->getJadualId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        
        //ini untuk prosess pengajar
        //ambil data dari tabel jadual pengajar
        $sqlGet="select personal_id from jadual_pengajar where jadual_id='".$jadual->getJadualId()."'";
        $myGet =  mysql_query($sqlGet, $this->connection)or die("Error query :".mysql_error());
        $jumlahD=  array();
        while ($dataRow=  mysql_fetch_array($myGet)){
            $jumlahD[]=$dataRow['personal_id'];
        }
        $jumlahData=count($jumlahD);
        $JumlahKirim=  count($jadual->getPengajarId());
        if($jumlahData<=$JumlahKirim){
            foreach ($jadual->getPengajarId() as $value){
                if(in_array($value, $jumlahD)){
                       $sql2="select jadual_id from jadual_pengajar where jadual_id='0'";
                       $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }else{
                     $sql2="insert into jadual_pengajar (jadual_id,personal_id) values (
                        '".$jadual->getJadualId()."','".$value."')";
                    $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }
            }
        }else{
            foreach ($jumlahD as $value){
                if(in_array($value, $jadual->getPengajarId())){
                       //jangan jalankan apa-apa
                }else{
                     $sql2="delete from jadual_pengajar where jadual_id='".$jadual->getJadualId()."' 
                         and personal_id='".$value."'";
                    $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }
            }
        }
        
        //ini prosess untuk pelajar
        //ambil data dari tabel jadual pengajar
        $sqlPel="select personal_id from jadual_personal where id_jadual='".$jadual->getJadualId()."'  and status='0'";
        $myGetPel =  mysql_query($sqlPel, $this->connection)or die("Error query :".mysql_error());
        $jumlahPel=  array();
        while ($dataRow=  mysql_fetch_array($myGetPel)){
            $jumlahPel[]=$dataRow['personal_id'];
        }
        $jumlahDataPel=count($jumlahPel);
        $JumlahKirimPel=  count($jadual->getPelajar());
        if($jumlahDataPel<=$JumlahKirimPel){
            foreach ($jadual->getPelajar() as $valuep){
                if(in_array($valuep, $jumlahPel)){
                       $sql2="select id_jadual from jadual_personal where id_jadual='0'";
                       $myQry3  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }else{
                     $sql2="insert into jadual_personal (id_jadual,personal_id,status) values (
                        '".$jadual->getJadualId()."','".$valuep."','0')";
                    $myQry3  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
                }
            }
        }else{
            foreach ($jumlahPel as $valuepel){
                if(in_array($valuepel, $jadual->getPelajar())){
                       //jangan jalankan apa-apa
                }else{
                     $sql2="delete from jadual_personal where id_jadual='".$jadual->getJadualId()."' 
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
    
    public function delete(Jadual $jadual){
        $sql="delete from jadual where id_jadual='".$jadual->getJadualId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllJadualPage($hal,$row){
        $jaduals=array();
        $sql="select * from jadual where (status is null or status=0) order by kelas_id,hari limit $hal,$row ";
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
          $jadual->setStatus($dataRow['status']);
          $jadual->setKeals($dataRow['kelas_id']);
          $jaduals[]=$jadual;
        }
        return $jaduals;
    }
    
     public function getAllJadual(){
        $jaduals=array();
        $sql="select distinct * from jadual where (status is null or status=0) order by id_pelajaran,hari asc ";
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
          $jadual->setStatus($dataRow['status']);
          $jadual->setKeals($dataRow['kelas_id']);
          $jaduals[]=$jadual;
        }
        return $jaduals;
    }
    
    public function getJadual($id){
        $sqlid="select * from jadual where id_jadual='$id'";
        $dataQryi  =  mysql_query($sqlid, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRows=  mysql_fetch_array($dataQryi)){  
          $jadual=new Jadual();
          $jadual->setJadualId($dataRows['id_jadual']);
          $hr=$dataRows['hari'];
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
          $jadual->setJamMulai($dataRows['jam_mulai']);
          $jadual->setJamSelesai($dataRows['jam_selesai']);//untuk mendapatkan objek ruangan
          $jadual->setIdRuangan($this->ruanganDao->getRuangan($dataRows['id_ruangan']));
          //untuk mendapatkan objek pelajaran
          $jadual->setIdPelajaran($this->pelajaranDao->getPelajaran($dataRows['id_pelajaran']));
          //untuk mendapatkan objek personal
          $sqlPengajar="select personal_id from jadual_pengajar where jadual_id='".$dataRows['id_jadual']."'";
          $dataPengajar  =  mysql_query($sqlPengajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPengajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPengajarId($data);
          //untuk mendapatkan objek peserta didik
          $sqlPelajar="select personal_id from jadual_personal where id_jadual='".$dataRows['id_jadual']."'";
          $dataPelajar  =  mysql_query($sqlPelajar, $this->connection)or die("Query error :".  mysql_error());
          $data=array();
           while ($dataRow1=  mysql_fetch_array($dataPelajar)){ 
               $data[]=$dataRow1['personal_id'];
           }
          $jadual->setPelajar($data);
          $jadual->setStatus($dataRows['status']);
          $jadual->setKeals($dataRows['kelas_id']);
        }
        return $jadual;
    }
    
    public function getCariJadual($field, $text){
        $jaduals=array();
        $sql="select * from jadual "
                . "inner join ruangan 
                  on(jadual.id_ruangan=ruangan.id_ruangan)
                  inner join pelajaran on(jadual.id_pelajaran=pelajaran.id_pelajaran) 
                  inner join kelas on(jadual.kelas_id=kelas.id_kelas)"
                . "where $field like '%$text%' order by status,hari,jam_mulai";
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
          $jadual->setStatus($dataRow['status']);
          $jadual->setKeals($dataRow['kelas_id']);
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
          $jadu->setStatus($dataRow['status']);
        }
        return $jadu;
    }
    
    public function  getJadualByGuru($personalId){
        $jaduals=array();
        $sql="SELECT * from jadual 
            inner join jadual_pengajar on(jadual_pengajar.jadual_id=jadual.id_jadual)
            where jadual_pengajar.personal_id ='".$personalId."' and (status is null or status =0)";
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
          $jadual->setStatus($dataRow['status']);
          $jadual->setKeals($dataRow['kelas_id']);
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
          $jadual->setStatus($dataRow['status']);
          $jadual->setKeals($dataRow['kelas_id']);
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
