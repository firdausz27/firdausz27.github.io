
<head>
  <style type="text/css">
    body {
      background: #fff;
    }

    .table-common tr td p input {
      text-align: right;
    }

    .table-common tr th {
      text-align: center;
    }

    #form-login {
      /*margin-left: 50%;*/
      margin-top: 1%;
      height: 220px;
      width: 400px;
    }

    #logo {
      height: 85px;
      width: 300px;
      background: url(./img/logo.png) no-repeat;
      /* margin-left: 25%;*/
      margin-top: 10%;
      /*float: left;*/
      text-align: center;
    }

    #license {
      margin-top: 10%;
    }

    #badan {
      background: #fff url(./img/background.jpg) no-repeat;
      padding: 0;
      margin: 0;
    }
  </style>
  <script>
    function validasi() {
      var username = document.getElementById("txtUser").value;
      var password = document.getElementById("txtPassword").value;
      if (username === "") {
        alert("Username masih kosong");
        document.getElementById("txtUser").focus();
      } else if (password === "") {
        alert("Password masih kosong !");
        document.getElementById("txtPassword").focus();
      } else {
        document.forms["logForm"].method = "post";
        document.forms["logForm"].action = "./action/LoginAction.php";
        document.forms["logForm"].submit();
        return true;
      }
    }
  </script>
  <link rel="shortcut icon" href="img/dm_logo.png" />
  <title>Login</title>
</head>

<body id="badan" onshow='document.getElementById("txtUser").focus();'>
  <center>
    <div id="logo">
    </div>
    <div id="form-login">
      <?php
      include_once 'library/Enkripsi.php';
      echo 'usr: daftar // pwd: ' . encrypt_decrypt('decrypt', 'ZEIBQ46FpqG/5otMzQTNy2bpy1HCCppC4Xa78SN+5Xc=');
      // echo '<br>usr : firdaus || decrypt: ' . encrypt_decrypt('decrypt', 'YrOQHlWf4buvBBQc6lYIz74RPVPt79RNm6QPbaKPyKw=');
      ?>
      <form name="logForm" onsubmit="validasi(); return false;">
        <table border="0" cellpadding="3" cellspacing="1" style="border: 1px solid #999; border-radius: 3px;box-shadow: 0 2px 0 #999; 
               background: url(./images/7AF2Qzt_2.png); 
               padding: 0;
               margin: 0; 
               height: 220px;
               width: 420px;">
          <tr>
            <th colspan="4">
              <h3><b>Sistem Manajemen Pondok Pesantren</b>
                <h3>
                  </td>
          </tr>
          <tr>
            <td width="16">&nbsp;</td>
            <td width="84"><b>Username</b></td>
            <td width="5">:</td>
            <td width="227"><b>
                <input name="txtUser" id="txtUser" type="text" size="30" maxlength="20" />
              </b></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><b>Password</b></td>
            <td>:</td>
            <td><b>
                <input name="txtPassword" id="txtPassword" type="password" size="30" maxlength="20" />
              </b></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
            <td>
              <p>
                <input type="submit" name="btnLogin" value=" Login " />
                <input type="reset" name="bReset" id="bReset" value="Reset" />
              </p>
            </td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
            <td align="left"><a href="#" onclick='window.open("./view/lupa_password/GetPassword.php","Laporan","resizable=1, width=450, height=200")' style="text-decoration: none;">
                <font style="color: blue; font-size: medium;">Lupa Password </font>
              </a></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
            <td align="right">
              <!-- <font style="color: #999; font-size: small;">Trial Version </font> -->
            </td>
          </tr>
        </table>
      </form>
  </center>
  </div>
  <center>
    <div id="license">
      <label style="color: #333">&copy; Ma'had Daarul Muwahhid 2014. All Rights Reserved</label>
    </div>
  </center>
</body>