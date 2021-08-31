<?php
include_once './model/Personal.php';
include_once './model/User.php';
include_once './dao/PersonalDao.php';
include_once './dao/GroupDao.php';
include_once './dao/InstitusiDao.php';
include_once './dao/NegaraDao.php';
include_once './dao/PropinsiDao.php';
//$tglTransaksi=  isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('');
$dataKode = buatKode("personal", "PS");
$buatKode =  buatKode("user", "U");
//membuat objek personal
$stringWarning = "";
$personal = new Personal();
$user = new User();
//untuk meload semua group
$groupdao = new GroupDao();
$allGroup = $groupdao->getAllGroup();
//untuk mendapatkan institusi
$institusiDao = new InstitusiDao();
$allInstitusi = $institusiDao->getAllInstitusi();
//untuk mendapatkan list Negara
$negaraDao = new NegaraDao();
$allNegara = $negaraDao->getAllNegara();
//untuk mendapatkan propinsi
$propinsiDao = new PropinsiDao();
$allPropinsi = $propinsiDao->getAllPropinsi();
if ($_POST) {
  $personal->setIdPersonal(isset($_POST['txtId']) ? $_POST['txtId'] : '');
  $personal->setNamaAwal(isset($_POST['txtNamaAwal']) ? $_POST['txtNamaAwal'] : '');
  $personal->setNamaTengah(isset($_POST['txtNamaTengah']) ? $_POST['txtNamaTengah'] : '');
  $personal->setNamaAkhir(isset($_POST['txtNamaAkhir']) ? $_POST['txtNamaAkhir'] : '');
  $personal->setTempatLahir(isset($_POST['txtTempatLahir']) ? $_POST['txtTempatLahir'] : '');
  $personal->setTglLahir(isset($_POST['txtTglLahir']) ? $_POST['txtTglLahir'] : '');
  $personal->setTelepon(isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : '');
  $personal->setAlamat(isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '');
  $personal->setKota(isset($_POST['txtKota']) ? $_POST['txtKota'] : '');
  $personal->setPropinsi(isset($_POST['txtPropinsi']) ? $_POST['txtPropinsi'] : '');
  $personal->setNegara(isset($_POST['txtNegara']) ? $_POST['txtNegara'] : '');
  $personal->setEmail(isset($_POST['cboEmail']) ? $_POST['cboEmail'] : '');
  $personal->setTglGabung(isset($_POST['tglGabung']) ? $_POST['tglGabung'] : '');
  $personal->setFoto($personal->getIdPersonal() . "_" . $_FILES['txtGamabr']['name']);
  $personal->setKelamin(isset($_POST['Kelamin']) ? $_POST['Kelamin'] : '');
  $personal->setKategoriSantri(isset($_POST['cboKatSantri']) ? $_POST['cboKatSantri'] : '');
  $personal->setListMenu(isset($_POST['listMenu']) ? $_POST['listMenu'] : '');
  $personal->setListInstitusi(isset($_POST['listInstitusi']) ? $_POST['listInstitusi'] : '');
  $personal->setStatusPerkawinan(isset($_POST['cboStatusPerkawinan']) ? $_POST['cboStatusPerkawinan'] : '');
  $personal->setKegiatan(isset($_POST['txtKegiatan']) ? $_POST['txtKegiatan'] : '');
  $personal->setNamaPanggilan(isset($_POST['txtNamaPanggilan']) ? $_POST['txtNamaPanggilan'] : '');
  //menbuat objek user
  $user->setUserId(isset($_POST['txtIdUser']) ? $_POST['txtIdUser'] : '');
  // $user->setUsername(isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '');
  // $user->setPassword(isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '');
  $user->setPertanyaan(isset($_POST['txtPertanyaan']) ? $_POST['txtPertanyaan'] : '');
  $user->setJawaban(isset($_POST['txtJawaban']) ? $_POST['txtJawaban'] : '');
  $user->setLevel(isset($_POST['cboLevel']) ? $_POST['cboLevel'] : '');
  $personalDao = new PersonalDao();
  // $validaiUsername = $personalDao->getValidaiUsername($user->getUsername());
  // if ($validaiUsername != NULL) {
  //   $stringWarning = "Username terdaftar, ganti dengan yang lain !";
  // }
}
?>
<! DOCTYPE html>
  <html>

  <head>
    <script>
      function validasi(mode) {

        // var txtKode = document.getElementById("txtId").value;
        var txtNamaAwal = document.getElementById("txtNamaAwal").value;
        var txtTempatLahir = document.getElementById("txtTempatLahir").value;
        var txtTglLahir = document.getElementById("txtTglLahir").value;
        var radKelamin = $('input:radio[name="Kelamin"]:checked'); //document.getElementById("Kelamin");
        var txtTelepon = document.getElementById("txtTelepon").value;
        var txtAlamat = document.getElementById("txtAlamat").value;
        var txtPropinsi = document.getElementById("txtPropinsi").value;
        var txtNegara = document.getElementById("txtNegara").value;
        var cboKatSantri = document.getElementById("cboKatSantri").value;
        // var cboEmail = document.getElementById("cboEmail").value;
        var tglGabung = document.getElementById('tglGabung').value;
        var txtUsername = document.getElementById("txtUsername").value;
        var txtPassword = document.getElementById("txtPassword").value;
        var txtUlangPwd = document.getElementById("txtUlangPwd").value;
        // var txtPertanyaan = document.getElementById("txtPertanyaan").value;
        // var txtJawaban = document.getElementById("txtJawaban").value;
        var cboStatusPerkawinan = document.getElementById("cboStatusPerkawinan").value;
        // var txtWarning = document.getElementById("txtWarning").value;
        // var listmenu = document.getElementById("listMenu").value;
        // var listInstitusi = document.getElementById("listInstitusi").value;
        //untuk validasi email
        // var x = document.getElementById("cboEmail").value;
        // var atpos = x.indexOf("@");
        // var dotpos = x.lastIndexOf(".");

        // if (listInstitusi === "") {
        //   alert("Institusi belum dipilh !");
        //   document.getElementById("listInstitusi").focus();
        // } else 
        // if (txtKode === "") {
        //   alert("Text Kode Masih Kosong !");
        //   return false;
        // } else 
        if (txtNamaAwal === "") {
          alert("Nama Masih Kosong !");
          document.getElementById("txtNamaAwal").focus();
        } else if (txtTempatLahir === "") {
          alert("Tempat Lahir Masih Kosong !");
          document.getElementById("txtTempatLahir").focus();
        } else if (isValidDate(txtTglLahir) == false) {
          alert("Tanggal lahir tidak valid");
          document.getElementById("txtTglLahir").focus();
        } else if (radKelamin.length == 0) {
          alert("Jenis kelamin belum dipilih !");
          document.getElementById("Kelamin").focus()
        } else if (cboStatusPerkawinan == "blank") {
          alert("Status perkawinan belum dipilih !");
          document.getElementById("cboStatusPerkawinan").focus();
        } else if (isNaN(txtTelepon) === true) {
          alert("Text Telpon bukan angka !");
          document.getElementById("txtTelepon").focus();
        } else if (txtAlamat === "") {
          alert("Alamat masih kosong !");
          document.getElementById("txtAlamat").focus();
        } else if (txtPropinsi === "") {
          alert("Propinsi Masih kosong !");
          document.getElementById("txtPropinsi").focus();
        } else if (txtNegara === "") {
          alert("Negara masih kosong !");
          document.getElementById("txtNegara").focus();
        } else if (cboKatSantri == "blank") {
          alert("Kategori santri belum dipilih !");
          document.getElementById("cboKatSantri").focus();
          // } else if (cboEmail == "") {
          //   alert("Email masih kosong !");
          //   document.getElementById("cboEmail").focus();
          // } else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
          //   alert("Email salah !");
          //   document.getElementById("cboEmail").focus();
        } else if (isValidDate(tglGabung) == false) {
          alert("Tanggal bergabung tidak valid");
          document.getElementById("tglGabung").focus();
        } else if (txtUsername == "") {
          alert("Username masih kosong !");
          document.getElementById("txtUsername").focus();
        } else if (txtPassword == "") {
          alert("Password masih kosong !");
          document.getElementById("txtPassword").focus();
        } else if (txtPassword.length < 4) {
          alert("Password kurang dari 4 karakter !");
          document.getElementById("txtPassword").focus();
        } else if (txtUlangPwd == "") {
          alert("Ulangi password masih kosong !");
          document.getElementById("txtUlangPwd").focus();
        } else if (txtUlangPwd != txtPassword) {
          alert("Ulangi password tidak sama !");
          document.getElementById("txtUlangPwd").focus();
          // } else if (txtPertanyaan == "") {
          //   alert("Pertanyaa ketika lupa password masih kosong !");
          //   document.getElementById("txtPertanyaan").focus();
          // } else if (txtJawaban == "") {
          //   alert("jawaban pertanyaan masih kosong !");
          //   document.getElementById("txtJawaban").focus();
          // } else if (listmenu == "") {
          //   alert("Default Menu belum dipilih !");
          //   document.getElementById("listMenu").focus();
        } else {
          // if (txtWarning != "") {
          //   alert(txtWarning);
          //   document.getElementById("txtUsername").focus();
          // } else {
          if (mode == 'save') {
            document.forms["fPersonal"].action = "?page=PersonalAction&action=insert";
            document.forms["fPersonal"].submit();
            return true;
          } else if (mode == 'save&complate') {
            document.forms["fPersonal"].action = "?page=PersonalAction&action=insert&complate";
            document.forms["fPersonal"].submit();
            return true;
          }
          // }
        }
      }

      function save(mode) {
        if (mode == 'save') {
          document.forms["fPersonal"].action = "?page=PersonalAction&action=insert";
          document.forms["fPersonal"].submit();
          return true;
        } else if (mode == 'save&complate') {
          document.forms["fPersonal"].action = "?page=PersonalAction&action=insert&complate";
          document.forms["fPersonal"].submit();
          return true;
        }
      }

      function back() {
        history.back();
      }

      function checkUser() {
        var txtUsername = document.getElementById("txtUsername").value;
        if (txtUsername != "") {
          document.forms["fPersonal"].action = "?page=Personal";
          document.forms["fPersonal"].submit();
          //document.location.href="?page=Personal&username="+document.write(txtUsername);
          return true;
        }
      }

      function readURL(input) {
        if (input.files && input.files[0]) {
          // if (input.files[0].size / 1024 >= 6000) {
          //   alert("Ukuran maximal gambar 6 MB");
          //   document.getElementById("txtGamabr").value = null;
          // } else {
          var reader = new FileReader();
          reader.onload = function(e) {
            $('#blah')
              .attr('src', e.target.result)
            //.width(150)
            //.height(200);
          };
          reader.readAsDataURL(input.files[0]);
          // }
        }
      }

      function resetUrl(input) {
        document.getElementById("blah").src = input;
        document.getElementById("txtGamabr").value = null;
      }

      $(document).ready(function() {
        $(document).on('change', '#listJenis', function() {
          var key = $(this).val();
          $('#listJenjang').load('<?= "view/Load.php?mode=jenjang&key=" ?>' + key);
        });
        $(document).on('change', '#listJenjang', function() {
          var key = $(this).val();
          $('#listKelas').load('<?= "view/Load.php?mode=kelas&key=" ?>' + key);
        });
        $(document).on('change', '#txtPropinsi', function() {
          var key = $(this).val();
          $('#txtKabupaten').load('<?= "view/Load.php?mode=kabupaten&key=" ?>' + key);
        });
        $(document).on('change', '#txtKabupaten', function() {
          var key = $(this).val();
          $('#txtKecamatan').load('<?= "view/Load.php?mode=kecamatan&key=" ?>' + key);
        });
        $(document).on('input', '#txtUsername', function() {
          var key = $(this).val();
          if (key == '' || key == null) {
            $('#usernameMessage').html('<font style="color: red;">Masukkan teks, karakter, angka, tanpa spasi !!</font>')
              .focus();
          } else {
            $.ajax({
              url: '<?= "view/Load.php?mode=checkUsername&key=" ?>' + key,
              type: "POST",
              dataType: "json",
              success: function(data) {
                $('#usernameMessage').html(data.text);
              }
            });
          }
        });
      });
    </script>
  </head>

  <body>
    <form id="fPersonal" name="fPersonal" method="post" enctype="multipart/form-data">
      <table width="100%" border="0" cellspacing="1" cellpadding="5" class="table-shadow">
        <tr>
          <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><img src="./images/form_add.png">&nbsp;<b>Input Personal Data</b></td>
        </tr>
        <tr>
          <td width="58">&nbsp;</td>
          <td width="133">&nbsp;</td>
          <td width="4">&nbsp;</td>
          <td width="500">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Status Awal&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <select name="status_awal" id="" style="width: 200px;">
              <option value="">- Pilih -</option>
              <option value="B">Baru</option>
              <option value="P">Pindahan</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Jenis&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td><select name="jenis" id="listJenis" style="width: 200px;">
              <option value="">- Pilih -</option>
              <option value="F">Formal</option>
              <option value="NF">Non Formal</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Jenjang&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <select name="jenjang" id="listJenjang" style="width: 200px;">
              <option value="">- Pilih -</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Kelas&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <select name="kelas" id="listKelas" style="width: 200px;">
              <option value="">- Pilih -</option>
            </select>
          </td>
        </tr>
        <!-- <tr>
          <td>&nbsp;</td>
          <td valign="top">Institusi&nbsp;<font color="red">*</font>
          </td>
          <td valign="top">:</td>
          <td>
            <select name="listInstitusi[]" id="listInstitusi" multiple="" style="width: 300px; height: 100px;">
              <?php
              foreach ($allInstitusi as $institusi) {
              ?>
                <option value="<?php echo $institusi->getKode() ?>" <?php if ($personal->getListInstitusi() != '') if (in_array($institusi->getKode(), $personal->getListInstitusi())) echo 'selected=""'; ?>><?php echo $institusi->getNamaInstitusi() ?></option>
              <?php
              }
              ?>
            </select>
          </td>
        </tr> -->
        <!-- <tr>
          <td>&nbsp;</td>
          <td>Kode&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td><label for="txtId"></label>
            <input name="txtId" type="text" id="txtId" size="12" maxlength="10" value="<?php echo $dataKode; ?>" readonly />
          </td>
        </tr> -->
        <input name="txtId" type="hidden" id="txtId" size="12" maxlength="10" value="<?php echo $dataKode; ?>" />
        <tr>
          <td>&nbsp;</td>
          <td>No Induk</td>
          <td>:</td>
          <td><label for="txtId"></label>
            <input name="no_induk" type="text" maxlength="25" style="width: 192px;" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>NISN</td>
          <td>:</td>
          <td><label for="txtId"></label>
            <input name="nisn" type="text" maxlength="25" style="width: 192px;" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Nama Awal&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td><label for="txtTempatLahir"></label>
            <input name="txtNamaAwal" type="text" id="txtNamaAwal" size="50" maxlength="50" value="<?php echo $personal->getNamaAwal(); ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Nama Tengah</td>
          <td>:</td>
          <td><label for="txtTanggalLahir"></label>
            <input name="txtNamaTengah" type="text" id="txtNamaTengah" size="50" maxlength="50" value="<?php echo $personal->getNamaTengah(); ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Nama Akhir</td>
          <td>:</td>
          <td><label for="txtPropinsi"></label>
            <input name="txtNamaAkhir" type="text" id="txtNamaAkhir" size="50" maxlength="50" value="<?php echo $personal->getNamaAkhir(); ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Nama Panggilan</td>
          <td>:</td>
          <td>
            <input name="txtNamaPanggilan" type="text" id="txtNamaPanggilan" size="50" maxlength="50" value="<?php echo $personal->getNamaPanggilan(); ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Tempat Lahir&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td><label for="txtNIS"></label>
            <input name="txtTempatLahir" type="text" id="txtTempatLahir" size="50" maxlength="50" value="<?php echo $personal->getTempatLahir(); ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Tanggal Lahir&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td><label for="txtTempatLahir"></label>
            <?php
            $tglTransaksi = $personal->getTglLahir();
            echo form_tanggal("txtTglLahir", $tglTransaksi);
            ?>
            <!--<input type="text" id="txtTglLahir" name="txtTglLahir" size="20" maxlength="20" />-->&nbsp; format ( mm/dd/yyyy )
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Jenis Kelamin&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <!--
          <select name="cboKelamin"id="cboKelamin">
              <option value="blank">-   Kosong  -</option>
              <option>Laki-Laki</option>
              <option>Perempuan</option>
          </select-->
            <input type="radio" name="Kelamin" id="Kelamin" value="1" <?php if ($personal->getKelamin() == "1")  echo 'checked=""'; ?> /> Laki-laki &nbsp;&nbsp;
            <input type="radio" name="Kelamin" id="Kelamin" value="2" <?php if ($personal->getKelamin() == "2")  echo 'checked=""'; ?> /> Perempuan
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Status Perkawinan&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td><select name="cboStatusPerkawinan" id="cboStatusPerkawinan" style="width: 200px;">
              <option value="blank">- Pilih -</option>
              <option value="Lajang" <?php if ($personal->getStatusPerkawinan() == "Lajang")  echo 'selected=""'; ?>>Lajang</option>
              <option value="Menikah" <?php if ($personal->getStatusPerkawinan() == "Menikah")  echo 'selected=""'; ?>>Menikah</option>
              <option value="Duda" <?php if ($personal->getStatusPerkawinan() == "Duda")  echo 'selected=""'; ?>>Duda</option>
              <option value="Janda" <?php if ($personal->getStatusPerkawinan() == "Janda")  echo 'selected=""'; ?>>Janda</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Telepon</td>
          <td>:</td>
          <td>
            <input name="txtTelepon" type="text" id="txtTelepon" maxlength="15" value="<?php echo $personal->getTelepon(); ?>" style="width: 192px;" />&nbsp; Masukan angka
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">Alamat&nbsp;<font color="red">*</font>
          </td>
          <td valign="top">:</td>
          <td>
            <!--<input name="txtAlamat" type="text" id="txtAlamat" size="50" maxlength="100" value="<?php //echo $personal->getAlamat();
                                                                                                    ?>"/>-->
            <textarea name="txtAlamat" id="txtAlamat" cols="46" rows="5" maxlength="250"><?php echo $personal->getAlamat(); ?></textarea>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Propinsi&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <select name="txtPropinsi" id="txtPropinsi" style="width: 200px;">
              <option value="">- Pilih -</option>
              <?php
              foreach ($allPropinsi as $value) {
              ?>
                <option value="<?php echo $value->getKode() ?>" <?php if ($value->getKode() == $personal->getPropinsi()) echo 'selected=""'; ?>> <?php echo $value->getNama() ?></option>
              <?php
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Kabupaten/Kota&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <select name="kabupaten" id="txtKabupaten" style="width: 200px;">
              <option value="">- Pilih -</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Kecamatan&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <!-- <td><input name="txtKota" type="text" id="txtKota" size="50" maxlength="100" value="<?php echo $personal->getKota(); ?>" /></td> -->
          <td>
            <select name="kecamatan" id="txtKecamatan" style="width: 200px;">
              <option value="">- Pilih -</option>
            </select>
          </td>
        </tr>
        <!-- <tr>
          <td>&nbsp;</td>
          <td>Negara&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td><label for="txtNegara"></label>
            <select name="txtNegara" id="txtNegara" style="width: 200px;">
              <option value="">- Pilih -</option>
              <?php
              foreach ($allNegara as $value) {
              ?>
                <option value="<?php echo $value->getKode() ?>" <?php if ($value->getKode() == $personal->getNegara()) echo 'selected=""'; ?>><?php echo $value->getNama() ?></option>
              <?php
              }
              ?>
            </select>
          </td>
        </tr> -->
        <!-- <tr>
          <td>&nbsp;</td>
          <td valign="top">Kegiatan&nbsp;</td>
          <td valign="top">:</td>
          <td>
            <textarea name="txtKegiatan" id="txtKegiatan" cols="37" rows="5" maxlength="250"><?php echo $personal->getKegiatan(); ?></textarea>
          </td>
        </tr> -->
        <tr>
          <td>&nbsp;</td>
          <td>Kategori Santri&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td><select name="cboKatSantri" id="cboKatSantri" style="width: 200px;">
              <option value="blank">- Pilih -</option>
              <option value="mukim" <?php if ($personal->getKategoriSantri() == "mukim")  echo 'selected=""'; ?>>Mukim</option>
              <option value="non mukim" <?php if ($personal->getKategoriSantri() == "non mukim")  echo 'selected=""'; ?>>Non Mukim</option>
            </select>
          </td>
        </tr>
        <!-- <tr>
          <td>&nbsp;</td>
          <td>Email&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <input type="text" name="cboEmail" id="cboEmail" size="50" value="<?php echo $personal->getEmail(); ?>" />
          </td>
        </tr> -->
        <tr>
          <td>&nbsp;</td>
          <td>Tanggal Bergabung&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td><?php
              $tglGng = $personal->getTglGabung();
              echo form_tanggal("tglGabung", $tglGng); ?>&nbsp; format ( mm/dd/yyyy )</td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <!-- <tr>
          <td>&nbsp;</td>
          <td>Username&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td><label for="txtPropinsi"></label>
            <input name="txtUsername" type="text" id="txtUsername" size="20" maxlength="100" value="<?php echo $user->getUsername(); ?>" onblur="checkUser();" /> &nbsp;
            <input name="txtUsername" type="text" id="txtUsername" size="20" maxlength="100" value="<?= $dataKode ?>" /> &nbsp;
            <div id="usernameMessage"></div>
            <font style="color: red;"><label id="warning"><?php echo $stringWarning; ?></label>
              <font>
                <input type="hidden" id="txtWarning" value="<?php echo $stringWarning; ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Password&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <input name="txtPassword" type="password" id="txtPassword" size="20" maxlength="50" /> &nbsp;Minimal 4 Karakter
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Ulang password&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <input name="txtUlangPwd" type="password" id="txtUlangPwd" size="20" maxlength="50" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Pertanyaan Lupa&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <input name="txtPertanyaan" type="text" id="txtPertanyaan" size="50" maxlength="50" value="<?php echo $user->getPertanyaan(); ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Jawaban&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <input name="txtJawaban" type="text" id="txtJawaban" size="50" maxlength="50" value="<?php echo $user->getJawaban(); ?>" />
          </td>
        </tr> -->
        <!--<tr>
      <td>&nbsp;</td>
      <td>Level&nbsp;<font color="red">*</font></td>
      <td>:</td>
      <td><select name="cboLevel" id="cboLevel">
        <option value="blank">- Kosong -</option>
        <option value="admin">Admin</option>
        <option>Kepala Sekolah</option>
        <option>Guru</option>
        <option>Siswa</option>
      </select></td>
    </tr>-->
        <!-- <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr> -->
        <!-- <tr>
          <td>&nbsp;</td>
          <td valign="top">Group Menu&nbsp;<font color="red">*</font>
          </td>
          <td valign="top">:</td>
          <td>
            <select name="listMenu[]" id="listMenu" multiple="" style="width: 300px; height: 100px;">
              <?php
              foreach ($allGroup as $group) {
              ?>
                <option value="<?php echo $group->getKode() ?>" <?php if ($personal->getListMenu() != '') if (in_array($group->getKode(), $personal->getListMenu()))  echo 'selected=""'; ?>><?php echo $group->getNamaGroup() ?></option>
              <?php
              }
              ?>
            </select>
          </td>
        </tr> -->
        <tr>
          <td>&nbsp;</td>
          <td>Foto</td>
          <td>:</td>
          <td>
            <div align="left"><img id="blah" style="background-color: #eee;
                                            border: 1px solid #ccc;
                                            width: 130px;
                                            height: 150px;
                                            border-radius: 3px;
                                            box-shadow: 0 1px 0 #999;" src="./foto/images2.jpg" width="120" height="120" />
            </div>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>
            <!-- <input type="file" id="txtGamabr" name="txtGamabr" onchange="readURL(this);"> -->
            <input type="file" name="txtGamabr" onchange="readURL(this);">
            <input type="button" id="default" name="default" value="Foto default" onclick="resetUrl('./foto/images2.jpg')">
          </td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3">
            <font color="red">*</font>&nbsp;Harus diisi
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <hr width="90%" color="#ccc">
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>
            <!-- <input type="button" name="bSimpan" id="bSimpan" value="Simpan" onClick="validasi('save');" /> -->
            <input type="button" id="bBack" value="Kembali" onclick="back();" />
            <input type="button" name="bSimpan" id="bSimpan" value="Simpan" onclick="save('save');" />
            <!--<input type="button" name="bSimpan" id="bNext" value="Simpan & Berikutnya >>" onClick="validasi('save&complate');" />-->
            <input type="reset" name="bReset" id="bReset" value="Reset" onclick="resetUrl('./foto/images2.jpg')" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <input type="hidden" name="txtIdUser" id="txtIdUser" value="<?php echo $buatKode; ?>" />
      </table>
    </form>
  </body>

  </html>