<?php
include_once './model/TampilForm.php';
include_once './db/DBConnection.php';
include_once './dao/TampilFormDao.php';
#control menu program
if($_GET){
    if($_GET['page']==''){
        if(!file_exists ("./TabMenu.php")) die ("Empty Main Page!"); 
        include "./TabMenu.php";
        //break;
    }else{
        $kode=$_GET['page'];
        $tampilDao=new TampilFormDao();
        $cariTampil = $tampilDao->getCariTampil("nama_form", $kode);
        foreach ($cariTampil as $file){
            if(!file_exists (trim($file->getUrl()))) die ("Empty Main Page!");
            include trim($file->getUrl());
            break;
        }
    }
}
else{
    if(!file_exists ("./view/VisiMisi.php")) die ("Empty Main Page!"); 
    include "./TabMenu.php";
    //include './view/laporan/personal_kelompok/Form.php';
}
?>
