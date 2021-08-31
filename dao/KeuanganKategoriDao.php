<?php
include_once './model/KeuanganKategori.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganKategoriDao
 *
 * @author asep
 */
class KeuanganKategoriDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(KeuanganKategori $kategori){
        $sql="insert into keuangan_kategori (id_kategori,nama_kategori,keterangan) values 
            ('".$kategori->getKode()."','".$kategori->getNamaKategori()."','".$kategori->getKeterangan()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(KeuanganKategori $kategori){
        $sql="update keuangan_kategori set nama_kategori='".$kategori->getNamaKategori()."', 
            keterangan='".$kategori->getKeterangan()."' where  id_kategori='".$kategori->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(KeuanganKategori $kategori){
        $sql="delete from keuangan_kategori where id_kategori='".$kategori->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKategoriPage($hal,$row){
        $kategoris=array();
        $sql="select * from keuangan_kategori order by id_kategori asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KeuanganKategori();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
          $kategoris[]=$kategori;
        }
        return $kategoris;
    }
    
     public function getAllKategori(){
        $kategoris=array();
        $sql="select * from keuangan_kategori order by id_kategori";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KeuanganKategori();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
          $kategoris[]=$kategori;
        }
        return $kategoris;
    }
    
    public function getKategori($id){
        $sql="select * from keuangan_kategori where id_kategori='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KeuanganKategori();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
        }
        return $kategori;
    }
    
    public function getCariKategori($field, $text){
        $kategoris=array();
        $sql="select * from keuangan_kategori where $field like '%$text%' order by id_kategori";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KeuanganKategori();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
          $kategoris[]=$kategori;
        }
        return $kategoris;
    }
}

?>
