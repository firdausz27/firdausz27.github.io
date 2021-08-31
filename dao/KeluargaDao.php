<?php
include_once './model/Keluarga.php';
include_once './db/DBConnection.php';
include_once './dao/NegaraDao.php';
include_once './dao/PropinsiDao.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeluargaDao
 *
 * @author asep
 */
class KeluargaDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(Keluarga $pend){
        $sql="insert into family
            (id_family,nama,telepon,alamat,kota,propinsi,negara,hubungan,personal_id)
            values 
            ('".$pend->getKeluargaId()."',
                '".$pend->getNama()."',
                    '".$pend->getTelepon()."',
                        '".$pend->getAlamat()."',
                            '".$pend->getKota()."',
                                '".$pend->getPropinsi()->getKode()."',
                                    '".$pend->getNegara()->getKode()."',
                                        '".$pend->getHubungan()."',
                                            '".$pend->getPersonalId()."')";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function update(Keluarga $pend){
        $sql="update family set 
                nama='".$pend->getNama()."',
                    telepon='".$pend->getTelepon()."',
                        alamat='".$pend->getAlamat()."',
                            kota='".$pend->getKota()."',
                                propinsi='".$pend->getPropinsi()->getKode()."',
                                    negara='".$pend->getNegara()->getKode()."',
                                        hubungan='".$pend->getHubungan()."',
                                            personal_id='".$pend->getPersonalId()."'
                                                 where id_family='".$pend->getKeluargaId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(Keluarga $keluarga){
        $sql="delete from family where id_family='".$keluarga->getKeluargaId()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKeluargaPage($personalId){
        $keluargas=array();
        $sql="select * from family where personal_id='$personalId' order by id_family asc";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $keluarga=new Keluarga();
          $keluarga->setKeluargaId($dataRow['id_family']);
          $keluarga->setNama($dataRow['nama']);
          $keluarga->setTelepon($dataRow['telepon']);
          $keluarga->setAlamat($dataRow['alamat']);
          $keluarga->setKota($dataRow['kota']);
          $propinsiDao=new PropinsiDao();
          $keluarga->setPropinsi($propinsiDao->getPropinsi($dataRow['propinsi']));
          $negaraDao=new NegaraDao();
          $keluarga->setNegara($negaraDao->getNegara($dataRow['negara']));
          $keluarga->setHubungan($dataRow['hubungan']);
          $keluarga->setPersonalId($dataRow['personal_id']);
          $keluargas[]=$keluarga;
        }
        return $keluargas;
    }
    
     public function getAllKeluarga(){
        $keluargas=array();
        $sql="select * from family order by id_family";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $keluarga=new Keluarga();
          $keluarga->setKeluargaId($dataRow['id_family']);
          $keluarga->setNama($dataRow['nama']);
          $keluarga->setTelepon($dataRow['telepon']);
          $keluarga->setAlamat($dataRow['alamat']);
          $keluarga->setKota($dataRow['kota']);
          $propinsiDao=new PropinsiDao();
          $keluarga->setPropinsi($propinsiDao->getPropinsi($dataRow['propinsi']));
          $negaraDao=new NegaraDao();
          $keluarga->setNegara($negaraDao->getNegara($dataRow['negara']));
          $keluarga->setHubungan($dataRow['hubungan']);
          $keluarga->setPersonalId($dataRow['personal_id']);
          $keluargas[]=$keluarga;
        }
        return $keluargas;
    }
    
    public function getKeluarga($id){
        $sql="select * from family where id_family='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $keluarga=new Keluarga();
          $keluarga->setKeluargaId($dataRow['id_family']);
          $keluarga->setNama($dataRow['nama']);
          $keluarga->setTelepon($dataRow['telepon']);
          $keluarga->setAlamat($dataRow['alamat']);
          $keluarga->setKota($dataRow['kota']);
          $propinsiDao=new PropinsiDao();
          $keluarga->setPropinsi($propinsiDao->getPropinsi($dataRow['propinsi']));
          $negaraDao=new NegaraDao();
          $keluarga->setNegara($negaraDao->getNegara($dataRow['negara']));
          $keluarga->setHubungan($dataRow['hubungan']);
          $keluarga->setPersonalId($dataRow['personal_id']);
        }
        return $keluarga;
    }
    
    public function getKeluargaCheck($nama, $personalId){
        $keluarga=NULL;
        $sql="select * from family where nama='$nama' and personal_id='$personalId'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $keluarga=new Keluarga();
          $keluarga->setKeluargaId($dataRow['id_family']);
          $keluarga->setNama($dataRow['nama']);
          $keluarga->setTelepon($dataRow['telepon']);
          $keluarga->setAlamat($dataRow['alamat']);
          $keluarga->setKota($dataRow['kota']);
          $propinsiDao=new PropinsiDao();
          $keluarga->setPropinsi($propinsiDao->getPropinsi($dataRow['propinsi']));
          $negaraDao=new NegaraDao();
          $keluarga->setNegara($negaraDao->getNegara($dataRow['negara']));
          $keluarga->setHubungan($dataRow['hubungan']);
          $keluarga->setPersonalId($dataRow['personal_id']);
        }
        return $keluarga;
    }
    
    public function getCariKeluarga($field, $text){
        $keluargas=array();
        $sql="select * from education_history where $field like '%$text%' order by id_education";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $keluarga=new Keluarga();
          $keluarga->setKeluargaId($dataRow['id_family']);
          $keluarga->setNama($dataRow['nama']);
          $keluarga->setTelepon($dataRow['telepon']);
          $keluarga->setAlamat($dataRow['alamat']);
          $keluarga->setKota($dataRow['kota']);
          $propinsiDao=new PropinsiDao();
          $keluarga->setPropinsi($propinsiDao->getPropinsi($dataRow['propinsi']));
          $negaraDao=new NegaraDao();
          $keluarga->setNegara($negaraDao->getNegara($dataRow['negara']));
          $keluarga->setHubungan($dataRow['hubungan']);
          $keluarga->setPersonalId($dataRow['personal_id']);
          $keluargas[]=$keluarga;
        }
        return $keluargas;
    }
}

?>
