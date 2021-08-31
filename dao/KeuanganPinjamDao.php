<?php
include_once './model/KeuanganPinjam.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganPinjamDao
 *
 * @author asep
 */
class KeuanganPinjamDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(KeuanganPinjam $pinjam){
        $valid=false;
        $this->koneksi->begin();
        //lakukan insert kedalam keuangan pinjam
        $sql1="insert into keuangan_pinjam (
            id_pinjam,
            tgl_pinjam,
            tgl_kembali,
            kas_id,
            personal_id,
            jumlah,
            status
            ) values 
            ('".$pinjam->getKode()."',"
                . "'".InggrisTgl($pinjam->getTglPinjam())."',"
                . "'".InggrisTgl($pinjam->getTglKembali())."',"
                . "'".$pinjam->getKas()."',"
                . "'".$pinjam->getPersonal()->getIdPersonal()."',"
                .$pinjam->getJumlah().","
                . "'p')";
        $myQry1  =  mysql_query($sql1, $this->connection)or die("Error query :".mysql_error());
        //untuk memasukan kepada pijam detail
        $sql2="insert into keuangan_pinjam_detail (
            id_pinjam,
            total_pinjam,
            sisa_pinjam,
            kredit_pinjam,
            status) values 
            ('".$pinjam->getKode()."',"
                .$pinjam->getJumlah().","
                .$pinjam->getJumlah().",0,1)";

        $myQry2  =  mysql_query($sql2, $this->connection)or die("Error query :".mysql_error());
        //lakukan update jumlah di kas
        $sql3="update keuangan_kas set jumlah=jumlah-".$pinjam->getJumlah()." where id_kas='".$pinjam->getKas()."'";
        $myQry3  =  mysql_query($sql3, $this->connection)or die("Error query :".mysql_error());

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
    
    public function update(KeuanganPinjam $pinjam){
        $sql="update keuangan_pinjam set nama_pinjam='".$pinjam->getNamapinjam()."', 
            jumlah='".$pinjam->getJumlah()."', id_personal='".$pinjam->getPersonalId()."' where  id_pinjam='".$pinjam->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(KeuanganPinjam $pinjam){
        $sql="delete from keuangan_pinjam where id_pinjam='".$pinjam->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKasPage($hal,$row){
        $pinjams=array();
        $sql="select * from keuangan_pinjam order by id_pinjam asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pinjam=new KeuanganPinjam();
          $pinjam->setKode($dataRow['id_pinjam']);
          $pinjam->setNamapinjam($dataRow['nama_pinjam']);
          $pinjam->setJumlah($dataRow['jumlah']);
          $pinjam->setPersonalId($dataRow['id_personal']);
          $pinjams[]=$pinjam;
        }
        return $pinjams;
    }
    
     public function getAllKas(){
        $pinjams=array();
        $sql="select * from keuangan_pinjam order by id_pinjam";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pinjam=new KeuanganPinjam();
          $pinjam->setKode($dataRow['id_pinjam']);
          $pinjam->setNamapinjam($dataRow['nama_pinjam']);
          $pinjam->setJumlah($dataRow['jumlah']);
          $pinjam->setPersonalId($dataRow['id_personal']);
          $pinjams[]=$pinjam;
        }
        return $pinjams;
    }
    
    public function getKas($id){
        $sql="select * from keuangan_pinjam where id_pinjam='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pinjam=new KeuanganPinjam();
          $pinjam->setKode($dataRow['id_pinjam']);
          $pinjam->setNamapinjam($dataRow['nama_pinjam']);
          $pinjam->setJumlah($dataRow['jumlah']);
          $pinjam->setPersonalId($dataRow['id_personal']);
        }
        return $pinjam;
    }
    
    public function getCariKas($field, $text){
        $pinjams=array();
        $sql="select * from keuangan_pinjam where $field like '%$text%' order by id_pinjam";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pinjam=new KeuanganPinjam();
          $pinjam->setKode($dataRow['id_pinjam']);
          $pinjam->setNamapinjam($dataRow['nama_pinjam']);
          $pinjam->setJumlah($dataRow['jumlah']);
          $pinjam->setPersonalId($dataRow['id_personal']);
          $pinjams[]=$pinjam;
        }
        return $pinjams;
    }
}

?>
