
<center>
        <?php
                //require ("config.php");
                include_once './db/DBConnection.php';
                // querynya kaya gini..kalo ada yang bisa simple..silahkan diubah :D
                $query_pria   = mysql_query("SELECT * FROM  `personal` WHERE kelamin = 1",  DBConnection::getConnection());
                $query_wanita = mysql_query("SELECT * FROM  `personal` WHERE kelamin = 2", DBConnection::getConnection());

                // kita itung jumlah baris yang ada dari hasil query diatas
                $totalPria   = mysql_num_rows($query_pria);
                $totalWanita = mysql_num_rows($query_wanita);
        ?>
        <script class="code" type="text/javascript">
        $(document).ready(function(){
                // kita masukkan jumlah total ditas kemari
            plot1 = $.jqplot('pie', [[['Akhwat',<?php echo $totalWanita; ?>],['Ikhwan', <?php echo $totalPria; ?>]]], {
                gridPadding: {top:0, bottom:38, left:0, right:0},
              seriesDefaults:{renderer:$.jqplot.PieRenderer, trendline:{show:false}, rendererOptions: { padding: 20, showDataLabels: true}},
                          legend:{
                              show:true, 
                              placement: 'outside', 
                              rendererOptions: {
                                  numberRows: 1
                              }, 
                              location:'s',
                              marginTop: 'none'
                          }       
            });
        });
        </script>
        <h4 style=" text-align: center;
            color: #ccc;
            padding: 5px 0px 5px 0px;
            background: url(./images/headercontent2.jpg);
            height: 15px;
            width: 100%;">Perbandingan Santri Ikhwan Dan Akhwat</h4>
        <div id="pie" style="width:300px; height:300px; "></div>
</center>
