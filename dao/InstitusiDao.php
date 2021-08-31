<?php
include_once './model/Institusi.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstitusiDao
 *
 * @author asep
 */
class InstitusiDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Institusi $institusi){
        $sql="insert into lembaga (nama_lembaga,telepon,alamat,visi,misi) values 
            ('".$institusi->getNamaInstitusi()."','".$institusi->getTeleon()."','".$institusi->getAlamat()."','".$institusi->getVisi()."','".$institusi->getMisi()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Institusi $institusi){
        $sql="update lembaga set nama_lembaga='".$institusi->getNamaInstitusi()."', 
            telepon='".$institusi->getTeleon()."',"
                . "alamat='".$institusi->getAlamat()."',"
                . "visi='".$institusi->getVisi()."',"
                . "misi='".$institusi->getMisi()."'"
                . "where  id_lembaga='".$institusi->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Institusi $institusi){
        $sql="delete from lembaga where id_institusi='".$institusi->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllInstitusiPage($hal,$row){
        $institusis=array();
        $sql="select * from lembaga order by id_institusi asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $institusi=new Institusi();
          $institusi->setKode($dataRow['id_institusi']);
          $institusi->setNamaInstitusi($dataRow['nama_institusi']);
          $institusi->setKeterangan($dataRow['keterangan']);
          $institusis[]=$institusi;
        }
        return $institusis;
    }
    
     public function getAllInstitusi(){
        $institusis=array();
        $sql="select * from lembaga order by id_lembaga";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $institusi=new Institusi();
          $institusi->setKode($dataRow['id_lembaga']);
          $institusi->setNamaInstitusi($dataRow['nama_lembaga']);
          $institusi->setTeleon($dataRow['telepon']);
          $institusi->setAlamat($dataRow['alamat']);
          $institusi->setVisi($dataRow['visi']);
          $institusi->setMisi($dataRow['misi']);
          $institusis[]=$institusi;
        }
        return $institusis;
    }
    
    public function getInstitusi($id){
        $sql="select * from lembaga where id_institusi='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $institusi=new Institusi();
          $institusi->setKode($dataRow['id_lembaga']);
          $institusi->setNamaInstitusi($dataRow['nama_lembaga']);
          $institusi->setTeleon($dataRow['telepon']);
          $institusi->setAlamat($dataRow['alamat']);
          $institusi->setVisi($dataRow['visi']);
          $institusi->setMisi($dataRow['misi']);
        }
        return $institusi;
    }
    
    public function getInstitusiEmp($id){
        $sql="select lembaga.* from emp_institusi inner join lembaga 
            on(emp_institusi.id_institusi=lembaga.id_lembaga)
            where emp_institusi.id_personal='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $institusi=new Institusi();
          $institusi->setKode($dataRow['id_lembaga']);
          $institusi->setNamaInstitusi($dataRow['nama_lembaga']);
          $institusi->setTeleon($dataRow['telepon']);
          $institusi->setAlamat($dataRow['alamat']);
          $institusi->setVisi($dataRow['visi']);
          $institusi->setMisi($dataRow['misi']);
        }
        return $institusi;
    }
    
    public function getCariInstitusi($field, $text){
        $institusis=array();
        $sql="select * from lembaga where $field like '%$text%' order by id_institusi";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $institusi=new Institusi();
          $institusi->setKode($dataRow['id_institusi']);
          $institusi->setNamaInstitusi($dataRow['nama_institusi']);
          $institusi->setKeterangan($dataRow['keterangan']);
          $institusis[]=$institusi;
        }
        return $institusis;
    }
}

?>
