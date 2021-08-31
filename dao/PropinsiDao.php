<?php
include_once './model/Propinsi.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PropinsiDao
 *
 * @author asep
 */
class PropinsiDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Propinsi $propinsi){
        $sql="insert into propinsi (nama_propinsi,keterangan) values 
            ('".$propinsi->getNama()."','".$propinsi->getKeterangan()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Propinsi $propinsi){
        $sql="update propinsi set nama_propinsi='".$propinsi->getNama()."', 
            keterangan='".$propinsi->getKeterangan()."' where  id_propinsi='".$propinsi->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Propinsi $propinsi){
        $sql="delete from propinsi where id_propinsi='".$propinsi->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllPropinsiPage($hal,$row){
        $propinsis=array();
        $sql="select * from propinsi order by id_propinsi asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $propinsi=new Propinsi();
          $propinsi->setKode($dataRow['id_propinsi']);
          $propinsi->setNama($dataRow['nama_propinsi']);
          $propinsi->setKeterangan($dataRow['keterangan']);
          $propinsis[]=$propinsi;
        }
        return $propinsis;
    }
    
     public function getAllPropinsi(){
        $propinsis=array();
        // $sql="select * from propinsi order by nama_propinsi";
        $sql= "select * from wilayah_provinsi order by nama";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $propinsi=new Propinsi();
          $propinsi->setKode($dataRow['id']);
          $propinsi->setNama($dataRow['nama']);
        //   $propinsi->setKeterangan($dataRow['keterangan']);
          $propinsis[]=$propinsi;
        }
        return $propinsis;
    }
    
    public function getPropinsi($id){
        $propinsi=NULL;
        $sql="select * from propinsi where id_propinsi='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $propinsi=new Propinsi();
          $propinsi->setKode($dataRow['id_propinsi']);
          $propinsi->setNama($dataRow['nama_propinsi']);
          $propinsi->setKeterangan($dataRow['keterangan']);
        }
        return $propinsi;
    }
    
    public function getCariPropinsi($field, $text){
        $propinsis=array();
        $sql="select * from propinsi where $field like '%$text%' order by id_propinsi";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $propinsi=new Propinsi();
          $propinsi->setKode($dataRow['id_propinsi']);
          $propinsi->setNama($dataRow['nama_propinsi']);
          $propinsi->setKeterangan($dataRow['keterangan']);
          $propinsis[]=$propinsi;
        }
        return $propinsis;
    }
}

?>
