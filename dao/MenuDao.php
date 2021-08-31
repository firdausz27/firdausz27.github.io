<?php
include_once './model/Menu.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuDao
 *
 * @author asep
 */
class MenuDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Menu $menu){
        $sql="insert into menu (parent,nama,link,target,form_id,status) values 
            ('".$menu->getParent()."','".$menu->getNama()."','".$menu->getLink()."','".$menu->getTerget()."',".$menu->getFormId().",'".$menu->getStatus()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Menu $menu){
        $sql="update menu set nama_menu='".$menu->getNamaKategori()."', 
            keterangan='".$menu->getKeterangan()."' where  menu_id='".$menu->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Menu $menu){
        $sql="delete from menu where menu_id='".$menu->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKategoriPage($hal,$row){
        $menus=array();
        $sql="select * from menu order by menu_id asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $menu=new Menu();
          $menu->setKode($dataRow['menu_id']);
          $menu->setNamaKategori($dataRow['nama_menu']);
          $menu->setKeterangan($dataRow['keterangan']);
          $menus[]=$menu;
        }
        return $menus;
    }
    
     public function getAllKategori(){
        $menus=array();
        $sql="select * from menu order by menu_id";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $menu=new Menu();
          $menu->setKode($dataRow['menu_id']);
          $menu->setNamaKategori($dataRow['nama_menu']);
          $menu->setKeterangan($dataRow['keterangan']);
          $menus[]=$menu;
        }
        return $menus;
    }
    
    public function getKategori($id){
        $sql="select * from menu where menu_id='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $menu=new Menu();
          $menu->setKode($dataRow['menu_id']);
          $menu->setNamaKategori($dataRow['nama_menu']);
          $menu->setKeterangan($dataRow['keterangan']);
        }
        return $menu;
    }
    
    public function getCariKategori($field, $text){
        $menus=array();
        $sql="select * from menu where $field like '%$text%' order by menu_id";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $menu=new Menu();
          $menu->setKode($dataRow['menu_id']);
          $menu->setNamaKategori($dataRow['nama_menu']);
          $menu->setKeterangan($dataRow['keterangan']);
          $menus[]=$menu;
        }
        return $menus;
    }
}

?>
