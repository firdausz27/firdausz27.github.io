<?php
$mode=1;
if(isset($_GET['mode'])){
    $mode=$_GET['mode'];
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
        <li><a href="#tab1" <?php if($mode=="1") echo 'class="active"';?>>Peminjaman</a></li>
        <li><a href="#tab2" <?php if($mode=="2") echo 'class="active"';?>>Pengembalian</a></li>
    </ul>
    <div class="clear"></div>
    <div id="konten">
    	<div style="display: none;" id="tab1" class="tab_konten">
            <?php include_once './view/keuangan_pinjam/KeuanganPinjam.php';?>
        </div>
		
        <div style="display: none;" id="tab2" class="tab_konten">
            <?php include_once './view/keuangan_pinjam/KeuanganKembali.php';?>
        </div>
        
    </div>
  </div>
</body>
</html>
