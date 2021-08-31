<?php 
session_start();
include './library/inc.seslogin.php';
include './library/inc.library.php';
include_once './dao/InstitusiDao.php';
include_once './library/EnkripUrl.php';
date_default_timezone_set("Asia/Jakarta");
$instansi=new InstitusiDao();
$institusiEmp = $instansi->getInstitusiEmp($_SESSION['SES_LOGIN']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
        
        <!--<link href="css/jquery.datepick.css" rel="stylesheet">-->
        <link type="text/css" rel="stylesheet" href="plugins/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css" media="screen" />
        <script type="text/javascript" src="plugins/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js"></script> 
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/myJs.js"></script>
        <link rel="stylesheet" href="css/jquery.multiselect2side.css" type="text/css" media="screen" />
        <title>
            DM-LIVE
        </title>
        <link rel="shortcut icon" href="img/dm_logo.png"/>
    </head>
    <body>
        <div id="wrapper">
            <div id="header_container">
                <div id="header">
                    <!--<img src="images/header1.jpg" alt="" width="100%" height="80" /> -->
                    <div id="penguna">
                        <?php if(empty($_SESSION['SES_NAMA'])){echo '<i>Selamat datang !</i>';}else{echo ucwords('<i>'.$_SESSION['SES_NAMA'].'</i>');} ?> | <a href="?page=LoginOut"><font style="color: #fff;">Logout</font></a>
                    </div>
                    <div id="company">
                        Institusi : 
                        <select name="cboCompany" style="width: 200px; background: #ccc; border-color: #ccc;">
                            <option><?php echo $institusiEmp->getNamaInstitusi() ;?></option>
                        </select>
                    </div>
                </div>
                <div id="nav">
                    <div id="mnu">
                        <ul id="menu">
                            <li><a href="?page=">Home</a></li>
                            <li><a href="#">About</a></li>
                        </ul>
                    </div>
                    <!--
                    <div id="user">
                        <label id="welcone"><a href="#"><b><font color="red" style="font-size: 12px;">3</font></b></a></label>
                    </div>
                    -->
                    <div id="waktu">
                        <b><?php echo date('d-F-Y');?>  | <label id="clock" align="right"></label></b>
                    </div>
                </div>
            </div>
            <!--<div id="container-content">-->
            <table width="100%" cellpadding="3">
                <tr>
                    <td width="22%" valign="top">
                        <div id="subNav">
                            <?php include './subMenu.php';?>
                        </div>
                    </td>
                    <td width="78%" valign="top">
                        <div id="content-wrap">
                            <div id="content">
                                <?php include './BukaFile.php';?>
                            </div>
                        </div>
                    </td>
            </tr>
            <tr>
                <td colspan="2">
                    </div>
                    <div id="fotter-bayangan">
                    </div>
                </td>
            </tr>
            </table>
            <div id="fotter">
                <h3>&copy; Asep Komarudin 2014</h3>
           </div>
        </div>
    </body>
</html>
