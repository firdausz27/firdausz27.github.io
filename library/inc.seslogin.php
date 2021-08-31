<?php
if(empty($_SESSION['SES_LOGIN'])){
        session_unset();
        session_destroy();
	include_once '../sim/login.php';
	exit;
}
?>