<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<!--<link rel="stylesheet" type="text/css" href="css/reset-font.css" media="screen" />-->
<link rel="stylesheet" type="text/css" href="css/screen.css" media="screen" />
<link rel="stylesheet" type="text/css" href="./css/jquery.jqplot.css" />
    <script src="./js/jquery.js"></script>
    <!-- load dulu plugin jquery.jqplotnya -->
    <script language="javascript" type="text/javascript" src="./js/jquery.jqplot.js"></script>
    <script language="javascript" type="text/javascript" src="./js/plugins/jqplot.pieRenderer.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#tab1').fadeIn('slow'); //tab pertama ditampilkan
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
</head >
<body>
    <div id="container" >
    <ul id="navtab">
        <li><a href="#tab1" class="active">Instrumen</a></li>
        <!--<li><a href="#tab2">Visi Misi</a></li>-->
        <li><a href="#tab3">Institusi</a></li>
    </ul>
    <div class="clear"></div>
    <div id="konten" style=" height: auto; overflow: visible;">
    	<div style="display: none;" id="tab1" class="tab_konten">
            <?php include_once './dashboard.php';?>
            
        </div>
		
        <!--<div style="display: none;" id="tab2" class="tab_konten">
            <?php //include_once './view/VisiMisi.php';?>
        </div>-->
        
        <div style="display: none;" id="tab3" class="tab_konten">
            <?php include_once './Institusi.php';?>
        </div>
        
    </div>
  </div>
  
</body>
</html>
