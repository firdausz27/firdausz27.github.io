<?php
include_once './model/KeuanganKembali.php';
include_once './db/DBConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganKembaliDao
 *
 * @author asep
 */
class KeuanganKembaliDao {
    //put your code here
    private $connection;
    private $koneksi;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function insert(KeuanganKembali $pinjam){
        $valid=false;
        $this->koneksi->begin();
        //lakukan insert kedalam keuangan pinjam
        $sql1="insert into keuangan_kembali (
            id_kembali,
            tgl_kembali,
            id_pinjam,
            jumlah
            ) values 
            ('".$pinjam->getKode()."',"
                . "'".InggrisTgl($pinjam->getTanggal())."',"
                . "'".$pinjam->getIdPinjam()."',"
                .$pinjam->getJumlah().")";
        $myQry1  =  mysql_query($sql1, $this->connection)or die("Error query :".mysql_error());
        //lakukan pemangian pinjam detail dengan kode 
        $sqlGet="select * from keuangan_pinjam_detail "
                . "inner join keuangan_pinjam "
                . "on(keuangan_pinjam_detail.id_pinjam=keuangan_pinjam.id_pinjam) "
                . "where keuangan_pinjam_detail.id_pinjam='".$pinjam->getIdPinjam()."' and keuangan_pinjam_detail.status=1";
        $myQryGet  =  mysql_query($sqlGet, $this->connection)or die("Error query :".mysql_error());
        while ($dataGet=  mysql_fetch_array($myQryGet)){ 
            //lakukan insert detail baru
            $krditawal=$dataGet['kredit_pinjam'];
            $sqlInsetDet="insert into keuangan_pinjam_detail ("
                    . "id_pinjam,"
                    . "total_pinjam,"
                    . "sisa_pinjam,"
                    . "kredit_pinjam,"
                    . "tgl_kredit,"
                    . "status) values("
                    . "'".$pinjam->getIdPinjam()."',"
                    . $dataGet['total_pinjam'].","
                    . ($dataGet['sisa_pinjam']-$pinjam->getJumlah()).","
                    . ($dataGet['kredit_pinjam']+$pinjam->getJumlah()).","
                    . "'".date("Y-m-d")."',"
                    . "1)";
            $myQryDet  =  mysql_query($sqlInsetDet, $this->connection)or die("Error query :".mysql_error());
            //lakukan update status detail
            $sqlUpdDtl="update keuangan_pinjam_detail set status=0 where id_pinajm_dtl=".$dataGet['id_pinajm_dtl'];
            $myUpdDtl  =  mysql_query($sqlUpdDtl, $this->connection)or die("Error query :".mysql_error());
            //lakukan update jumlah kas
            $sqlUpdatekas="update keuangan_kas set jumlah=jumlah+".$pinjam->getJumlah()." where id_kas='".$dataGet['kas_id']."'";
            $myUpdKas  =  mysql_query($sqlUpdatekas, $this->connection)or die("Error query :".mysql_error());
            //cek apakah sudah lunas atau belum
            if($dataGet['total_pinjam'] <= ($krditawal+$pinjam->getJumlah())){
                //update pinjam status menjadi L (lunas)
                $sqlUpdPj="update keuangan_pinjam set status='l' where id_pinjam='".$pinjam->getIdPinjam()."'";
                $myUpdPj  =  mysql_query($sqlUpdPj, $this->connection)or die("Error query :".mysql_error());
            }
            
        }
        if($myQry1 && $myQryDet && $myUpdDtl && $myUpdKas){
            $this->koneksi->commit();
            $valid=true;
        }else{
            $this->koneksi->rollback();
            $valid=false;
        }
        return $valid;
        $this->koneksi->closeConnection();
    }
    
    public function update(KeuanganKembali $pinjam){
        $sql="update keuangan_kembali set nama_pinjam='".$pinjam->getNamapinjam()."', 
            jumlah='".$pinjam->getJumlah()."', id_personal='".$pinjam->getPersonalId()."' where  id_pinjam='".$pinjam->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function delete(KeuanganKembali $pinjam){
        $sql="delete from keuangan_kembali where id_pinjam='".$pinjam->getKode()."'";
        $myQry  =  mysql_query($sql, $this->connection)or die("Error query :".mysql_error());
        return $myQry;
        $this->koneksi->closeConnection();
    }
    
    public function getAllKasPage($hal,$row){
        $pinjams=array();
        $sql="select * from keuangan_kembali order by id_pinjam asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pinjam=new KeuanganKembali();
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
        $sql="select * from keuangan_kembali order by id_pinjam";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pinjam=new KeuanganKembali();
          $pinjam->setKode($dataRow['id_pinjam']);
          $pinjam->setNamapinjam($dataRow['nama_pinjam']);
          $pinjam->setJumlah($dataRow['jumlah']);
          $pinjam->setPersonalId($dataRow['id_personal']);
          $pinjams[]=$pinjam;
        }
        return $pinjams;
    }
    
    public function getKas($id){
        $sql="select * from keuangan_kembali where id_pinjam='$id'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pinjam=new KeuanganKembali();
          $pinjam->setKode($dataRow['id_pinjam']);
          $pinjam->setNamapinjam($dataRow['nama_pinjam']);
          $pinjam->setJumlah($dataRow['jumlah']);
          $pinjam->setPersonalId($dataRow['id_personal']);
        }
        return $pinjam;
    }
    
    public function getCariKas($field, $text){
        $pinjams=array();
        $sql="select * from keuangan_kembali where $field like '%$text%' order by id_pinjam";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pinjam=new KeuanganKembali();
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
