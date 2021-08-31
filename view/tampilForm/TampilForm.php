<?php
include_once './dao/TampilFormDao.php';
$tampilForm=new TampilFormDao();
$all = $tampilForm->getAllTampil();
$row=30;
//$hal=  isset($_GET['hal']) ? $_GET['hal'] :0;
$hal=  isset($_POST['cboPage']) ? $_POST['cboPage'] :0;
$jumlah = sizeof($all);
$max= ceil($jumlah/$row);
$allTampil = $tampilForm->getAllTampilPage($hal, $row);




$nomor=0;
?>
<script>
    function kirim(){
        document.forms["form1"].action="?page=BukaFile";
        document.forms["form1"].submit();
        return true;
    }
</script>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow">    
    <tr>
        <td width="839" colspan="5" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Setting | Access Form </b></td>
    </tr>
    <tr>
        <td colspan="3"><a href="?page=insertFile">Tambah Form</a></td>
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
      <td colspan="4"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr>
          <th width="30" scope="col">No</th>
          <th width="110" scope="col">Kode</th>
          <th width="305" scope="col">Url</th>
          <th width="181" scope="col">Nama Form</th>
          <th width="197" scope="col">Menu</th>
        </tr>
       
        <?php
        if($allTampil!=null){
        foreach ($allTampil as $value) {
                          $nomor++;
                          $id=$value->getKode();                   
                      ?>
        <tr <?php if(($nomor % 2) ==0){ echo 'style="background:#E2EBED;"';}else{echo 'style="background:#F0F0F0;"';}?>>
            <td><?php echo $nomor;?></td>
            <td><a href="?page=updateFile&Kode=<?php echo $value->getKode();?>"><?php echo $value->getKode();?></a></td>
            <td><?php echo $value->getUrl();?></td>
            <td><?php echo $value->getNamaForm();?></td>
            <td><?php echo $value->getMenu();?></td>
        </tr>
        <?php
        }
        }
        ?>
      </table></td>
    </tr>
    <tr>
      <td width="121">&nbsp;</td>
      <td width="205">&nbsp;</td>
      <td width="205">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
