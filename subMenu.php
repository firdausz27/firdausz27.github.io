<script>
function popupwindow(url, title, w, h) {
  var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    return window.open(url, title, 'toolbar=no, locat  ion=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<!--<input type="button" value="Add" style="margin-left: 30px;margin-top: 30px;" onclick="popupwindow('./view/menu/MenuInsert.php?parent=0','Tambah Menu',800,300)">--> 
<?php
function createTreeView($array, $currentParent, $currLevel = 0, $prevLevel = -1) {
    $i=1;
    foreach ($array as $categoryId => $category) {
        
        if ($currentParent == $category['parent']) {                       
            if ($currLevel > $prevLevel) echo " <ol class='tree'>"; 
            
           if ($currLevel == $prevLevel) echo " </li> ";
           if($category['status']==1){
               if($category['parent']==0 || $category['menu_id']==8){
                   $check="checked";
               }else{
                   $check="checked";
               }
                echo '<li class="'.$category['class'].'"><label  for="'.$category['menu_id'].'"><p>'.$category['nama'].'</p></label><input type="checkbox" style="opacity: 0;" name="'.$category['menu_id'].'" value="ON" '.$check.'/>';
            }else{
                echo '<li class="file"><a href="?page='.$category['nama_form'].'"><p>'.$category['nama'].'</p></a>';
            }
           
            if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }

            $currLevel++; 

            createTreeView ($array, $categoryId, $currLevel, $prevLevel);
            $currLevel--;               
        }   
        $i++;
    }

    if ($currLevel == $prevLevel) echo " </li></ol>";

}
?>
   <link rel="stylesheet" type="text/css" href="css/_styles.css" media="screen">
    <?php
    /*
    $qry="select menu.*,"
            . "tampil_form.nama_form "
            . "from menu inner join tampil_form "
            . "on(menu.form_id=tampil_form.form_id)";*/
    $sqlMenu="select group_menu.menu_id from `groupdata` inner join group_menu 
            on(group_menu.group_id=`groupdata`.id_group)
            inner join group_personal 
            on(`groupdata`.id_group=group_personal.group_id)
            where group_personal.personal_id='".$_SESSION['SES_LOGIN']."'";
    //echo $sqlMenu;
    $resultMenu=mysql_query($sqlMenu,DBConnection::getConnection());
    $arraymMenu = array();
    while($row = mysql_fetch_assoc($resultMenu)){ 
        $arraymMenu[]=$row['menu_id'];
    }
    if($arraymMenu!=''){
        $listMenu=implode("','",$arraymMenu);
        $qry="select menu.*,"
                . "tampil_form.nama_form "
                . "from menu inner join tampil_form "
                . "on(menu.form_id=tampil_form.form_id)"
                . "where menu.menu_id in('".$listMenu. "') ORDER BY menu.nama ASC";
        $result=mysql_query($qry,DBConnection::getConnection());


        $arrayCategories = array();

        while($row = mysql_fetch_assoc($result)){ 
            $arrayCategories[$row['menu_id']] = array("parent" => $row['parent'], "nama" =>                       
            $row['nama'], "status"=>$row['status'], "menu_id"=>$row['menu_id'], "nama_form"=>$row['nama_form'], "class"=>$row['class']);   
        }
        ?>
        <?php
        if(mysql_num_rows($result)!=0)
        {
            createTreeView($arrayCategories, 0); 
        }
    }
    ?>