<?php
include_once './model/KeuanganPengeluaran.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganPengeluaranDao
 *
 * @author asep
 */
class KeuanganPengeluaranDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(KeuanganPengeluaran $pengeluaran){
        $valid=false;
        $this->koneksi->begin();
        //lakukan insert kedalam keuangan pemasukan
        $sql1="insert into keuangan_pengeluaran (pengeluaran_id,tanggal,kas_id,kategori_id) values 
            ('".$pengeluaran->getKode()."','".InggrisTgl($pengeluaran->getTanggal())."','".$pengeluaran->getKas()."','".$pengeluaran->getKategori()."')";
        $myQry1  =  mysql_query($sql1, $this->connection)or die("Error query :".mysql_error());
        //lakukan insert kedalam keuangan pemasukan detail
        foreach ($pengeluaran->getPengeluaranDetail() as $value){
            $sql2="insert into keuangan_pengeluaran_detail (pengeluaran_id,nama_pengeluaran,jumlah,keterangan) values 
                ('".$value->getPengeluaranId()."','".$value->getNamaPengeluaran()."','".$value->getJumlah()."','".$value->getKeterangan()."')";
            
            $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
            //lakukan update jumlah di kas
             $sql3="update keuangan_kas set jumlah=jumlah-".$value->getJumlah()." where id_kas='".$pengeluaran->getKas()."'";
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
    
    public function update(KeuanganPengeluaran $pengeluaran){
        $sql="update keuangan_pengeluaran set nama_pemasukan='".$pengeluaran->getNamapemasukan()."', 
            jumlah='".$pengeluaran->getJumlah()."', id_personal='".$pengeluaran->getPersonalId()."' where  id_pemasukan='".$pengeluaran->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(KeuanganPengeluaran $pengeluaran){
        $sql="delete from keuangan_pengeluaran where id_pemasukan='".$pengeluaran->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKasPage($hal,$row){
        $pengeluarans=array();
        $sql="select * from keuangan_pengeluaran order by id_pemasukan asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pengeluaran=new KeuanganPengeluaran();
          $pengeluaran->setKode($dataRow['id_pemasukan']);
          $pengeluaran->setNamapemasukan($dataRow['nama_pemasukan']);
          $pengeluaran->setJumlah($dataRow['jumlah']);
          $pengeluaran->setPersonalId($dataRow['id_personal']);
          $pengeluarans[]=$pengeluaran;
        }
        return $pengeluarans;
    }
    
     public function getAllKas(){
        $pengeluarans=array();
        $sql="select * from keuangan_pengeluaran order by id_pemasukan";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pengeluaran=new KeuanganPengeluaran();
          $pengeluaran->setKode($dataRow['id_pemasukan']);
          $pengeluaran->setNamapemasukan($dataRow['nama_pemasukan']);
          $pengeluaran->setJumlah($dataRow['jumlah']);
          $pengeluaran->setPersonalId($dataRow['id_personal']);
          $pengeluarans[]=$pengeluaran;
        }
        return $pengeluarans;
    }
    
    public function getKas($id){
        $sql="select * from keuangan_pengeluaran where id_pemasukan='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pengeluaran=new KeuanganPengeluaran();
          $pengeluaran->setKode($dataRow['id_pemasukan']);
          $pengeluaran->setNamapemasukan($dataRow['nama_pemasukan']);
          $pengeluaran->setJumlah($dataRow['jumlah']);
          $pengeluaran->setPersonalId($dataRow['id_personal']);
        }
        return $pengeluaran;
    }
    
    public function getCariKas($field, $text){
        $pengeluarans=array();
        $sql="select * from keuangan_pengeluaran where $field like '%$text%' order by id_pemasukan";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pengeluaran=new KeuanganPengeluaran();
          $pengeluaran->setKode($dataRow['id_pemasukan']);
          $pengeluaran->setNamapemasukan($dataRow['nama_pemasukan']);
          $pengeluaran->setJumlah($dataRow['jumlah']);
          $pengeluaran->setPersonalId($dataRow['id_personal']);
          $pengeluarans[]=$pengeluaran;
        }
        return $pengeluarans;
    }
}

?>
