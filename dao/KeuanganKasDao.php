<?php
include_once './model/KeuanganKas.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganKasDao
 *
 * @author asep
 */
class KeuanganKasDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(KeuanganKas $kas){
        $sql="insert into keuangan_kas (id_kas,nama_kas,jumlah,id_personal) values 
            ('".$kas->getKode()."','".$kas->getNamakas()."','".$kas->getJumlah()."','".$kas->getPersonalId()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(KeuanganKas $kas){
        $sql="update keuangan_kas set nama_kas='".$kas->getNamakas()."', 
            jumlah='".$kas->getJumlah()."', id_personal='".$kas->getPersonalId()."' where  id_kas='".$kas->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(KeuanganKas $kas){
        $sql="delete from keuangan_kas where id_kas='".$kas->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKasPage($hal,$row){
        $kass=array();
        $sql="select * from keuangan_kas order by id_kas asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kas=new KeuanganKas();
          $kas->setKode($dataRow['id_kas']);
          $kas->setNamakas($dataRow['nama_kas']);
          $kas->setJumlah($dataRow['jumlah']);
          $kas->setPersonalId($dataRow['id_personal']);
          $kass[]=$kas;
        }
        return $kass;
    }
    
     public function getAllKas(){
        $kass=array();
        $sql="select * from keuangan_kas order by id_kas";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kas=new KeuanganKas();
          $kas->setKode($dataRow['id_kas']);
          $kas->setNamakas($dataRow['nama_kas']);
          $kas->setJumlah($dataRow['jumlah']);
          $kas->setPersonalId($dataRow['id_personal']);
          $kass[]=$kas;
        }
        return $kass;
    }
    
    public function getKas($id){
        $sql="select * from keuangan_kas where id_kas='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kas=new KeuanganKas();
          $kas->setKode($dataRow['id_kas']);
          $kas->setNamakas($dataRow['nama_kas']);
          $kas->setJumlah($dataRow['jumlah']);
          $kas->setPersonalId($dataRow['id_personal']);
        }
        return $kas;
    }
    
    public function getCariKas($field, $text){
        $kass=array();
        $sql="select * from keuangan_kas where $field like '%$text%' order by id_kas";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $kas=new KeuanganKas();
          $kas->setKode($dataRow['id_kas']);
          $kas->setNamakas($dataRow['nama_kas']);
          $kas->setJumlah($dataRow['jumlah']);
          $kas->setPersonalId($dataRow['id_personal']);
          $kass[]=$kas;
        }
        return $kass;
    }
}

?>
