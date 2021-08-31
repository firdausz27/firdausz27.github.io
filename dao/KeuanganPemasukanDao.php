<?php
include_once './model/KeuanganPemasukan.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganPemasukanDao
 *
 * @author asep
 */
class KeuanganPemasukanDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(KeuanganPemasukan $pemasukan){
        $valid=false;
        $this->koneksi->begin();
        //lakukan insert kedalam keuangan pemasukan
        $sql1="insert into keuangan_pemasukan (pemasukan_id,tanggal,kas_id,kategori_id) values 
            ('".$pemasukan->getKode()."','".InggrisTgl($pemasukan->getTanggal())."','".$pemasukan->getKas()."','".$pemasukan->getKategori()."')";
        $myQry1  =  mysql_query($sql1, $this->connection)or die("Error query :".mysql_error());
        //lakukan insert kedalam keuangan pemasukan detail
        foreach ($pemasukan->getPemasukanDetail() as $value){
            $sql2="insert into keuangan_pemasukan_detail (pemasukan_id,personal_id,jumlah,keterangan) values 
                ('".$value->getPemasukanId()."','".$value->getPersonalId()."','".$value->getJumlah()."','".$value->getKeterangan()."')";
            
            $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
            //lakukan update jumlah di kas
             $sql3="update keuangan_kas set jumlah=jumlah+".$value->getJumlah()." where id_kas='".$pemasukan->getKas()."'";
            $myQry3  =  mysql_query($sql3, $this->connection)or die("Error query :".mysql_error());
        }
        if($myQry1 && $myQry2 && $myQry3){
            $this->koneksi->commit();
            $valid=true;
        }else{
            $this->koneksi->rollback();
            $valid=false;
        }
        return $valid;
        $this->koneksi->closeConnection();
    }
    
    public function update(KeuanganPemasukan $pemasukan){
        $sql="update keuangan_pemasukan set nama_pemasukan='".$pemasukan->getNamapemasukan()."', 
            jumlah='".$pemasukan->getJumlah()."', id_personal='".$pemasukan->getPersonalId()."' where  id_pemasukan='".$pemasukan->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(KeuanganPemasukan $pemasukan){
        $sql="delete from keuangan_pemasukan where id_pemasukan='".$pemasukan->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKasPage($hal,$row){
        $pemasukans=array();
        $sql="select * from keuangan_pemasukan order by id_pemasukan asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pemasukan=new KeuanganPemasukan();
          $pemasukan->setKode($dataRow['id_pemasukan']);
          $pemasukan->setNamapemasukan($dataRow['nama_pemasukan']);
          $pemasukan->setJumlah($dataRow['jumlah']);
          $pemasukan->setPersonalId($dataRow['id_personal']);
          $pemasukans[]=$pemasukan;
        }
        return $pemasukans;
    }
    
     public function getAllKas(){
        $pemasukans=array();
        $sql="select * from keuangan_pemasukan order by id_pemasukan";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pemasukan=new KeuanganPemasukan();
          $pemasukan->setKode($dataRow['id_pemasukan']);
          $pemasukan->setNamapemasukan($dataRow['nama_pemasukan']);
          $pemasukan->setJumlah($dataRow['jumlah']);
          $pemasukan->setPersonalId($dataRow['id_personal']);
          $pemasukans[]=$pemasukan;
        }
        return $pemasukans;
    }
    
    public function getKas($id){
        $sql="select * from keuangan_pemasukan where id_pemasukan='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pemasukan=new KeuanganPemasukan();
          $pemasukan->setKode($dataRow['id_pemasukan']);
          $pemasukan->setNamapemasukan($dataRow['nama_pemasukan']);
          $pemasukan->setJumlah($dataRow['jumlah']);
          $pemasukan->setPersonalId($dataRow['id_personal']);
        }
        return $pemasukan;
    }
    
    public function getCariKas($field, $text){
        $pemasukans=array();
        $sql="select * from keuangan_pemasukan where $field like '%$text%' order by id_pemasukan";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pemasukan=new KeuanganPemasukan();
          $pemasukan->setKode($dataRow['id_pemasukan']);
          $pemasukan->setNamapemasukan($dataRow['nama_pemasukan']);
          $pemasukan->setJumlah($dataRow['jumlah']);
          $pemasukan->setPersonalId($dataRow['id_personal']);
          $pemasukans[]=$pemasukan;
        }
        return $pemasukans;
    }
}

?>
