<?php
include_once './db/DBConnection.php';
$tgl=  date("m/d/Y");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Karyawan</title>
        <script>          
            function validasi(){
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
                    document.forms["fGroup"].action;
                    document.forms["fGroup"].submit();
                    return true;
                }
            }
            
            function kirim(){
                //document.forms["fGroup"].action="?page=GroupAction&action=insert";
                document.forms["fGroup"].submit();
                return true;
            }
        </script>
    </head>
    <body style="margin-left: 0px; margin-top: 0px;">
        <form name="fGroup" method="post" action="?page=GroupAction&action=insert">
        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table-shadow" >    
            <tr>
                <td colspan="4" align="left" class="title-form"><img src="./images/application_side_list.png" ">&nbsp;<b>Input Group </b></td>
            </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td width="4%">&nbsp;</td>
                <td width="13%">Nama Group </td>
                <td width="1%">:</td>
                <td width="82%"><input name="txtName" id="txtName" type="text" size="50" maxlength="100"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Tanggal</td>
                <td>:</td>
                <td> 
                    <?php
                    echo form_tanggal("txtTgl",$tgl); 
                    ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Keterangan</td>
                <td>:</td>
                <td><input type="text" name="txtKeterangan" size="50" maxlength="200"/></td>
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
                <td>
                    <input type="button" value="Simpan" name="bInsert" onclick="validasi();"/>
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