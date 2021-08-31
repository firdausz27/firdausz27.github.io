
<!--<input type="button" value="Add" style="margin-left: 30px;margin-top: 30px;" onclick="popupwindow('./view/menu/MenuInsert.php?parent=0','Tambah Menu',800,300)">--> 
<?php
include_once './model/Menu.php';
//untuk mendapatkan kode
$kode=isset($_POST['kode']) ? $_POST['kode'] : '';
//untuk mendapatkan menu yang sudah aktif
$listMenu=array();
$sqlMenu="select * from group_menu where group_id=$kode";
$qryMenu=mysql_query($sqlMenu,DBConnection::getConnection());
while($row = mysql_fetch_array($qryMenu)){
    $listMenu[]=$row['menu_id'];
}
function createTreeViewOto($array, $currentParent, $currLevel = 0, $prevLevel = -1) {
    $i=1;
    global $listMenu;
    foreach ($array as $categoryId => $category) {
        
        if ($currentParent == $category['parent']) {                       
            if ($currLevel > $prevLevel) echo " <ol class='tree' style='background: none;'> "; 

            if ($currLevel == $prevLevel) echo " </li> ";
            /* remark untuk test
            if($category['status']==1){
                echo '<li><label for="'.$category['menu_id'].'">'.$category['nama'].'</label><input type="checkbox" name="'.$category['menu_id'].'" value="ON" checked/>';
            }else{
                echo '<li class="file"><a href="#" style="background: none;">'.$category['nama'].'<input type="checkbox" name="'.$category['menu_id'].'" value="ON" /></a></li>';
            }
           */
            if($category['status']==1){
            ?>
                <li><label style="margin-left: 20px;" for="<?php echo $category['menu_id']; ?>"><?php echo $category['nama']; ?></label><input type="checkbox" name="<?php echo $category['menu_id']; ?>" value="ON" <?php if(in_array($category['menu_id'], $listMenu)) echo 'checked'; ?>/>
            <?php
            }else{
            ?>
                <li class="file"><a href="#" style="background: none;"><?php echo $category['nama']; ?><input type="checkbox" name="<?php echo $category['menu_id']; ?>" value="ON" <?php if(in_array($category['menu_id'], $listMenu)) echo 'checked'; ?>/></a>
           <?php
            }
            
            if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }

            $currLevel++; 

            createTreeViewOto ($array, $categoryId, $currLevel, $prevLevel);

            $currLevel--;               
        }   
        $i++;
    }

    if ($currLevel == $prevLevel) echo " </li>  </ol> ";

}

?>
<head>
    <link rel="stylesheet" type="text/css" href="treeStyle.css" media="screen">
</head>
<body>
    <form method="post" action="?page=MenuAction">
      <table  width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <td colspan="2"align="left" style="background: url(./images/headercontent2.jpg); font-size: 15px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Setting | Access Menu</b></td>
    </tr>
          <tr>
              <input type="hidden" name="kode" value="<?php echo $kode;?>" />
              <td width="50">&nbsp;</td>
              <td>
                <link rel="stylesheet" type="text/css" href="treeStyle.css" media="screen">
                <?php

                $qry="SELECT * FROM menu";
                $result=mysql_query($qry,DBConnection::getConnection());


                $arrayCategories = array();

                while($row = mysql_fetch_assoc($result)){ 
                    $arrayCategories[$row['menu_id']] = array("parent" => $row['parent'], "nama" =>                       
                    $row['nama'], "status"=>$row['status'], "menu_id"=>$row['menu_id']);   
                }
                ?>
                <div id="content" class="general-style1">
                <?php
                if(mysql_num_rows($result)!=0)
                {
                    ?>
                    <?php 

                    createTreeViewOto($arrayCategories, 0); ?>
                    <?php
                }
                ?>

                </div>
              </td>
        </tr>
        <tr>
            <td colspan="2"><hr width="95%" color="#ccc"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" value="Simpan" name="bSimpan" />
                <input type="reset" value="Reset" name="bReset" />
            </td>
        </tr>
        <tr height="50">
            <td colspan="2"></td>
        </tr>
      </table>
  </form>
</body>