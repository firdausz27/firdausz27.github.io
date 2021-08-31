<?php
include_once './model/Kelas.php';
include_once './model/KelasPersonal.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KelasDao
 *
 * @author asep
 */
class KelasDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Kelas $kelas){
        $valid=false;
        $this->koneksi->begin();
        $sql="insert into kelas (id_kelas,nama_kelas,keterangan) values 
            ('".$kelas->getIdKelas()."','".$kelas->getNamaKelas()."','".$kelas->getKeterangan()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        foreach ($kelas->getKelasPersonal() as $value){
             $sql2="insert into kelas_personal (id_kelas,id_personal) values 
                ('".$kelas->getIdKelas()."','".$value."')";
            $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
        }
        if($myQry && $myQry2){
            $valid=true;
            $this->koneksi->commit();
        }else{
            $this->koneksi->rollback();
        }
        return $valid;
        $this->koneksi->closeConnection();
    }
    
    public function update(Kelas $kelas){
        $valid=false;
        $this->koneksi->begin();
        $sql="update kelas set nama_kelas='".$kelas->getNamaKelas()."', 
            keterangan='".$kelas->getKeterangan()."' where  id_kelas='".$kelas->getIdKelas()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        //hapus data yang sekarang ada 
        $sqlDelete="delete from kelas_personal where id_kelas='".$kelas->getIdKelas()."'";
        $myDelete  =  mysql_query($sqlDelete, $this->connection)or die("Error query :".mysql_error());
        //lakukan insert ulang
        foreach ($kelas->getKelasPersonal() as $value){
             $sql2="insert into kelas_personal (id_kelas,id_personal) values 
                ('".$kelas->getIdKelas()."','".$value."')";
            $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
        }
        if($myQry && $myQry2 && $myDelete){
            $valid=true;
            $this->koneksi->commit();
        }else{
            $this->koneksi->rollback();
        }
        return $valid;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Kelas $kelas){
        $sql="delete from kelas where id_kelas='".$kelas->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKelasPage($hal,$row){
        $kelass=array();
        $sql="select * from kelas order by id_kelas asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kelas=new Kelas();
          $kelas->setIdKelas($dataRow['id_kelas']);
          $kelas->setNamaKelas($dataRow['nama_kelas']);
          $kelas->setKeterangan($dataRow['keterangan']);
          //lakukan select untuk kelas_personal
          $sqlDetail="select * from kelas_personal where id_kelas='".$kelas->getIdKelas()."'";
          $datadetail  =  mysql_query($sqlDetail, $this->connection)or die("Query error :".  mysql_error());
          $listDetail=array();
          while ($dataRow= mysql_fetch_array($datadetail)){
              $detail=new KelasPersonal();
              $detail->setKelasId($kelas->getIdKelas());
              $detail->setPersonalid($dataRow['id_personal']);
              $listDetail[]=$detail;
          }
          $kelas->setKelasPersonal($listDetail);
          $kelass[]=$kelas;
        }
        return $kelass;
    }
    
     public function getAllKelas(){
        $kelass=array();
        $sql="select * from kelas order by id_kelas";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kelas=new Kelas();
          $kelas->setIdKelas($dataRow['id_kelas']);
          $kelas->setNamaKelas($dataRow['nama_kelas']);
          $kelas->setKeterangan($dataRow['keterangan']);
          //lakukan select untuk kelas_personal
          $sqlDetail="select * from kelas_personal where id_kelas='".$kelas->getIdKelas()."'";
          $datadetail  =  mysql_query($sqlDetail, $this->connection)or die("Query error :".  mysql_error());
          $listDetail=array();
          while ($dataRow= mysql_fetch_array($datadetail)){
              $detail=new KelasPersonal();
              $detail->setKelasId($kelas->getIdKelas());
              $detail->setPersonalid($dataRow['id_personal']);
              $listDetail[]=$detail;
          }
          $kelas->setKelasPersonal($listDetail);
          $kelass[]=$kelas;
        }
        return $kelass;
    }
    
    public function getKelas($id){
        $kelas=null;
        $sql="select * from kelas where id_kelas='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kelas=new Kelas();
          $kelas->setIdKelas($dataRow['id_kelas']);
          $kelas->setNamaKelas($dataRow['nama_kelas']);
          $kelas->setKeterangan($dataRow['keterangan']);
          //lakukan select untuk kelas_personal
          $sqlDetail="select * from kelas_personal where id_kelas='".$kelas->getIdKelas()."'";
          $datadetail  =  mysql_query($sqlDetail, $this->connection)or die("Query error :".  mysql_error());
          $listDetail=array();
          while ($dataRow= mysql_fetch_array($datadetail)){
              $detail=new KelasPersonal();
              $detail->setKelasId($kelas->getIdKelas());
              $detail->setPersonalid($dataRow['id_personal']);
              $listDetail[]=$detail;
          }
          $kelas->setKelasPersonal($listDetail);
        }
        return $kelas;
    }
    
    public function getCariKelas($field, $text){
        $kelass=array();
        $sql="select * from kelas where $field like '%$text%' order by id_kelas";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kelas=new Kelas();
          $kelas->setIdKelas($dataRow['id_kelas']);
          $kelas->setNamaKelas($dataRow['nama_kelas']);
          $kelas->setKeterangan($dataRow['keterangan']);
          //lakukan select untuk kelas_personal
          $sqlDetail="select * from kelas_personal where id_kelas='".$kelas->getIdKelas()."'";
          $datadetail  =  mysql_query($sqlDetail, $this->connection)or die("Query error :".  mysql_error());
          $listDetail=array();
          while ($dataRow= mysql_fetch_array($datadetail)){
              $detail=new KelasPersonal();
              $detail->setKelasId($kelas->getIdKelas());
              $detail->setPersonalid($dataRow['id_personal']);
              $listDetail[]=$detail;
          }
          $kelas->setKelasPersonal($listDetail);
          $kelass[]=$kelas;
        }
        return $kelass;
    }
}


