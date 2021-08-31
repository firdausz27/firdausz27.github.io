
<! DOCTYPE html>
<html>
<head>
    <script>
        function popupwindow(url, title, w, h) {
              var left = (screen.width/2)-(w/2);
              var top = (screen.height/2)-(h/2);
              window.open(url, title, 'toolbar=no, locat  scrollbars=1, width='+w+', height='+h+', top='+top+', left='+left);
          }
        function validasi(){
            var pilihan=document.getElementById("cboLaporan").value;
            if(pilihan=="blank"){
                alert("Jenis laporan belum dipilaih !");
                return false;
            }else{
                var w=950;
                var h=600;
                var left = (screen.width/2)-(w/2);
                var top = (screen.height/2)-(h/2);
                document.forms["fJadual"].target="DoSubmit"
                if(pilihan==1){
                    document.forms["fJadual"].action="./view/laporan/pendidikan_pelajaran/AllPelajaran.php"
                    DoSubmit=window.open('about:blank','DoSubmit','scrollbars=1,status=1,resizable=1, width='+w+', height='+h+', top='+top+', left='+left)
                    return true;
                }else if(pilihan==2){
                    document.forms["fJadual"].action="./view/laporan/pendidikan_jadual/Jadual.php"
                    DoSubmit=window.open('about:blank','DoSubmit','scrollbars=1,status=1,resizable=1, width='+w+', height='+h+', top='+top+', left='+left)
                    return true;
                }else if(pilihan==3){
                    document.forms["fJadual"].action="./view/laporan/pendidikan_jadual/Pengajar.php"
                    DoSubmit=window.open('about:blank','DoSubmit','scrollbars=1,status=1,resizable=1, width='+w+', height='+h+', top='+top+', left='+left)
                    return true;
                }
                
            }
        }
    </script>
</head>
<body>
<form name="fJadual" id="fJadual" method="post" target="">
    <table width="100%" border="0" cellspacing="1" cellpadding="5" 
           style="border: 2px solid #999; 
           border-radius: 3px;
           border-bottom: none;
           box-shadow: 0 1px 0 #999;
           " background="./images/7AF2Qzt.png">
    <tr>
        <tr>
           <td colspan="1" align="left" style="background: url(./images/headercontent2.jpg); font-size: 13px; color: #fff;"><!--<img src="./images/form_add.png">-->&nbsp;<b>Laporan | Pendidikan</b></td>
        </tr>
        <td>
            <form id="fJadual" name="fJadual" method="post">
            <table width="100%" border="0" cellspacing="1" cellpadding="5">
            
            <tr>
              <td width="24">&nbsp;</td>
              <td width="128">&nbsp;</td>
              <td width="4">&nbsp;</td>
              <td width="789">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Jenis Laporan </td>
              <td>:</td>
              <td>
                  <select name="cboLaporan" id="cboLaporan">
                    <option value="blank" selected>- All -</option>
                    <option value="1">Laporan Daftar Kajian</option>
                    <option value="2">Laporan Jadual Kajian</option>
                    <option value="3">Laporan Daftar Penagajar</option>
                  </select>
              </td>
            </tr>
            <tr>
                <td colspan="4"><hr width="90%" color="#ccc"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" name="Print" value="Print" onclick="validasi();">
                  <input type="reset" value="Reset">
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            </table>
            </form >
    </tr>
    </table>
</form>
</body>
</html>
