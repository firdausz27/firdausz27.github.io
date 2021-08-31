<?php
include_once './model/Negara.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NegaraDao
 *
 * @author asep
 */
class NegaraDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Negara $negara){
        $sql="insert into negara (nama_negara,keterangan) values 
            ('".$negara->getNama()."','".$negara->getKeterangan()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Negara $negara){
        $sql="update negara set nama_negara='".$negara->getNama()."', 
            keterangan='".$negara->getKeterangan()."' where  id_negara='".$negara->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Negara $negara){
        $sql="delete from negara where id_negara='".$negara->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllNegaraPage($hal,$row){
        $negaras=array();
        $sql="select * from negara order by id_negara asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $negara=new Negara();
          $negara->setKode($dataRow['id_negara']);
          $negara->setNama($dataRow['nama_negara']);
          $negara->setKeterangan($dataRow['keterangan']);
          $negaras[]=$negara;
        }
        return $negaras;
    }
    
     public function getAllNegara(){
        $negaras=array();
        $sql="select * from negara order by nama_negara";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $negara=new Negara();
          $negara->setKode($dataRow['id_negara']);
          $negara->setNama($dataRow['nama_negara']);
          $negara->setKeterangan($dataRow['keterangan']);
          $negaras[]=$negara;
        }
        return $negaras;
    }
    
    public function getNegara($id){
        $sql="select * from negara where id_negara='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $negara=new Negara();
          $negara->setKode($dataRow['id_negara']);
          $negara->setNama($dataRow['nama_negara']);
          $negara->setKeterangan($dataRow['keterangan']);
        }
        return $negara;
    }
    
    public function getCariNegara($field, $text){
        $negaras=array();
        $sql="select * from negara where $field like '%$text%' order by id_negara";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $negara=new Negara();
          $negara->setKode($dataRow['id_negara']);
          $negara->setNama($dataRow['nama_negara']);
          $negara->setKeterangan($dataRow['keterangan']);
          $negaras[]=$negara;
        }
        return $negaras;
    }
}

?>
