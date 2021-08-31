<?php
include_once './model/Ruangan.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuanganDao
 *
 * @author asep
 */
class RuanganDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Ruangan $ruangan){
        $sql="insert into ruangan (id_ruangan,nama_ruangan,keterangan) values 
            ('".$ruangan->getRunaganId()."','".$ruangan->getNama()."','".$ruangan->getKeterangan()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Ruangan $ruangan){
        $sql="update ruangan set nama_ruangan='".$ruangan->getNama()."', 
            keterangan='".$ruangan->getKeterangan()."' where  id_ruangan='".$ruangan->getRunaganId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Ruangan $ruangan){
        $sql="delete from ruangan where id_ruangan='".$ruangan->getRunaganId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllRuanganPage($hal,$row){
        $ruangans=array();
        $sql="select * from ruangan order by id_ruangan asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $ruangan=new Ruangan();
          $ruangan->setRunaganId($dataRow['id_ruangan']);
          $ruangan->setNama($dataRow['nama_ruangan']);
          $ruangan->setKeterangan($dataRow['keterangan']);
          $ruangans[]=$ruangan;
        }
        return $ruangans;
    }
    
     public function getAllRuangan(){
        $ruangans=array();
        $sql="select * from ruangan order by id_ruangan";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $ruangan=new Ruangan();
          $ruangan->setRunaganId($dataRow['id_ruangan']);
          $ruangan->setNama($dataRow['nama_ruangan']);
          $ruangan->setKeterangan($dataRow['keterangan']);
          $ruangans[]=$ruangan;
        }
        return $ruangans;
    }
    
    public function getRuangan($id){
        $sql="select * from ruangan where id_ruangan='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $ruangan=new Ruangan();
          $ruangan->setRunaganId($dataRow['id_ruangan']);
          $ruangan->setNama($dataRow['nama_ruangan']);
          $ruangan->setKeterangan($dataRow['keterangan']);
        }
        return $ruangan;
    }
    
    public function getCariRuangan($field, $text){
        $ruangans=array();
        $sql="select * from ruangan where $field like '%$text%' order by id_ruangan";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $ruangan=new Ruangan();
          $ruangan->setRunaganId($dataRow['id_ruangan']);
          $ruangan->setNama($dataRow['nama_ruangan']);
          $ruangan->setKeterangan($dataRow['keterangan']);
          $ruangans[]=$ruangan;
        }
        return $ruangans;
    }
}

?>
