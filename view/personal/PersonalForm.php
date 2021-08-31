<?php
include_once './dao/PersonalDao.php';
$personalDa = new PersonalDao();
$allKategori = $personalDa->getAllPersonal();
$row = 30;
//$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$hal =  isset($_POST['cboPage']) ? $_POST['cboPage'] : 0;
$jumlah = sizeof($allKategori);
$max = ceil($jumlah / $row);
$allKaryawanPage = $personalDa->getAllPersonalPage($hal, $row);
$nomor = 0;
$field =  isset($_POST['cboCari']) ? $_POST['cboCari'] : 0;
if ($field != 'blank' || $field != 0) {
    $allKaryawanPage = $personalDa->getCariPersonal($_POST['cboCari'], $_POST['txtCari']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Karyawan</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script>
        function validasi() {
            var field = document.getElementById("cboCari").value;
            var text = document.getElementById("txtCari").value;
            if (field === "blank") {
                alert("Field pencarian belum dipilih !");
                return false;
            } else if (text === "") {
                alert("Text Pencarian masih kosong !");
            } else {
                document.forms["fPersonal"].action = "?page=PersonalForm";
                document.forms["fPersonal"].submit();
                return true;
            }
        }

        function kirim() {
            document.forms["fPersonal"].action = "?page=PersonalForm";
            document.forms["fPersonal"].submit();
            return true;
        }

        function KirimEdit(isi) {
            document.getElementById("userId").value = isi;
            document.forms["fPersonal"].action = "?page=TabEdit";
            document.forms["fPersonal"].submit();
            return true;
        }
    </script>
</head>

<body>
    <form name="fPersonal" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">
            <tr>
                <td colspan="9" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Master | Personal Data</b></td>
            </tr>
            <tr>
            	<td width=" 567">Cari
                    <select name="cboCari" id="cboCari">
                        <option value="blank">- All -</option>
                        <!-- <option value="id_siswa">Kode</option> -->
                        <option value="nama_awal">Nama Depan</option>
                        <option value="nama_tengah">Nama tengah</option>
                        <option value="nama_akhir">Nama Belakang</option>
                        <option value="alamat">Alamat</option>
                    </select>
                    Kata Kunci
                    <input type="text" name="txtCari" id="txtCari">
                    <input type="button" name="bCari" id="bCari" value="Cari" onclick="validasi();">
                </td>

            </tr>
            <tr>
                <td colspan="1"><a href="?page=Personal">Tambah Data</a></td>
                <td width="636" colspan="2" align='right'>Halamam <select name="cboPage" onchange="kirim();">
                        <?php
                        $jmlh = 0;
                        for ($h = 1; $h <= $max; $h++) {
                            $list[$h] = $row * $h - $row;
                            $jmlh = $jmlh + 1;
                        ?>
                            <option value="<?php echo $list[$h]; ?>" <?php if ($hal == $list[$h]) echo 'selected=""'; ?>> <?php echo $h; ?> </option>
                        <?php
                        }
                        ?>
                    </select> Dari : <?php echo $jmlh; //$jumlah; 
                                        ?> </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr style="background:window ">
                            <th width="30">No</th>
                            <!-- <th width="139">Kode</th> -->
                            <th width=100>NISN</th>
                            <th width=200>Nama</th>
                            <th width="200">Tempat/tgl Lahir</th>
                            <th width="100">Jenis Kelamin</th>
                            <th width="100">Telepon</th>
                            <th width="239">Alamat</th>
                            <th width="50">Aksi</th>
                        </tr>
                        <input type="hidden" name="userId" id="userId">
                        <input type="hidden" name="mode" id="mode" value="1">
                        <input type="hidden" name="user" id="user" value="A">
                        <?php
                        foreach ($allKaryawanPage as $value) {
                            $nomor++;
                            $id = $value->getIdPersonal();
                            $kelamin = ($value->getKelamin() == 1) ? 'Laki-laki' : 'Perempuan';
                            //$kode=encrypt_decrypt('encrypt', $id);
                        ?>
                            <tr <?php if (($nomor % 2) == 0) {
                                    echo 'style="background:#E2EBED;"';
                                } else {
                                    echo 'style="background:#F0F0F0;"';
                                } ?>>
                                <td><?PHP echo $nomor; ?></td>
                                <!-- <td><a href="#" onclick="KirimEdit('<?php echo $id; ?>');"><?PHP echo $value->getIdPersonal(); ?></a></td> -->
                                <td><?= $value->getNISN() ?></td>
                                <td><?PHP echo $value->getNamaAwal() . " " . $value->getNamaTengah() . " " . $value->getNamaAkhir(); ?></td>
                                <td><?PHP echo $value->getTempatLahir() . " / " . IndonesiaTgl($value->getTglLahir()); ?></td>
                                <td><?= $kelamin ?></td>
                                <td><?PHP if ($value->getTelepon() == NULL) {
                                        echo 'N/A';
                                    } else {
                                        echo $value->getTelepon();
                                    } ?></td>
                                <td><?PHP echo $value->getAlamat(); ?></td>
                                <td><a href="#" onclick="KirimEdit('<?php echo $id; ?>');" title="Edit Data">Edit</a></td>
                            </tr>
                        <?php } ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <!--
          <td>Jumlah : <?php //echo $jumlah; 
                        ?></td>
          <td align="right"> Halaman Ke :
              <?php
                /*
                for($h=1;$h<=$max;$h++){
                    $list[$h]=$row*$h-$row;
                    echo "<a href='?page=PersonalForm&hal=$list[$h]'>$h</a>";
                }  */
                ?>
          </td>-->
            </tr>
        </table>
    </form>
</body>

</html>