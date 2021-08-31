<?php
include_once './model/Pekerjaan.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PekerjaanDao
 *
 * @author asep
 */
class PekerjaanDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Pekerjaan $pekerjaan){
        $sql="insert into pekerjaan
            (id_pekerjaan,nama_pekerjaan,kategori_pekerjaan,nama_perusahaan,telepon_perusahaan,alamat,personal_id,keterangan)
            values 
            ('".$pekerjaan->getPekerjaanId()."',
                '".$pekerjaan->getNamaPekerjaan()."',
                    '".$pekerjaan->getKategoriPekerjaan()."',
                        '".$pekerjaan->getNamaPerusahaan()."',
                            '".$pekerjaan->getTelepon()."',
                                '".$pekerjaan->getAlamat()."',
                                    '".$pekerjaan->getPersonalId()."',
                                        '".$pekerjaan->getKeterangan()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Pekerjaan $pekerjaan){
        $sql="update pekerjaan set 
                nama_pekerjaan='".$pekerjaan->getNamaPekerjaan()."',
                    kategori_pekerjaan='".$pekerjaan->getKategoriPekerjaan()."',
                        nama_perusahaan='".$pekerjaan->getNamaPerusahaan()."',
                            telepon_perusahaan='".$pekerjaan->getTelepon()."',
                                alamat='".$pekerjaan->getAlamat()."',
                                    personal_id='".$pekerjaan->getPersonalId()."',
                                        keterangan='".$pekerjaan->getKeterangan()."'
                                              where id_pekerjaan='".$pekerjaan->getPekerjaanId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Pekerjaan $pekerjaan){
        $sql="delete from pekerjaan where id_pekerjaan='".$pekerjaan->getPekerjaanId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllPekerjaanPage($personalId){
        $pekerjaans=array();
        $sql="select * from pekerjaan where personal_id='$personalId' order by id_pekerjaan asc";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pekerjaan=new Pekerjaan();
          $pekerjaan->setPekerjaanId($dataRow['id_pekerjaan']);
          $pekerjaan->setNamaPekerjaan($dataRow['nama_pekerjaan']);
          $pekerjaan->setKategoriPekerjaan($dataRow['kategori_pekerjaan']);
          $pekerjaan->setNamaPerusahaan($dataRow['nama_perusahaan']);
          $pekerjaan->setTelepon($dataRow['telepon_perusahaan']);
          $pekerjaan->setAlamat($dataRow['alamat']);
          $pekerjaan->setPersonalId($dataRow['personal_id']);
          $pekerjaan->setKeterangan($dataRow['keterangan']);
          $pekerjaans[]=$pekerjaan;
        }
        return $pekerjaans;
    }
    
     public function getAllPekerjaan(){
        $pekerjaans=array();
        $sql="select * from pekerjaan order by id_pekerjaan";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pekerjaan=new Pekerjaan();
          $pekerjaan->setPekerjaanId($dataRow['id_pekerjaan']);
          $pekerjaan->setNamaPekerjaan($dataRow['nama_pekerjaan']);
          $pekerjaan->setKategoriPekerjaan($dataRow['kategori_pekerjaan']);
          $pekerjaan->setNamaPerusahaan($dataRow['nama_perusahaan']);
          $pekerjaan->setTelepon($dataRow['telepon_perusahaan']);
          $pekerjaan->setAlamat($dataRow['alamat']);
          $pekerjaan->setPersonalId($dataRow['personal_id']);
          $pekerjaan->setKeterangan($dataRow['keterangan']);
          $pekerjaans[]=$pekerjaan;
        }
        return $pekerjaans;
    }
    
    public function getPekerjaan($id){
        $sql="select * from pekerjaan where id_pekerjaan='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pekerjaan=new Pekerjaan();
          $pekerjaan->setPekerjaanId($dataRow['id_pekerjaan']);
          $pekerjaan->setNamaPekerjaan($dataRow['nama_pekerjaan']);
          $pekerjaan->setKategoriPekerjaan($dataRow['kategori_pekerjaan']);
          $pekerjaan->setNamaPerusahaan($dataRow['nama_perusahaan']);
          $pekerjaan->setTelepon($dataRow['telepon_perusahaan']);
          $pekerjaan->setAlamat($dataRow['alamat']);
          $pekerjaan->setPersonalId($dataRow['personal_id']);
          $pekerjaan->setKeterangan($dataRow['keterangan']);
        }
        return $pekerjaan;
    }
    
    public function getPekerjaanCheck($nama, $personalId){
        $pekerjaan=NULL;
        $sql="select * from pekerjaan where nama_pekerjaan='$nama' and personal_id='$personalId'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pekerjaan=new Pekerjaan();
          $pekerjaan->setPekerjaanId($dataRow['id_pekerjaan']);
          $pekerjaan->setNamaPekerjaan($dataRow['nama_pekerjaan']);
          $pekerjaan->setKategoriPekerjaan($dataRow['kategori_pekerjaan']);
          $pekerjaan->setNamaPerusahaan($dataRow['nama_perusahaan']);
          $pekerjaan->setTelepon($dataRow['telepon_perusahaan']);
          $pekerjaan->setAlamat($dataRow['alamat']);
          $pekerjaan->setPersonalId($dataRow['personal_id']);
          $pekerjaan->setKeterangan($dataRow['keterangan']);
        }
        return $pekerjaan;
    }
    
    public function getCariPekerjaan($field, $text){
        $pekerjaans=array();
        $sql="select * from education_history where $field like '%$text%' order by id_education";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pekerjaan=new Pekerjaan();
          $pekerjaan->setPekerjaanId($dataRow['id_pekerjaan']);
          $pekerjaan->setNamaPekerjaan($dataRow['nama_pekerjaan']);
          $pekerjaan->setKategoriPekerjaan($dataRow['kategori_pekerjaan']);
          $pekerjaan->setNamaPerusahaan($dataRow['nama_perusahaan']);
          $pekerjaan->setTelepon($dataRow['telepon_perusahaan']);
          $pekerjaan->setAlamat($dataRow['alamat']);
          $pekerjaan->setPersonalId($dataRow['personal_id']);
          $pekerjaan->setKeterangan($dataRow['keterangan']);
          $pekerjaans[]=$pekerjaan;
        }
        return $pekerjaans;
    }
}

?>
