<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TampilformDao
 *
 * @author asep
 */
class TampilFormDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Tampilform $tampil){
        $sql="insert into tampil_form (form_id,url,nama_form,menu,modul) values 
            ('".$tampil->getKode()."','".$tampil->getUrl()."','".$tampil->getNamaForm()."','".$tampil->getMenu()."','".$tampil->getModul()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Tampilform $tampil){
        $sql="update tampil_form set url='".$tampil->getUrl()."', 
            nama_form='".$tampil->getNamaForm()."', 
                menu='".$tampil->getMenu()."',modul='".$tampil->getModul()."'
                    where  form_id='".$tampil->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Tampilform $tampil){
        $sql="delete from tampil_form where form_id='".$tampil->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllTampilPage($hal,$row){
        $tampils=array();
        $sql="select * from tampil_form order by form_id asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tampil=new Tampilform();
          $tampil->setKode($dataRow['form_id']);
          $tampil->setUrl($dataRow['url']);
          $tampil->setNamaForm($dataRow['nama_form']);
          $tampil->setMenu($dataRow['menu']);
          $tampil->setModul($dataRow['modul']);
          $tampils[]=$tampil;
        }
        return $tampils;
    }
    
     public function getAllTampil(){
        $tampils=array();
        $sql="select * from tampil_form order by form_id";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tampil=new Tampilform();
          $tampil->setKode($dataRow['form_id']);
          $tampil->setUrl($dataRow['url']);
          $tampil->setNamaForm($dataRow['nama_form']);
          $tampil->setMenu($dataRow['menu']);
          $tampil->setModul($dataRow['modul']);
          $tampils[]=$tampil;
        }
        return $tampils;
    }
    
    public function getTampil($id){
        $sql="select * from tampil_form where form_id='$id'";
        $tampil=NULL;
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tampil=new Tampilform();
          $tampil->setKode($dataRow['form_id']);
          $tampil->setUrl($dataRow['url']);
          $tampil->setNamaForm($dataRow['nama_form']);
          $tampil->setMenu($dataRow['menu']);
          $tampil->setModul($dataRow['modul']);
        }
        return $tampil;
    }
    
    public function getCariTampil($field, $text){
        $tampils=array();
        $sql="select * from tampil_form where $field = '$text' order by form_id";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $tampil=new Tampilform();
          $tampil->setKode($dataRow['form_id']);
          $tampil->setUrl($dataRow['url']);
          $tampil->setNamaForm($dataRow['nama_form']);
          $tampil->setMenu($dataRow['menu']);
          $tampil->setModul($dataRow['modul']);
          $tampils[]=$tampil;
        }
        return $tampils;
    }
}

?>
