<?php
include_once '../../db/DBConnection.php';
include_once '../../model/Personal.php';

function getAllPersonalPage($hal,$row){
        $personals=array();
        $sql="select * from personal order by id_siswa asc limit $hal,$row";
        $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $personal=new Personal();
          $personal->setIdPersonal($dataRow['id_siswa']);
          $personal->setNamaAwal($dataRow['nama_awal']);
          $personal->setNamaTengah($dataRow['nama_tengah']);
          $personal->setNamaAkhir($dataRow['nama_akhir']);
          $personal->setTempatLahir($dataRow['tempat_lahir']);
          $personal->setTglLahir($dataRow['tgl_lahir']);
          $personal->setTelepon($dataRow['telepon']);
          $personal->setAlamat($dataRow['alamat']);
          $personal->setKota($dataRow['kota']);
          $personal->setPropinsi($dataRow['propinsi']);
          $personal->setNegara($dataRow['negara']);
          $personal->setEmail($dataRow['email']);
          $personal->setTglGabung($dataRow['tgl_gabung']);
          $personal->setKelamin($dataRow['kelamin']);
          $personal->setKategoriSantri($dataRow['kategori_santri']);
          $personal->setFoto($dataRow['foto']);
          $personals[]=$personal;
        }
        return $personals;
    }
    
    function getCariPersonal($field, $text){
        $personals=array();
        $sql="select * from personal where $field like '%$text%' order by id_siswa";
        $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $personal=new Personal();
          $personal->setIdPersonal($dataRow['id_siswa']);
          $personal->setNamaAwal($dataRow['nama_awal']);
          $personal->setNamaTengah($dataRow['nama_tengah']);
          $personal->setNamaAkhir($dataRow['nama_akhir']);
          $personal->setTempatLahir($dataRow['tempat_lahir']);
          $personal->setTglLahir($dataRow['tgl_lahir']);
          $personal->setTelepon($dataRow['telepon']);
          $personal->setAlamat($dataRow['alamat']);
          $personal->setKota($dataRow['kota']);
          $personal->setPropinsi($dataRow['propinsi']);
          $personal->setNegara($dataRow['negara']);
          $personal->setEmail($dataRow['email']);
          $personal->setTglGabung($dataRow['tgl_gabung']);
          $personal->setKelamin($dataRow['kelamin']);
          $personal->setKategoriSantri($dataRow['kategori_santri']);
          $personal->setFoto($dataRow['foto']);
          $personals[]=$personal;
        }
        return $personals;
    }
    
    function getAllPersonal(){
        $personals=array();
        $sql="select * from personal order by id_siswa";
        $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $personal=new Personal();
          $personal->setIdPersonal($dataRow['id_siswa']);
          $personal->setNamaAwal($dataRow['nama_awal']);
          $personal->setNamaTengah($dataRow['nama_tengah']);
          $personal->setNamaAkhir($dataRow['nama_akhir']);
          $personal->setTempatLahir($dataRow['tempat_lahir']);
          $personal->setTglLahir($dataRow['tgl_lahir']);
          $personal->setTelepon($dataRow['telepon']);
          $personal->setAlamat($dataRow['alamat']);
          $personal->setKota($dataRow['kota']);
          $personal->setPropinsi($dataRow['propinsi']);
          $personal->setNegara($dataRow['negara']);
          $personal->setEmail($dataRow['email']);
          $personal->setTglGabung($dataRow['tgl_gabung']);
          $personal->setKelamin($dataRow['kelamin']);
          $personal->setKategoriSantri($dataRow['kategori_santri']);
          $personal->setFoto($dataRow['foto']);
          $personals[]=$personal;
        }
        return $personals;
    }
    
    function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$bln/$tgl/$thn";
	return $tanggal;
}
    
$row=50;
//$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$hal=  isset($_POST['cboPage']) ? $_POST['cboPage'] :0;
$jumlah = sizeof(getAllPersonal());
$max= ceil($jumlah/$row);
$allKaryawanPage=NULL;
$allKaryawanPage =getAllPersonalPage($hal, $row);
$nomor=0;
$field=  isset($_POST['cboCari']) ? $_POST['cboCari'] :0;
if($field!='blank' || $field!=0){
    $allKaryawanPage=getCariPersonal($_POST['cboCari'], $_POST['txtCari']);
}

 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Karyawan</title>
        <link href="../../css/style.css" rel="stylesheet" type="text/css">  
        <script>
            function changeparent(doc,doc2){
                    var input1=doc;
                    var input2=doc2;
                    window.opener.document.getElementById('txtEmpId').value=input1;
                    window.opener.document.getElementById('txtNama').value=input2;
                    window.close();
            }
            
            function validasi(){
                var field=document.getElementById("cboCari").value;
                var text=document.getElementById("txtCari").value;
                if(field==="blank"){
                    alert("Field pencarian belum dipilih !");
                    return false;
                }else if(text===""){
                    alert("Text Pencarian masih kosong !");
                }else{
                    document.forms["fPersonal"].action;
                    document.forms["fPersonal"].submit();
                    return true;
                }
            }
            
            function kirim(){
                document.forms["fPersonal"].action="?./view/keuangan_pinjam/SearchPersonal.php";
                document.forms["fPersonal"].submit();
                return true;
            }
        </script>
    </head>
    <body style="margin-left: 0px; margin-top: 0px;">
    <form name="fPersonal" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow" >    
            <tr>
                <td colspan="9" align="left" class="title-form"><img src="../../images/application_side_list.png" ">&nbsp;<b>Cari | Personal Data </b></td>
            </tr>
            <tr>
            	<td width="567">Cari 
            	  <select name="cboCari" id="cboCari">
            	    <option value="blank">- All -</option>
            	    <option value="id_siswa">Kode</option>
            	    <option value="nama_awal">Nama Awal</option>
                    <option value="nama_tengah">Nama tengah</option>
                    <option value="nama_akhir">Nama Akhir</option> 
            	    <option value="alamat">Alamat</option>
       	        </select>
            	  Kata Kunci
           	      <input type="text" name="txtCari" id="txtCari">
                      <input type="button" name="bCari" id="bCari" value="Cari" onclick="validasi();"></td>
                      
            </tr>
            <tr>
              <td colspan="1"></td>
              <td width="636" colspan="2" align='right'>Halamam <select name="cboPage" onchange="kirim();">
                      <?php
                        $jmlh=0;
                        for($h=1;$h<=$max;$h++){
                            $list[$h]=$row*$h-$row;
                            $jmlh=$jmlh+1;
                        ?>
                      <option value="<?php echo $list[$h]; ?>" <?php if($hal==$list[$h]) echo 'selected=""';?> > <?php echo $h; ?> </option>
                       <?php
                        }              
                       ?>
                  </select>  Dari : <?php echo $jmlh;//$jumlah; ?> </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3" id="tblMain">
                        <tr style="background:window ">
                          <th width="20">No</th>
                          <th width="100">Kode</th>
                          <th width=200>Nama</th>
                          <th width="150">Tempat/tgl Lahir</th>
                          <th width="50">Telepon</th>
                          <th width="200">Alamat</th>
                        </tr>
                  
                  <?php
                      foreach ($allKaryawanPage as $value) {
                          $nomor++;
                          $id=$value->getIdPersonal();  
                          $nama=$value->getNamaAwal()." " .$value->getNamaTengah()." ".$value->getNamaAkhir();
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?> onClick="javascript:changeparent('<?php echo $id; ?>','<?php echo $nama; ?>');">
                    <td><?PHP echo $nomor;?></td>
                    <td><?PHP echo $value->getIdPersonal();?></td>
                    <td><?PHP echo $value->getNamaAwal()." " .$value->getNamaTengah()." ".$value->getNamaAkhir();?></td>    
                    <td><?PHP echo $value->getTempatLahir()." / ".IndonesiaTgl($value->getTglLahir()); ?></td>
                    <td><?PHP if($value->getTelepon()==NULL){echo 'N/A';}else{echo $value->getTelepon(); }?></td>
                    <td><?PHP echo $value->getAlamat();?></td>
                    </tr>
                  <?php } ?>
              </table>
            <script language="javascript">

            var tbl = document.getElementById("tblMain");

            if (tbl != null) {

                if (tbl.rows[0] != null) {

                    tbl.rows[0].style.backgroundColor = "#365890";

                    tbl.rows[0].style.color = "#FFFFFF";

                }

                for (var i = 1; i < tbl.rows.length; i++) {

                    tbl.rows[i].style.cursor = "pointer";

                    tbl.rows[i].onmousemove = function () { this.style.backgroundColor = "#cccccc"; this.style.color = "#FFFFFF"; };

                    tbl.rows[i].onmouseout = function () { this.style.backgroundColor = ""; this.style.color = ""; };

                }

            }

        </script>
          </td>
      </tr>
      <tr>
          <td>&nbsp;</td>
           <td>&nbsp;</td>
          <!--
          <td>Jumlah : <?php //echo $jumlah; ?></td>
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