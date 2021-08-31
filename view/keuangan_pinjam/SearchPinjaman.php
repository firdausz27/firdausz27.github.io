<?php
include_once '../../db/DBConnection.php';
include_once '../../model/Personal.php';
include_once '../../model/KeuanganPinjam.php';
include_once '../../model/KeuanganPinajmDetail.php';
function getAllPinjam($hal,$row){
        $listpinjam=array();
        $sql="select keuangan_pinjam.id_pinjam,
            keuangan_pinjam.tgl_pinjam,
            keuangan_pinjam.tgl_kembali,
            keuangan_pinjam.kas_id,
            keuangan_pinjam.personal_id,
            personal.nama_awal, personal.nama_tengah,personal.nama_akhir,
            keuangan_pinjam.jumlah,
            keuangan_pinjam_detail.total_pinjam,
            keuangan_pinjam_detail.sisa_pinjam,
            keuangan_pinjam_detail.kredit_pinjam
            from keuangan_pinjam 
            inner join keuangan_pinjam_detail 
            on (keuangan_pinjam.id_pinjam=keuangan_pinjam_detail.id_pinjam)
            inner join personal on(keuangan_pinjam.personal_id=personal.id_siswa)
            where keuangan_pinjam.status='p' 
            and keuangan_pinjam_detail.status=1 limit $hal,$row";
        $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
        
        while ($dataRow=  mysql_fetch_array($dataQry)){ 
          $pinajm=new KeuanganPinjam();
          $pinajm->setJumlah($dataRow['jumlah']);
          $pinajm->setKas($dataRow['kas_id']);
          $pinajm->setKode($dataRow['id_pinjam']);
          //$pinajm->setPersonal($dataRow['personal_id']);
          $pinajm->setStatus("p");
          $pinajm->setTglKembali($dataRow['tgl_kembali']);
          $pinajm->setTglPinjam($dataRow['tgl_pinjam']);
          //untuk mendapatkan personal data
          $personal=new Personal();
          $personal->setIdPersonal($dataRow['personal_id']);
          $personal->setNamaAwal($dataRow['nama_awal']);
          $personal->setNamaTengah($dataRow['nama_tengah']);
          $personal->setNamaAkhir($dataRow['nama_akhir']);
          $pinajm->setPersonal($personal);
          //untuk memanggil pinjam detail
          $pinjamDetail=new KeuanganPinajmDetail();
          $pinjamDetail->setIdPinjam($dataRow['id_pinjam']);
          $pinjamDetail->setKreditPinjam($dataRow['kredit_pinjam']);
          $pinjamDetail->setSisaPinjam($dataRow['sisa_pinjam']);
          $pinjamDetail->setTotalPinajm($dataRow['total_pinjam']);
          $pinajm->setPinjamDetail($pinjamDetail);
          $listpinjam[]=$pinajm;
        }
        return $listpinjam;
    }
    
function getCariPinjam($field, $text){
        $listpinjam=array();
        $sql="select keuangan_pinjam.id_pinjam,
            keuangan_pinjam.tgl_pinjam,
            keuangan_pinjam.tgl_kembali,
            keuangan_pinjam.kas_id,
            keuangan_pinjam.personal_id,
            personal.nama_awal, personal.nama_tengah,personal.nama_akhir,
            keuangan_pinjam.jumlah,
            keuangan_pinjam_detail.total_pinjam,
            keuangan_pinjam_detail.sisa_pinjam,
            keuangan_pinjam_detail.kredit_pinjam
            from keuangan_pinjam 
            inner join keuangan_pinjam_detail 
            on (keuangan_pinjam.id_pinjam=keuangan_pinjam_detail.id_pinjam)
            inner join personal on(keuangan_pinjam.personal_id=personal.id_siswa)
            where keuangan_pinjam.status='p' 
            and keuangan_pinjam_detail.status=1 
            and  $field like '%$text%'";
        $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $pinajm=new KeuanganPinjam();
          $pinajm->setJumlah($dataRow['jumlah']);
          $pinajm->setKas($dataRow['kas_id']);
          $pinajm->setKode($dataRow['id_pinjam']);
          //$pinajm->setPersonal($dataRow['personal_id']);
          $pinajm->setStatus("p");
          $pinajm->setTglKembali($dataRow['tgl_kembali']);
          $pinajm->setTglPinjam($dataRow['tgl_pinjam']);
          //untuk mendapatkan personal data
          $personal=new Personal();
          $personal->setIdPersonal($dataRow['personal_id']);
          $personal->setNamaAwal($dataRow['nama_awal']);
          $personal->setNamaTengah($dataRow['nama_tengah']);
          $personal->setNamaAkhir($dataRow['nama_akhir']);
          $pinajm->setPersonal($personal);
          //untuk memanggil pinjam detail
          $pinjamDetail=new KeuanganPinajmDetail();
          $pinjamDetail->setIdPinjam($dataRow['id_pinjam']);
          $pinjamDetail->setKreditPinjam($dataRow['kredit_pinjam']);
          $pinjamDetail->setSisaPinjam($dataRow['sisa_pinjam']);
          $pinjamDetail->setTotalPinajm($dataRow['total_pinjam']);
          $pinajm->setPinjamDetail($pinjamDetail);
          $listpinjam[]=$pinajm;
        }
        return $listpinjam;
    }
    
    function getCountKeuangan(){
        $jumlah=0;
        $sql="select count(*) as jumlah from keuangan_pinjam where status='p'";
        $dataQry  =  mysql_query($sql, DBConnection::getConnection())or die("Query error :".  mysql_error());
        while ($dataRow=  mysql_fetch_array($dataQry)){  
          $jumlah=$dataRow['jumlah'];
        }
        return $jumlah;
    }
    
    function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$bln/$tgl/$thn";
	return $tanggal;
}
$allPinajm=array();   
$row=50;
//$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$hal=  isset($_POST['cboPage']) ? $_POST['cboPage'] :0;
$jumlah = getCountKeuangan();
$max= ceil($jumlah/$row);
$allPinajm =getAllPinjam($hal, $row);
//echo sizeof($allPinajm);
$nomor=0;
$field='';
$text='';
if($_POST){
    $field=  isset($_POST['cboCari']) ? $_POST['cboCari'] :'';
    $text= isset($_POST['txtCari']) ? $_POST['txtCari'] : '';
    if($_POST['cboCari'] != 'blank' || $text !=''){
        $allPinajm=getCariPinjam($_POST['cboCari'], $_POST['txtCari']);
    }
}
 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Karyawan</title>
        <link href="../../css/style.css" rel="stylesheet" type="text/css">  
        <script>
            function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '')
              .replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
              prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
              sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
              dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
              s = '',
              toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                  .toFixed(prec);
              };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
              .split('.');
            if (s[0].length > 3) {
              s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '')
              .length < prec) {
              s[1] = s[1] || '';
              s[1] += new Array(prec - s[1].length + 1)
                .join('0');
            }
            return s.join(dec);
          }
          
            function changeparent(doc,doc2,a,b,c){
                    var input1=doc;
                    var input2=doc2;
                    window.opener.document.getElementById('txtPinjamId').value=input1;
                    window.opener.document.getElementById('txtNamaK').value=input2;
                    window.opener.document.getElementById('totPinjam').value=number_format(a);
                    window.opener.document.getElementById('sisa').value=number_format(b);
                    window.opener.document.getElementById('credit').value=number_format(c);
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
                    document.forms["fPinjamCari"].action;
                    document.forms["fPinjamCari"].submit();
                    return true;
                }
            }
            
            function kirim(){
                document.forms["fPinjamCari"].action="?./view/keuangan_pinjam/SearchPinjaman.php";
                document.forms["fPinjamCari"].submit();
                return true;
            }
        </script>
    </head>
    <body style="margin-left: 0px; margin-top: 0px;">
    <form name="fPinjamCari" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow" >    
            <tr>
                <td colspan="9" align="left" class="title-form"><img src="../../images/application_side_list.png" ">&nbsp;<b>Cari | Personal Data </b></td>
            </tr>
            <tr>
            	<td width="567">Cari 
            	  <select name="cboCari" id="cboCari">
                    <option value="blank" selected>- All -</option>
                    <option value="keuangan_pinjam.id_pinjam" <?php if($field=='keuangan_pinjam.id_pinjam') echo 'selected=""';?> >Kode Pinajm</option>
                    <option value="nama_awal" <?php if($field=='nama_awal') echo 'selected=""';?>>Nama Awal</option>
                    <option value="nama_tengah" <?php if($field=='nama_tengah') echo 'selected=""';?>>Nama tengah</option>
                    <option value="nama_akhir" <?php if($field=='nama_akhir') echo 'selected=""';?>>Nama Akhir</option>
                  </select>
            	  Kata Kunci
                  <input type="text" name="txtCari" id="txtCari" value="<?php echo $text;?>">
              <input type="button" name="bCari" id="bCari" value="Cari" onClick="validasi();"></td>
            </tr>
            <tr>
              <td colspan="1"></td>
              <td width="636" colspan="2" align='right'>Halamam <select name="cboPage" onChange="kirim();">
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
                          <th width="100">Kode Pinjaman</th>
                          <th width=200>Nama Peminjam</th>
                          <th style="text-align: right;" width="150">Jumlah Pinjam</th>
                          <th width="50">Tgl Pinjam</th>
                          <th width="50">Tgl Kembalikan</th>
                        </tr>
                  
                  <?php
                      foreach ($allPinajm as $value) {
                          $nomor++;
                          $id=$value->getKode();
                          $nama=$value->getPersonal()->getNamaAwal()." " .$value->getPersonal()->getNamaTengah()." ".$value->getPersonal()->getNamaAkhir();
                          $total=$value->getJumlah();
                          $sisa=$value->getPinjamDetail()->getSisaPinjam();
                          $crdit=$value->getPinjamDetail()->getKreditPinjam();
                          
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?> onClick="javascript:changeparent('<?php echo $id; ?>','<?php echo $nama; ?>','<?php echo $total; ?>','<?php echo $sisa; ?>','<?php echo $crdit; ?>');">
                    <td><?PHP echo $nomor;?></td>
                    <td><?PHP echo $value->getKode();?></td>
                    <td><?PHP echo $value->getPersonal()->getNamaAwal()." " .$value->getPersonal()->getNamaTengah()." ".$value->getPersonal()->getNamaAkhir();?></td>    
                    <td align="right">Rp <?PHP echo number_format($value->getJumlah()); ?></td>
                    <td><?PHP echo IndonesiaTgl($value->getTglPinjam());?></td>
                    <td><?PHP echo IndonesiaTgl($value->getTglKembali());?></td>
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

        </script>          </td>
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