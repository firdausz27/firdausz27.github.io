<?php
include_once '../db/DBConnection.php';
$koneksi = new DBConnection();
$koneksi->getKonnection();
$key = $_GET['key'];
switch ($_GET['mode']) {
    case 'checkUsername':
        $sql = mysql_query("SELECT * FROM user WHERE username ='$key'");
        $sql1 = mysql_num_rows($sql);
        $rdy = ($sql1 == 0) ? 'Yes' : 'No';
        $txt = ($sql1 == 0) ? '<font style="color: green;">Username Bisa Digunakan</font>' : '<font style="color: red;">Username Sudah Digunakan !!</font>';
        $data = ['ready' => $rdy, 'text' => $txt];
        header('Content-Type: application/json');
        echo json_encode($data);
        break;
        
    case 'jenjang':
        $sql = mysql_query("SELECT * FROM jenjang WHERE jenis ='$key' AND active = 'Y'");
        echo '<option value="">- Pilih -</option>';
        while ($row = mysql_fetch_array($sql)) {
            echo '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
        }
        break;

    case 'kelas':
        $sql = mysql_query("SELECT * FROM jenjang WHERE id ='$key'");
        $sql1 = mysql_fetch_array($sql);
        $start = $sql1['start'];
        $end = $sql1['end'];
        echo '<option value="">- Pilih -</option>';
        for ($i = $start; $i <= $end; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }
        break;

    case 'kabupaten':
        $sql = mysql_query("SELECT * FROM wilayah_kabupaten WHERE provinsi_id ='$key' ORDER BY nama ASC");
        echo '<option value="">- Pilih -</option>';
        while ($row = mysql_fetch_array($sql)) {
            echo '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
        }
        break;

    case 'kecamatan':
        $sql = mysql_query("SELECT * FROM wilayah_kecamatan WHERE kabupaten_id ='$key' ORDER BY nama ASC");
        echo '<option value="">- Pilih -</option>';
        while ($row = mysql_fetch_array($sql)) {
            echo '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
        }
        break;
}
