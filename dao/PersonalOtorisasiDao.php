<?php
include_once './db/DBConnection.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonalOtorisasiDao
 *
 * @author asep
 */
class PersonalOtorisasiDao {
    //put your code here
    private $connection;
    private $koneksi;
    private $personalDao;
    public function __construct() {
        $this->koneksi=new DBConnection();
        $this->connection=  $this->koneksi->getKonnection();
    }
    
    public function getOtorisasi($personalId){
        $data=array();
        $sql="select empgroup_data.personal_id from empgroup 
            inner join empgroup_admin on(empgroup.id_group=empgroup_admin.empgroup_id)
            inner join empgroup_data on(empgroup.id_group=empgroup_data.empgroup_id)
            where empgroup_admin.personal_id='$personalId'";
        $dataQry  =  mysql_query($sql, $this->connection)or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){ 
          $data[]=$dataRow['personal_id'];
        }
        return $data;
    }
}
