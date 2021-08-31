<?php
include_once './model/Group.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupDao
 *
 * @author asep
 */
class GroupDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Group $group){
        $sql="insert into groupdata (nama_group,tgl_dibuat,keterangan) values 
            ('".$group->getNamaGroup()."','".InggrisTgl($group->getTglDibuat())."','".$group->getKeterangan()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Group $group){
        $sql="update groupdata set nama_group='".$group->getNamaGroup()."',
            tgl_dibuat='".  InggrisTgl($group->getTglDibuat())."',
            keterangan='".$group->getKeterangan()."' where  id_group='".$group->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Group $group){
        $sql="delete from groupdata where id_group='".$group->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllGroupPage($hal,$row){
        $groups=array();
        $sql="select * from groupdata order by id_group asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $group=new Group();
          $group->setKode($dataRow['id_group']);
          $group->setNamaGroup($dataRow['nama_group']);
          $group->setTglDibuat($dataRow['tgl_dibuat']);
          $group->setDibutOleh($dataRow['dibuat_oleh']);
          $group->setKeterangan($dataRow['keterangan']);
          $groups[]=$group;
        }
        return $groups;
    }
    
     public function getAllGroup(){
        $groups=array();
        $sql="select * from groupdata order by id_group";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $group=new Group();
          $group->setKode($dataRow['id_group']);
          $group->setNamaGroup($dataRow['nama_group']);
          $group->setTglDibuat($dataRow['tgl_dibuat']);
          $group->setDibutOleh($dataRow['dibuat_oleh']);
          $group->setKeterangan($dataRow['keterangan']);
          $groups[]=$group;
        }
        return $groups;
    }
    
    public function getGroup($id){
        $sql="select * from groupdata where id_group='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $group=new Group();
          $group->setKode($dataRow['id_group']);
          $group->setNamaGroup($dataRow['nama_group']);
          $group->setTglDibuat($dataRow['tgl_dibuat']);
          $group->setDibutOleh($dataRow['dibuat_oleh']);
          $group->setKeterangan($dataRow['keterangan']);
        }
        return $group;
    }
    
    public function getCariGroup($field, $text){
        $groups=array();
        $sql="select * from groupdata where $field like '%$text%' order by id_group";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $group=new Group();
          $group->setKode($dataRow['id_group']);
          $group->setNamaGroup($dataRow['nama_group']);
          $group->setTglDibuat($dataRow['tgl_dibuat']);
          $group->setDibutOleh($dataRow['dibuat_oleh']);
          $group->setKeterangan($dataRow['keterangan']);
          $groups[]=$group;
        }
        return $groups;
    }
}

?>
