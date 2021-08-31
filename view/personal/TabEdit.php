<?php

if(isset($_GET['mode'])){
    $mode=$_GET['mode'];
}
if(isset($_GET['user'])){
    $_SESSION['modeuser']=$_GET['user'];
}

if(isset($_GET['Kode'])){
    $kode= $_GET['Kode'];
    $_GET['Kode']=trim(decrypt_url($_GET['Kode']));
    //echo $_GET['Kode'];
}

if(isset($_POST['userId'])){
    $_GET['Kode']=$_POST['userId'];
    $_SESSION['modeuser']=$_POST['user'];
    $mode=$_POST['mode'];
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<!--<link rel="stylesheet" type="text/css" href="css/reset-font.css" media="screen" />-->
<link rel="stylesheet" type="text/css" href="css/screen.css" media="screen" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#tab<?php echo $mode;?>').fadeIn('slow'); //tab pertama ditampilkan
	$('ul#navtab li a').click(function() { // jika link tab di klik
		$('ul#navtab li a').removeClass('active'); //menghilangkan class active (yang tampil)
		$(this).addClass("active"); // menambahkan class active pada link yang diklik
		$('.tab_konten').hide(); // menutup semua konten tab
		var aktif = $(this).attr('href'); // mencari mana tab yang harus ditampilkan
		$(aktif).fadeIn('slow'); // tab yang dipilih, ditampilkan
		return false;
	});

});

</script>
</head>

<body>
<div id="container">
    <ul id="navtab">
        <li><a href="#tab1" <?php if($mode=="1") echo 'class="active"';?>>Data Pribadi</a></li>
        <li><a href="#tab2" <?php if($mode=="2") echo 'class="active"';?>>Account Pribadi</a></li>
        <li><a href="#tab3" <?php if($mode=="3") echo 'class="active"';?>>Riwayat Pendidikan</a></li>
        <li><a href="#tab4" <?php if($mode=="4") echo 'class="active"';?>>Keluarga</a></li>
        <li><a href="#tab5" <?php if($mode=="5") echo 'class="active"';?>>Pekerjaan</a></li>
    </ul>
    <div class="clear"></div>
    <div id="konten" style="margin-bottom: 20px; height: auto; overflow: visible;">
            <div style="display: none;" id="tab1" class="tab_konten">
                <?php include_once './view/personal/PersonalEdit.php';?>
            </div>

            <div style="display: none;" id="tab2" class="tab_konten">
                <?php include_once './view/personal/AccountEdit.php';?>
            </div>

            <div style="display: none;" id="tab3" class="tab_konten">
                <?php include_once './view/personal/PendidikanForm.php';?>
            </div>
            <div style="display: none;" id="tab4" class="tab_konten">
                <?php include_once './view/personal/KeluargaForm.php';?>
            </div>
            <div style="display: none;" id="tab5" class="tab_konten">
                <?php include_once './view/personal/PekerjaanForm.php';?>
            </div>
        </div>
           
  </div>
</body>
</html>
