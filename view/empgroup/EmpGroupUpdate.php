<?php
include_once './dao/EmpGroupDao.php';
$tgl=  date("m/d/Y");
if(isset($_GET['Kode'])){
    $kode=$_GET['Kode'];
}

$groupDao=new EmpGroupDao();
$group=new Group();
$group = $groupDao->getGroup($kode);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Karyawan</title>
        <script>          
            function validasi(mode){
                var txtName=document.getElementById("txtName").value;
                var txtTgl=document.getElementById("txtTgl").value;
                if(txtName==""){
                    alert("Nama Masih Kosong !");
                    document.getElementById("txtName").focus();
                    //return false;
                }else if(txtTgl==""){
                    alert("Tanggal Masih Kosong !");
                    document.getElementById("txtTgl").focus();
                }else{
                    if(mode=='update'){
                        document.forms["fGroup"].action="?page=EmpGroupAction&action=update";
                        document.forms["fGroup"].submit();
                        return true;
                    }else{
                        if(confirm('Apakah anda yakin mau menghapus ?')){
                            document.forms["fGroup"].action="?page=EmpGroupAction&action=delete";
                            document.forms["fGroup"].submit();
                            return true;
                        }
                    }
                }
            }
            
            function geroupData(){
                document.forms["fGroup"].action="?page=AddEmpPersonal";
                document.forms["fGroup"].submit();
                return true;
            }
            
             function geroupEmp(){
                document.forms["fGroup"].action="?page=addEmpAdmin";
                document.forms["fGroup"].submit();
                return true;
            }
        </script>
    </head>
    <body style="margin-left: 0px; margin-top: 0px;">
        <form name="fGroup" method="post">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow" >    
            <tr>
                <td colspan="4" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Edit Group </b></td>
            </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
            </tr>
            <input type="hidden" name="kode" value="<?php echo $group->getKode();?>" />
            <tr>
                <td width="4%">&nbsp;</td>
                <td width="13%">Nama Group </td>
                <td width="1%">:</td>
                <td width="82%"><input name="txtName" id="txtName" type="text" size="50" maxlength="100" value="<?php echo $group->getNamaGroup();?>"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Tanggal</td>
                <td>:</td>
                <td> 
                    <?php
                    $tgl=  IndonesiaTgl($group->getTglDibuat());
                    echo form_tanggal("txtTgl",$tgl); 
                    ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Keterangan</td>
                <td>:</td>
                <td><input type="text" name="txtKeterangan" value="<?php echo $group->getKeterangan();?>" size="50" maxlength="200"/></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="button" value="Admin Group Personal" name="bGroupUser" onclick="geroupEmp();"/>
                    <input type="button" value="Group Personal" name="bGroupData" onclick="geroupData();"/>
                    <input type="button" value="Simpan" name="bInsert" onclick="validasi('update');"/>
                    <input type="button" value="Delete" name="bInsert" onclick="validasi('delete');"/>
                    <input type="reset" value="Reset" name="bReset" />                
                </td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
        </table>
    </form>
    </body>
</html>