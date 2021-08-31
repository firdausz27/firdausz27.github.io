
<! DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../css/style.css" type="text/css"/>
    <script>    
        function validasi(){
            var txtEmail=document.getElementById("txtEmail").value;
            var x = document.getElementById("txtEmail").value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            
            if(txtEmail==""){
                alert("Email harus diisi !");
                document.getElementById("txtEmail").focus();
            }else  if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                alert("Email salah !");
                document.getElementById("txtEmail").focus();
            }else{
                document.forms["fNegara"].submit();
                return true;
            }
        }
    </script>
</head>
<body>
    <form id="fNegara" name="fNegara" method="post"  action="../../action/GetPasswordAction.php">
    <table width="62%" border="0" cellspacing="1" cellpadding="5">
    <tr>
        <td colspan="4" align="left" class="title-form"><img src="../../images/application_side_list.png">&nbsp;<b>Lupa Password </b></td>
    </tr>
    <tr>
      <td width="70">&nbsp;</td>
      <td width="122">&nbsp;</td>
      <td width="4">&nbsp;</td>
      <td width="515">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Email</td>
      <td>:</td>
      <td>
      <input name="txtEmail" type="text" id="txtEmail" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td colspan="4"><hr width="90%" color="#ccc"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td ><input type="button" name="bSimpan" id="bSimpan" value="Prosess" onClick="validasi();" />
        <input type="reset" name="bReset" id="bReset" value="Reset" /></td>
    </tr>
   <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
