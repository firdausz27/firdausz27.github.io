<?php
include_once './model/KeuanganPengKategori.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganPengKategoriDao
 *
 * @author asep
 */
class KeuanganPengKategoriDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(KeuanganPengKategori $kategori){
        $sql="insert into keuangan_peng_kategori (id_kategori,nama_kategori,keterangan) values 
            ('".$kategori->getKode()."','".$kategori->getNamaKategori()."','".$kategori->getKeterangan()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(KeuanganPengKategori $kategori){
        $sql="update keuangan_peng_kategori set nama_kategori='".$kategori->getNamaKategori()."', 
            keterangan='".$kategori->getKeterangan()."' where  id_kategori='".$kategori->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(KeuanganPengKategori $kategori){
        $sql="delete from keuangan_peng_kategori where id_kategori='".$kategori->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKategoriPage($hal,$row){
        $kategoris=array();
        $sql="select * from keuangan_peng_kategori order by id_kategori asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KeuanganPengKategori();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
          $kategoris[]=$kategori;
        }
        return $kategoris;
    }
    
     public function getAllKategori(){
        $kategoris=array();
        $sql="select * from keuangan_peng_kategori order by id_kategori";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KeuanganPengKategori();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
          $kategoris[]=$kategori;
        }
        return $kategoris;
    }
    
    public function getKategori($id){
        $sql="select * from keuangan_peng_kategori where id_kategori='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KeuanganPengKategori();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
        }
        return $kategori;
    }
    
    public function getCariKategori($field, $text){
        $kategoris=array();
        $sql="select * from keuangan_peng_kategori where $field like '%$text%' order by id_kategori";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kategori=new KeuanganPengKategori();
          $kategori->setKode($dataRow['id_kategori']);
          $kategori->setNamaKategori($dataRow['nama_kategori']);
          $kategori->setKeterangan($dataRow['keterangan']);
          $kategoris[]=$kategori;
        }
        return $kategoris;
    }
}

?>
