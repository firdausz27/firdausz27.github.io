<?php
include_once './model/Pelajaran.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PelajaranDao
 *
 * @author asep
 */
class PelajaranDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Pelajaran $pelajaran){
        $sql="insert into pelajaran(id_pelajaran,nama_pelajaran,sks,kategori_pelajaran) values 
            ('".$pelajaran->getIdPelajran()."','".$pelajaran->getNamaPelajaran()."','".$pelajaran->getSks()."','".$pelajaran->getKategoriPelajaran()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Pelajaran $pelajaran){
        $sql="update pelajaran set nama_pelajaran='".$pelajaran->getNamaPelajaran()."', 
            sks='".$pelajaran->getSks()."', kategori_pelajaran='".$pelajaran->getKategoriPelajaran()."' where  id_pelajaran='".$pelajaran->getIdPelajran()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Pelajaran $pelajaran){
        $sql="delete from pelajaran where id_pelajaran='".$pelajaran->getIdPelajran()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllPelajaranPage($hal,$row){
        $pelajarans=array();
        $sql="select * from pelajaran order by id_pelajaran asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pelajaran=new Pelajaran();
          $pelajaran->setIdPelajran($dataRow['id_pelajaran']);
          $pelajaran->setNamaPelajaran($dataRow['nama_pelajaran']);
          $pelajaran->setSks($dataRow['sks']);
          $pelajaran->setKategoriPelajaran($dataRow['kategori_pelajaran']);
          $pelajarans[]=$pelajaran;
        }
        return $pelajarans;
    }
    
     public function getAllPelajaran(){
        $pelajarans=array();
        $sql="select * from pelajaran order by id_pelajaran";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pelajaran=new Pelajaran();
          $pelajaran->setIdPelajran($dataRow['id_pelajaran']);
          $pelajaran->setNamaPelajaran($dataRow['nama_pelajaran']);
          $pelajaran->setSks($dataRow['sks']);
          $pelajaran->setKategoriPelajaran($dataRow['kategori_pelajaran']);
          $pelajarans[]=$pelajaran;
        }
        return $pelajarans;
    }
    
    public function getPelajaran($id){
        $sql="select * from pelajaran where id_pelajaran='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pelajaran=new Pelajaran();
          $pelajaran->setIdPelajran($dataRow['id_pelajaran']);
          $pelajaran->setNamaPelajaran($dataRow['nama_pelajaran']);
          $pelajaran->setSks($dataRow['sks']);
          $pelajaran->setKategoriPelajaran($dataRow['kategori_pelajaran']);
        }
        return $pelajaran;
    }
    
    public function getCariPelajaran($field, $text){
        $pelajarans=array();
        $sql="select * from pelajaran where $field like '%$text%' order by id_pelajaran";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pelajaran=new Pelajaran();
          $pelajaran->setIdPelajran($dataRow['id_pelajaran']);
          $pelajaran->setNamaPelajaran($dataRow['nama_pelajaran']);
          $pelajaran->setSks($dataRow['sks']);
          $pelajaran->setKategoriPelajaran($dataRow['kategori_pelajaran']);
          $pelajarans[]=$pelajaran;
        }
        return $pelajarans;
    }
}

?>
