<?php
include_once './dao/KeuanganKasDao.php';
$kategoriDa=new KeuanganKasDao();
$allKaryawanPage = $kategoriDa->getAllKas();
$nomor=0;
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet" type="text/css">    
        <script>
            function validasi(){
                var field=document.getElementById("cboCari").value;
                var text=document.getElementById("txtCari").value;
                if(field==="blank"){
                    alert("Field pencarian belum dipilih !");
                    return false;
                }else if(text===""){
                    alert("Text Pencarian masih kosong !");
                }else{
                    document.forms["fKas"].action="?page=KasKeuanganForm";
                    document.forms["fKas"].submit();
                    return true;
                }
            }
            
            
        </script>
    </head>
    <body>
    <form name="fKas" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">    
            <tr>
                <td width="100%" colspan="4" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Laporan | Kas </b></td>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                          <th width="6%" >No</th>
                          <th width="16%" >Kode</th>
                          <th width="54%" >Nama</th>
                          <th width="24%" style="text-align: right;">Jumlah</th>
                        </tr>
                  
                  <?php
                      foreach ($allKaryawanPage as $value) {
                          $nomor++;
                          $id=$value->getKode();                   
                      ?>
                  <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
                    <td><?PHP echo $nomor;?></td>
                    <td><?PHP echo $value->getKode();?></td>
                    <td><?PHP echo $value->getNamaKas()?></td>                   
                    <td align="right">Rp <?PHP echo number_format($value->getJumlah());?></td>
                    </tr>
                  <?php } ?>
              </table>
          </td>
        </tr>
      <tr>
          <td colspan="4"></td>
      </tr>
      <tr>
          <td></td>
          <td><input type="button" value="Print" name="bPrint" onclick='window.open("./view/laporan/keuangan_kas/PrintKas.php","Laporan","resizable=1, width=950, height=600")'/></td>
          <td></td>
          <td></td>
      </tr>
      <tr height="20">
          <td colspan="4"></td>
      </tr>
    </table>
    </form>
    </body>
</html>