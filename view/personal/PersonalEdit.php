<?php
include_once './dao/PersonalDao.php';
include_once './model/User.php';
include_once './dao/InstitusiDao.php';
include_once './dao/NegaraDao.php';
include_once './dao/PropinsiDao.php';
//untuk mendapatkan institusi
$institusiDao = new InstitusiDao();
$allInstitusi = $institusiDao->getAllInstitusi();
//untuk mendapatkan list Negara
$negaraDao = new NegaraDao();
$allNegara = $negaraDao->getAllNegara();
//untuk mendapatkan propinsi
$propinsiDao = new PropinsiDao();
$allPropinsi = $propinsiDao->getAllPropinsi();

$personal = new Personal();
$user = new User();
if ($_GET) {
  $kode = $_GET['Kode'];
  //$mode=isset($_GET['user']) ? $_GET['user'] : 'U';
  $personalDao = new PersonalDao();
  $personal = $personalDao->getPersonal($kode);
  $user = $personalDao->getUser($kode);
}
?>
<! DOCTYPE html>
  <html>

  <head>
    <script src="js/jquery-1.11.0.js"></script>
    <script src="js/jquery.plugin.js"></script>
    <script src="js/jquery.datepick.js"></script>
    <script>
      function valid(mode) {
        // var txtKode = document.getElementById("txtId").value;
        var txtNamaAwal = document.getElementById("txtNamaAwal").value;
        var txtTempatLahir = document.getElementById("txtTempatLahir").value;
        var txtTglLahir = document.getElementById("txtTglLahir").value;
        var radKelamin = $('input:radio[name="Kelamin"]:checked'); //document.getElementById("Kelamin").checked;
        var txtTelepon = document.getElementById("txtTelepon").value;
        var txtAlamat = document.getElementById("txtAlamat").value;
        var txtPropinsi = document.getElementById("txtPropinsi").value;
        // var txtNegara = document.getElementById("txtNegara").value;
        var cboKatSantri = document.getElementById("cboKatSantri").value;
        // var cboEmail = document.getElementById("cboEmail").value;
        var tglGabung = document.getElementById('tglGabung').value;
        var cboStatusPerkawinan = document.getElementById("cboStatusPerkawinan").value;
        // var x = document.getElementById("cboEmail").value;
        // var atpos = x.indexOf("@");
        // var dotpos = x.lastIndexOf(".");

        // if (txtKode === "") {
        //   alert("Text Kode Masih Kosong !");
        //   return false;
        // } else if (txtNamaAwal === "") {
        //   alert("Nama Masih Kosong !");
        //   document.getElementById("txtNamaAwal").focus();

        // } else if (txtTempatLahir === "") {
        //   alert("Tempat Lahir Masih Kosong !");
        //   document.getElementById("txtTempatLahir").focus();
        // } else if (isValidDate(txtTglLahir) == false) {
        //   alert("Tanggal lahir tidak valid");
        //   document.getElementById("txtTglLahir").focus();
        // } else if (radKelamin == false) {
        //   alert("Jenis kelamin belum dipilih !");
        //   document.getElementById("Kelamin").focus();
        // } else if (cboStatusPerkawinan == "blank") {
        //   alert("Status perkawinan belum dipilih !");
        //   document.getElementById("cboStatusPerkawinan").focus();
        // } else if (isNaN(txtTelepon) === true) {
        //   alert("Text Telpon bukan angka !");
        //   document.getElementById("txtTelepon").focus();
        // } else if (txtAlamat === "") {
        //   alert("Alamat masih kosong !");
        //   document.getElementById("txtAlamat").focus();
        // } else if (txtPropinsi === "") {
        //   alert("Propinsi Masih kosong !");
        //   document.getElementById("txtPropinsi").focus();
        // } else if (txtNegara === "") {
        //   alert("Negara masih kosong !");
        //   document.getElementById("txtNegara").focus();
        // } else if (cboKatSantri == "blank") {
        //   alert("Kategori santri belum dipilih !");
        //   document.getElementById("cboKatSantri").focus();
        // } else if (cboEmail == "") {
        //   alert("Email masih kosong !");
        //   document.getElementById("cboEmail").focus();
        // } else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        //   alert("Email salah !");
        //   document.getElementById("cboEmail").focus();
        // } else if (isValidDate(tglGabung) == false) {
        //   alert("Tanggal bergabung tidak valid");
        //   document.getElementById("tglGabung").focus();
        // } else {
        if (mode === "delete") {
          if (confirm('Apakah anda yakin mau menghapus ?')) {
            document.forms["fprsnl"].action = "?page=PersonalAction&action=delete";
            document.forms["fprsnl"].submit();
            return true;
          }
        } else if (mode === "update") {
          document.forms["fprsnl"].action = "?page=PersonalAction&action=update";
          document.forms["fprsnl"].submit();
          return true;
        }
        // }
      }

      function readURL(input) {
        if (input.files && input.files[0]) {
          if (input.files[0].size / 1024 >= 1000) {
            alert("Ukuran maximal gambar 0.1 MB");
            document.getElementById("txtGamabr").value = null;
          } else {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#blah')
                .attr('src', e.target.result)
              //.width(150)
              //.height(200);
            };

            reader.readAsDataURL(input.files[0]);
          }
        }
      }

      function resetUrl(input) {
        document.getElementById("blah").src = input;
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
      });
    </script>
  </head>

  <body>
    <form id="fprsnl" name="fprsnl" method="post" enctype="multipart/form-data">
      <table width="100%" border="0" cellspacing="1" cellpadding="5" class="table-shadow">
        <tr>
          <td colspan="4" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;">
            <!--<img src="./images/form_add.png">-->&nbsp;<b>Master | Edit Data Pribadi</b>
          </td>
        </tr>
        <tr>
          <td width="58">&nbsp;</td>
          <td width="133">&nbsp;</td>
          <td width="4">&nbsp;</td>
          <td width="500">&nbsp;</td>
        </tr>
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
        <!-- <tr <?php if ($_SESSION['modeuser'] != "A") echo 'hidden=""' ?>>
          <td>&nbsp;</td>
          <td valign="top">Institusi&nbsp;<font color="red">*</font>
          </td>
          <td valign="top">:</td>
          <td>
            <select name="listInstitusi[]" id="listInstitusi" multiple="" style="width: 300px; height: 100px;" <?php if ($_SESSION['modeuser'] != "A") echo 'disabled=""' ?>>
              <?php
              foreach ($allInstitusi as $institusi) {
              ?>
                <option value="<?php echo $institusi->getKode(); ?>" <?php if (in_array($institusi->getKode(), $personal->getListInstitusi())) echo 'selected=""' ?>><?php echo $institusi->getNamaInstitusi(); ?></option>
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
          <td>
            <input name="txtId" type="text" id="txtId" size="12" maxlength="10" value="<?php echo $personal->getIdPersonal(); ?>" readonly />
          </td>
        </tr> -->
        <input type="hidden" name="txtId" id="txtId" size="12" maxlength="10" value="<?= $personal->getIdPersonal() ?>" />
        <tr>
          <td>&nbsp;</td>
          <td>Status Awal&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <select name="status_awal" id="" style="width: 200px;">
              <option value="">- Pilih -</option>
              <option value="B" <?php if ($personal->getStatusAwal() == 'B') echo 'selected'; ?>>Baru</option>
              <option value="P" <?php if ($personal->getStatusAwal() == 'P') echo 'selected'; ?>>Pindahan</option>
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
              <option value="F" <?php if ($personal->getJenis() == 'F') echo 'selected'; ?>>Formal</option>
              <option value="NF" <?php if ($personal->getJenis() == 'NF') echo 'selected'; ?>>Non Formal</option>
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
              <?php
              $qry = mysql_query("SELECT * FROM jenjang WHERE jenis = '" . $personal->getJenis() . "'");
              while ($row = mysql_fetch_array($qry)) {
                $slc = ($row['id'] == $personal->getJenjang()) ? 'selected' : null;
                echo '<option value="' . $row['id'] . '" ' . $slc . '>' . $row['nama'] . '</option>';
              }
              ?>
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
              <?php
              $sql = mysql_query('SELECT * FROM jenjang WHERE id ="' . $personal->getJenjang() . '"');
              $sql1 = mysql_fetch_array($sql);
              $start = $sql1['start'];
              $end = $sql1['end'];
              // echo '<option value="">- Pilih -</option>';
              for ($i = $start; $i <= $end; $i++) {
                $slc = ($i == $personal->getKelas()) ? 'selected' : null;
                echo '<option value="' . $i . '" ' . $slc . '>' . $i . '</option>';
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>No Induk</td>
          <td>:</td>
          <td><label for="txtId"></label>
            <input name="no_induk" type="text" maxlength="25" style="width: 192px;" value="<?= $personal->getNoInduk() ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>NISN</td>
          <td>:</td>
          <td><label for="txtId"></label>
            <input name="nisn" type="text" maxlength="25" style="width: 192px;" value="<?= $personal->getNISN() ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Nama Awal&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <input name="txtNamaAwal" type="text" id="txtNamaAwal" size="50" maxlength="50" value="<?php echo $personal->getNamaAwal(); ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Nama Tengah</td>
          <td>:</td>
          <td>
            <input name="txtNamaTengah" type="text" id="txtNamaTengah" size="50" maxlength="50" value="<?php echo $personal->getNamaTengah(); ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Nama Akhir</td>
          <td>:</td>
          <td>
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
          <td>
            <input name="txtTempatLahir" type="text" id="txtTempatLahir" size="50" maxlength="50" value="<?php echo $personal->getTempatLahir(); ?>" />
          </td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td>Tanggal Lahir&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <?php
            $date = IndonesiaTgl($personal->getTglLahir());
            echo form_tanggal("txtTglLahir", $date);
            ?>
            <!--<input type="text" id="txtTglLahir" name="txtTglLahir" size="20" maxlength="20" value="<?php //echo $date->format("m/d/Y");
                                                                                                        ?>"/>-->&nbsp; format ( mm/dd/yyyy )
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
              <option value="blank">- Kosong -</option>
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
            <input name="txtTelepon" type="text" id="txtTelepon" size="20" maxlength="15" value="<?php echo $personal->getTelepon(); ?>" style="width: 192px;" />&nbsp; Masukan angka
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">Alamat&nbsp;<font color="red">*</font>
          </td>
          <td valign="top">:</td>
          <td>
            <?php /*?><input name="txtAlamat" type="text" id="txtAlamat" size="50" maxlength="100" value="<?php echo $personal->getAlamat();?>"/><?php */ ?>
            <textarea name="txtAlamat" id="txtAlamat" cols="46" rows="5" maxlength="250"><?php echo $personal->getAlamat(); ?></textarea>
          </td>
        </tr>
        <!-- <tr>
          <td>&nbsp;</td>
          <td>Kota</td>
          <td>:</td>
          <td><input name="txtKota" type="text" id="txtKota" size="50" maxlength="100" value="<?php echo $personal->getKota(); ?>" /></td>
        </tr> -->
        <tr>
          <td>&nbsp;</td>
          <td>Propinsi&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <select name="txtPropinsi" id="txtPropinsi" style="width: 200px;">
              <option value="">- Pilih Salah satu -</option>
              <?php
              foreach ($allPropinsi as $value) {
              ?>
                <option value="<?Php echo $value->getKode(); ?>" <?php if ($personal->getPropinsi() == $value->getKode()) echo 'selected=""' ?>>
                  <?php echo $value->getNama() ?>
                </option>
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
              <?php
              $sql = mysql_query('SELECT * FROM wilayah_kabupaten WHERE provinsi_id ="' . $personal->getProv() . '" ORDER BY nama ASC');
              // echo '<option value="">- Pilih -</option>';
              while ($row = mysql_fetch_array($sql)) {
                $slc = ($row['id'] == $personal->getKab()) ? 'selected' : null;
                echo '<option value="' . $row['id'] . '" ' . $slc . '>' . $row['nama'] . '</option>';
              }
              ?>
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
              <?php
              $sql = mysql_query('SELECT * FROM wilayah_kecamatan WHERE kabupaten_id ="' . $personal->getKab() . '" ORDER BY nama ASC');
              // echo '<option value="">- Pilih -</option>';
              while ($row = mysql_fetch_array($sql)) {
                $slc = ($row['id'] == $personal->getKec()) ? 'selected' : null;
                echo '<option value="' . $row['id'] . '" ' . $slc . '>' . $row['nama'] . '</option>';
              }
              ?>
            </select>
          </td>
        </tr>
        <!-- <tr>
          <td>&nbsp;</td>
          <td>Negara&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td>
            <select name="txtNegara" id="txtNegara" style="width: 200px;">
              <option value="">- Pilih Salah satu -</option>
              <?php
              foreach ($allNegara as $value) {
              ?>
                <option value="<?Php echo $value->getKode(); ?>" <?php if ($personal->getNegara() == $value->getKode()) echo 'selected=""' ?>>
                  <?php echo $value->getNama() ?>
                </option>
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
              <option value="blank">- Kosong -</option>
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
            <input type="text" name="cboEmail" id="cboEmail" value="<?php echo $personal->getEmail(); ?>" size="50" />
          </td>
        </tr> -->
        <tr>
          <td>&nbsp;</td>
          <td>Tanggal Bergabung&nbsp;<font color="red">*</font>
          </td>
          <td>:</td>
          <td> <?php
                $dateGabung = IndonesiaTgl($personal->getTglGabung());
                echo form_tanggal("tglGabung", $dateGabung);
                ?>
            <!--<input type="text" id="tglGabung" name="tglGabung" value="<?php //echo $dateGabung->format("m/d/Y");
                                                                          ?>"/>-->&nbsp; format ( mm/dd/yyyy )
          </td>
        </tr>
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
                                            box-shadow: 0 1px 0 #999;" src="foto/<?php echo trim($personal->getFoto()); ?>" />
            </div>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input type="file" name="txtGamabr" id="txtGamabr" onChange="readURL(this);" /></td>
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
          <td><input type="button" name="bEdit" id="bEdit" value="Ubah" onClick="valid('update');" />
            <input <?php if ($_SESSION['modeuser'] != "A") echo 'disabled=""' ?> type="button" name="bDelete" id="bDelete" value="Hapus" onClick="valid('delete');" />
            <input type="reset" name="bReset" id="bReset" value="Reset" onclick="resetUrl('foto/<?php echo trim($personal->getFoto()); ?>')" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
    </form>
  </body>

  </html>