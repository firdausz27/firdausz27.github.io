<?php
include_once './model/KategoriPelajaran.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KategoriPelajaranDao
 *
 * @author asep
 */
class KategoriPelajaranDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(KategoriPelajaran $kategori){
        $sql="insert into kategori_pelajaran (id_kategori,nama_kategori,keterangan) values 
            ('".$kategori->getKode()."','".$kategori->getNamaKategori()."','".$kategori->getKeterangan()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(KategoriPelajaran $kategori){
        $sql="update kategori_pelajaran set nama_kategori='".$kategori->getNamaKategori()."', 
            keterangan='".$kategori->getKeterangan()."' where  id_kategori='".$kategori->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(KategoriPelajaran $kategori){
        $sql="delete from kategori_pelajaran where id_kategori='".$kategori->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKategoriPage($hal,$row){
        $kategoris=array();
        $sql="select * from kategori_pelajaran order by id_kategori asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KategoriPelajaran();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
          $kategoris[]=$kategori;
        }
        return $kategoris;
    }
    
     public function getAllKategori(){
        $kategoris=array();
        $sql="select * from kategori_pelajaran order by id_kategori";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KategoriPelajaran();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
          $kategoris[]=$kategori;
        }
        return $kategoris;
    }
    
    public function getKategori($id){
        $sql="select * from kategori_pelajaran where id_kategori='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KategoriPelajaran();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
        }
        return $kategori;
    }
    
    public function getCariKategori($field, $text){
        $kategoris=array();
        $sql="select * from kategori_pelajaran where $field like '%$text%' order by id_kategori";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KategoriPelajaran();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
          $kategoris[]=$kategori;
        }
        return $kategoris;
    }
}

?>
