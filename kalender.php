<html>
<head>
<style>
table.tblkal {border-collapse:collapse;font-size:13pt;
color:black;font-family:verdana}
a.tgl{color:#888;text-decoration:none}
td.nhari{color:white}
</style>
</head>
<body>
<?php

//mysql_connect("localhost","root","ROOT");
//mysql_select_db("test");

$day[0] = "Sunday";
$day[1] = "Monday";
$day[2] = "Tuesday";
$day[3] = "Wednesday";
$day[4] = "Thursday";
$day[5] = "Friday";
$day[6] = "Saturday";

$day["Sunday"] = 0;
$day["Monday"] = 1;
$day["Tuesday"] = 2;
$day["Wednesday"] = 3;
$day["Thursday"] = 4;
$day["Friday"] = 5;
$day["Saturday"] = 6;

$bulan = date("n");
$thisbulan = date("F");
$bulanini = date("m");
$tanggal = date("j");
$hariini = date("l");
$hari = $day[$hariini];
$tahun = date("Y");
$tglevent=array();
/*
$query = mysql_query("select * from drzevent where month(tanggal)=$bulanini");
while($e=mysql_fetch_array($query)){
    $tglevent[] = $e['tanggal'];
    $judulacara[] = $e['acara']." jam : ".$e['waktu'];
}
*/
switch($bulan){
    case 1 : $jhari = 31; break;
    case 2 :
        $sisa = $tahun%4;
        if(!$sisa){
            $jhari = 29;
        }else{
            $jhari = 28;
        }
    break;
    case 3 : $jhari = 31; break;
    case 4 : $jhari = 30; break;
    case 5 : $jhari = 31; break;
    case 6 : $jhari = 30; break;
    case 7 : $jhari = 31; break;
    case 8 : $jhari = 31; break;
    case 9 : $jhari = 30; break;
    case 10 : $jhari = 31; break;
    case 11 : $jhari = 30; break;
    case 12 : $jhari = 31; break;
}

//kode untuk mencari hari pada tanggal 1
//---------------------
$t1 = 1-($tanggal%7);
$tanggal1 = $t1+$hari;
if($tanggal1<0){
    $tanggal1=$tanggal1+7;
}
$hari1 = $day[$tanggal1];
if($tanggal1==0 || $tanggal1==1 || $tanggal1==2 || $tanggal1==3 || $tanggal1==4){
    $jbaris = 5;
}else{
    $jbaris = 6;
}
//----------------------
?>
<table border=1 bordercolor="#ababab" class=tblkal
cellpadding=3 cellspacing=1>
    <h4 style=" text-align: center;
            color: #ccc;
            padding: 5px 0px 5px 0px;
            background: url(./images/headercontent2.jpg);
            height: 15px;
            width: 100%;"><b>KALENDER</B>(<?php echo "$thisbulan-$tahun";?>)</h4>
    <!--<tr ><td bgcolor=#04421b colspan=7 style="height: 10px;"><font color=white style="font-size: small;"><b>KALENDER</B>
(<?php echo "$thisbulan-$tahun";?>)</td></tr>-->
<tr>
    <td width="14%" valign="middle" bgcolor="#888" class=nhari><b>S</b></td>
    <td width="14%" valign="middle" bgcolor="#888" class=nhari><b>M</b></td>
    <td width="14%" valign="middle" bgcolor="#888" class=nhari><b>T</b></td>
    <td width="14%" valign="middle" bgcolor="#888" class=nhari><b>W</b></td>
    <td width="14%" valign="middle" bgcolor="#888" class=nhari><b>T</b></td>
    <td width="15%" valign="middle" bgcolor="#888" class=nhari><b>F</b></td>
    <td width="15%" valign="middle" bgcolor="#888" class=nhari><b>S</b></td>


</tr>
<?php
//kode untuk menampilkan tanggal dalam bentuk tabel
//-------------------------------------------------
$dayi = 0;
$dayx = 1;
for($i=0;$i<$jbaris;$i++){
    echo "<tr>";
    for($j=0;$j<7;$j++){
        if($j==0){
                $bgcolor="#999";
            }else{
                $bgcolor="#ccc";
        }
        if($dayi>=$day[$hari1]&&$dayx<=$jhari){
            if($dayx<10){
                $dayx2 = "0".$dayx;
            }else{
                $dayx2 = $dayx;
            }
            $date = "$tahun-$bulanini-$dayx2";
            $k=0;
            $class = "normal";
            $title = "";
			/*if($tglevent!=null){
            while($k<count($tglevent)){
                if($date==$tglevent[$k]){
                    $class = "event";
                    $bgcolor = "lightblue";
                    $title = $judulacara[$k];
                    break;
                }
                $k++;
            }
			}*/
            if($dayx==$tanggal){
                echo "<td bgcolor=#04421b><b><a title=\"$title\"
                class=tgl href=kalender.php?tgl=$date>$dayx</a></b></td>";
            }else{
                echo "<td bgcolor=$bgcolor><a title=\"$title\"
                class=tgl href=kalender.php?tgl=$date>$dayx</a></td>";
            }
            $dayx++;
        }else{
            echo "<td bgcolor=$bgcolor> </td>";
        }
        $dayi++;
    }
    echo "</tr>";
}
//-------------------drz---------------------------:)
?>
</table>
<!--<hr>-->
<?php
//$tgl = isset ($_GET['tgl']) ? 
/*$acara = mysql_query("select * from drzevent where tanggal='$tgl'");
while($a=mysql_fetch_array($acara)){
    echo "Acara : ". $a['acara']."<br>";
    echo "Tanggal : ". $a['tanggal']."<br>";
    echo "Tempat : ". $a['tempat']."<br>";
}*/
?>
