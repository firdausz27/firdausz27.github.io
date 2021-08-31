<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PesertaDidikDao
 *
 * @author asep
 */
include_once './dao/PersonalDao.php';
class AddKajianDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert($santri, $listJadual){
        $valid=false;
        $this->koneksi->begin();
        foreach ($listJadual as $jadual){
            $sql="insert into jadual_personal (personal_id,id_jadual,status) values ('".$santri."','".$jadual."','0')";
            $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        }
        if($myQry){
            $this->koneksi->commit();
            $valid=true;
        }else{
            $this->koneksi->rollback();
            $valid=false;
        }
        return $valid;
        $this->koneksi->closeConnection();
    }
    
    public function getKajianByJadual($jadualId,$staus){
        $otorisasidao=new PersonalOtorisasiDao();
        $otorisasi = $otorisasidao->getOtorisasi($_SESSION['SES_LOGIN']);
        if($otorisasi==NULL){
            $otorisasi[]=$_SESSION['SES_LOGIN'];
        }
        $listSiswa=implode("','",$otorisasi);
        $personals=array();
        $sql="select * from jadual_personal inner join personal on(personal.id_siswa=jadual_personal.personal_id) where id_jadual='".$jadualId."' and status='".$staus."' and personal_id in('$listSiswa') order by personal.nama_awal,personal.nama_tengah,personal.nama_akhir";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){ 
            $personalDao=new PersonalDao();
            $personal = $personalDao->getPersonal($dataRow['personal_id']);
            $personals[]=$personal;
        }
        return $personals;
    }
    
    public function getKajianByJadualAll($jadualId){
        $personals=array();
        $sql="select * from jadual_personal where id_jadual='".$jadualId."'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){ 
            $personalDao=new PersonalDao();
            $personal = $personalDao->getPersonal($dataRow['personal_id']);
            $personals[]=$personal;
        }
        return $personals;
    }

    public function getKajianByPersonal($jadualId,$staus){
        $personals=array();
        $sql="select * from jadual_personal inner join personal on(personal.id_siswa=jadual_personal.personal_id) where id_jadual='".$jadualId."' and status='".$staus."' and personal_id in('".$_SESSION['SES_LOGIN']."') "
                . "order by personal.nama_awal,personal.nama_tengah,personal.nama_akhir";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){ 
            $personalDao=new PersonalDao();
            $personal = $personalDao->getPersonal($dataRow['personal_id']);
            $personals[]=$personal;
        }
        return $personals;
    }
    
    public function getKajian($jadualId){
        $personals=array();
        $sql="select * from jadual_personal where id_jadual='".$jadualId."'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){ 
            $personalDao=new PersonalDao();
            $personal = $personalDao->getPersonal($dataRow['personal_id']);
            $personals[]=$personal;
        }
        return $personals;
    }
    
    public function getKajianNotInNilai($jadualId,$idNilai){
        $personals=array();
        $sql="select * from jadual_personal where id_jadual='".$jadualId."' and 
            personal_id not in (select id_siswa from nilai_personal where id_nilai='".$idNilai."')";
       
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){ 
            $personalDao=new PersonalDao();
            $personal = $personalDao->getPersonal($dataRow['personal_id']);
            $personals[]=$personal;
        }
        return $personals;
    }
}

?>
