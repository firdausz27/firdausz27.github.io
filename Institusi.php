<?php
include_once './db/DBConnection.php';
include_once './model/DasborAbs.php';
include_once './dao/PersonalOtorisasiDao.php';
$month=  date("F");
$otorisasidao=new PersonalOtorisasiDao();
$otorisasi = $otorisasidao->getOtorisasi($_SESSION['SES_LOGIN']);
if($otorisasi==NULL){
    $otorisasi[]=$_SESSION['SES_LOGIN'];
}
$listSiswa=implode("','",$otorisasi);
?>
<!DOCTYPE html>
    <style>
        #visi{
            width: 98%;
            float: left;
            background: url(./images/7AF2Qzt.png);
            height: auto;
            border: 1px solid #999;
            box-shadow: 0 1px 0 #999;
            border-radius: 0px;
            margin-top: 5px;
            margin-left: 0px; 
        }
        
        #misi{
            width: 98%;
            float: left;
            background: url(./images/7AF2Qzt.png);
            height: auto;
            border: 1px solid #999;
            box-shadow: 0 1px 0 #999;
            border-radius: 0px;
            margin-top: 5px;
            margin-left: 0px; 
        }
        
        #visi h4,#misi h4{
            text-align: center;
            color: #ccc;
            padding: 5px 0px 5px 0px;
            background: url(./images/headercontent.jpg);
            height: 20px;
            width: 100%;
        }
        
        #visi #content, #misi #content{
            padding-left: 20px;
            padding-right: 20px;
            text-align: justify;
            text-spacing:space-adjacent;
            font: 12px Arial,Helvetica, sans-serif;
            font-size: 15px;
            margin-bottom: 5px;
        }
    </style>
<body>
    <!--<div id="slider"style="margin-top: 5px;margin-bottom: 5px;"><img src="images/DM.jpg" width="100%" height="100%"></div>-->
    <table width="100%" height="100%" cellpadding="0" cellspacing="0">
        <tr valign="top">
            <td style="width: 50%">
                <div id="visi">
                    <h4>Visi</h4>
                    <div id="content">
                        <hr color="#ccc">
                            <table>
                                <tr align="left">
                                    <?php if($institusiEmp !=NULL){
                                        echo '<td>'.$institusiEmp->getVisi().'</td>';
                                    }else{
                                        echo '<td align="center">--------o0o---------- </td>';
                                    }
                                    ?>
                                </tr>
                            </table>
                    </div>
                </div>
            </td>
            <td style="width: 50%">
                <div id="misi">
                    <h4>Misi</h4>
                    <div id="content">
                        <hr color="#ccc">
                         <table>
                                <tr align="center">
                                    <td >
                                       <?php if($institusiEmp !=NULL){
                                            echo '<td>'.trim($institusiEmp->getMisi()).'</td>';
                                        }else{
                                            echo '<td align="center">--------o0o---------- </td>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td style="width: 50%">
                <div id="Ikhwan-abs">
                    <h4>Ikhwan ABS Bulan(<?php echo $month;?>)</h4>
                        <table width="100%" heigt="100%" class="table-list">
                            <tr>
                                <th width="8%">No</th>
                                <th width="55%">Nama</th>
                                <th width="11%">Jumlah</th>
                            </tr>
                            <?php
                            $absesnsi = getAbsesnsi(1,date("m"),$listSiswa);
                                if($absesnsi!=NULL){
                                $no=0;
                                foreach ($absesnsi as $value){
                                    $no++;
                                    $personalId=$value->getPersonalId();
                            ?>
                            <tr>
                                <td width="8%"><?php echo $no;?></td>
                                <td width="55%"><a href='#' onclick='window.open("./PopupAbs.php?kode=<?php echo $personalId;?>","Laporan","resizable=1, width=780, height=500")' style="color: #000088"><?php echo $value->getNama();?></a></td>
                                <td width="11%"><?php echo $value->getJumlah();?></td>
                            </tr>
                            <?php
                                }
                            }else{
                            ?>
                            <tr>
                                <td colspan="3" align="center">------o0o-------</td>
                            </tr>
                            <?php } ?>
                        </table>
                </div>
            </td>
            <td style="width: 50%">
                <div id="Akhwat-abs">
                    <h4>Akhwat ABS Bulan(<?php echo $month;?>)</h4>
                        <table width="100%" heigt="100%" class="table-list">
                            <tr>
                                <th width="8%">No</th>
                                <th width="55%">Nama</th>
                                <th width="11%">Jumlah</th>
                            </tr>
                            <?php
                            $absesnsi = getAbsesnsi(2,date("m"),$listSiswa);
                                if($absesnsi!=NULL){
                                $no=0;
                                foreach ($absesnsi as $value){
                                    $no++;
                                    $personalId=$value->getPersonalId();
                            ?>
                            <tr>
                                <td width="8%"><?php echo $no;?></td>
                                <td width="55%"><a href="#" onclick='window.open("./PopupAbs.php?kode=<?php echo $personalId;?>","Laporan","resizable=1, width=780, height=500")' style="color: #000088"><?php echo $value->getNama();?></a></td>
                                <td width="11%"><?php echo $value->getJumlah();?></td>
                            </tr>
                            <?php
                                }
                            }else{
                            ?>
                            <tr>
                                <td colspan="3" align="center">------o0o-------</td>
                            </tr>
                            <?php } ?>
                        </table>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>