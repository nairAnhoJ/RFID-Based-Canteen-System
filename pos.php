<?php
    session_start();

    include("./connection.php");

    $dateNow1 = date("Y-m-d");
    $strDate = strval($dateNow1);
    // $query_dup = "SELECT * FROM dup_status";
    // $dup_res = mysqli_query($con,$query_dup);

    date_default_timezone_set("Asia/Hong_Kong");

    // $row = mysqli_fetch_assoc($dup_res);
    // if($row['date_now'] != $strDate){
    //     $dupStat = "UPDATE dup_status SET dup_stat='NO', date_now = '$strDate'";
    //     mysqli_query($con, $dupStat);
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/dist/charts.css">
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo time(); ?>">
    <title>Canteen POS</title>
</head>
<body onload="onloadFunction()">
    <h1 id="head">CANTEEN POS</h1>

    <form method="POST">
        <span>
            <input type="textbox" id="tapInput" name="tapInput" autocomplete="off" onkeypress="myFunction(event)" autofocus>
            <p class="dte" id="dateNow" name="dateNow"></p>
        </span>
        <input type="submit" name="inputSubmit" id="inputSubmit" onclick="btnClicked()">
    </form>

    <div class="grid-container">
        <div class="grid-item item1">

            <?php
                if(isset($_POST['inputSubmit'])){
                    $cardNum = $_REQUEST['tapInput'];
                    $dateNow = date("Y-m-d");
                    $query_emp = "SELECT * from emp_list WHERE emp_cardNum = '$cardNum' LIMIT 1";
                    $result_emp = mysqli_query($con, $query_emp);
                    if(mysqli_num_rows($result_emp) > 0){

                        $emp_row = mysqli_fetch_assoc($result_emp);
                        $empID = $emp_row['emp_idNum'];
                        $empName = $emp_row['emp_name'];
                        $empCardNum = $emp_row['emp_cardNum'];
                        $empEmployer = $emp_row['employer'];
                        $timeNow = date("h:i:s a");

                        $query_tran = "SELECT * from tbl_trans_logs WHERE emp_cardNum = '$cardNum' AND tran_date = '$dateNow' LIMIT 1";
                        $result_tran = mysqli_query($con, $query_tran);
                        if(mysqli_num_rows($result_tran) > 0){

                            while($tran_row = mysqli_fetch_assoc($result_tran)){
                                ?>
                                    <h1 id="tapName"><?php echo $tran_row['emp_name'] ?></h1>
                                    <h2 class="anim">DUPLICATED!</h1>
                                <?php 
                            }
                        }else{

                            $tran_insert = "INSERT INTO `tbl_trans_logs`(`transaction_id`, `emp_id`, `emp_name`, `emp_cardNum`, `employer`, `tran_date`, `tran_time`) VALUES (null ,'$empID','$empName','$empCardNum','$empEmployer','$dateNow','$timeNow')";
                            mysqli_query($con, $tran_insert);

                            
                            ?>
                                <h1 class="tapName"><?php echo $empName?></h1>
                            <?php
                        }
                    }else{
                        ?>
                            <h2 class="anim nreg">CARD NOT REGISTERED!</h1>
                        <?php
                    }
                }
            ?>  

        </div>  

        <div class="grid-item item2">
            <h1 id="rTrans">RECENT TRANSACTION</h1>
            <table>
            <?php
                $dateNow = date("Y-m-d");
                $queryRT = "SELECT * FROM tbl_trans_logs WHERE tran_date = '$dateNow' ORDER BY transaction_id DESC LIMIT 8";
                $resultRT = mysqli_query($con,$queryRT);
                while ($row = mysqli_fetch_assoc($resultRT)){
            ?>  
                    <tr>
                        <td><?php echo $row['emp_name'] ?></td>
                    </tr>
            <?php
                }
            ?>
            </table>
        </div>

        <div class="grid-item item3">

            <table class="empTable">
                <thead>
                    <tr>
                        <th>GLORY (PHILS.) INC.</th>
                        <th>MAXIM</th>
                        <th>NIPPI</th>
                        <th>POWERLANE</th>
                    </tr>
                </thead>
            </table>

            <div class="chart">
                <table id="effect-example-2" class="charts-css column hide-data">
                    <caption> 3D Effect Example #2 </caption>
    
                    <thead>
                        <tr>
                            <th scope="col"> Graph </th>
                            <th scope="col"> Progress </th>
                        </tr>
                    </thead>

                    <?php

                        $dateNow = date("Y-m-d");

                        // ========================== GLORY PERCENTAGE ==========================

                        $query_glory = "SELECT * FROM `tbl_trans_logs` WHERE employer = 'GLORY' AND tran_date = '$dateNow'";
                        $resultGlory = mysqli_query($con, $query_glory);
                        $rowGlory = mysqli_num_rows($resultGlory);

                        $query_glory_total = "SELECT * FROM `emp_list` WHERE employer = 'GLORY'";
                        $resultGloryTotal = mysqli_query($con, $query_glory_total);
                        $rowGloryTotal = mysqli_num_rows($resultGloryTotal);

                        $query_sp = "SELECT * FROM `tbl_trans_logs` WHERE employer = 'SERVICE PROVIDER' AND tran_date = '$dateNow'";
                        $resultSP = mysqli_query($con, $query_sp);
                        $rowSP = mysqli_num_rows($resultSP);

                        $query_sp_total = "SELECT * FROM `emp_list` WHERE employer = 'SERVICE PROVIDER'";
                        $resultSPTotal = mysqli_query($con, $query_sp_total);
                        $rowSPTotal = mysqli_num_rows($resultSPTotal);

                        $gloryPer = ($rowGlory + $rowSP) / ($rowGloryTotal + $rowSPTotal);
                        

                        // ========================== MAXIM PERCENTAGE ==========================

                        $query_maxim = "SELECT * FROM `tbl_trans_logs` WHERE employer = 'MAXIM' AND tran_date = '$dateNow'";
                        $resultMaxim = mysqli_query($con, $query_maxim);
                        $rowMaxim = mysqli_num_rows($resultMaxim);

                        $query_maxim_total = "SELECT * FROM `emp_list` WHERE employer = 'MAXIM'";
                        $resultMaximTotal = mysqli_query($con, $query_maxim_total);
                        $rowMaximTotal = mysqli_num_rows($resultMaximTotal);

                        $maximPer = $rowMaxim / $rowMaximTotal;

                        // ========================== NIPPI PERCENTAGE ==========================

                        $query_nippi = "SELECT * FROM `tbl_trans_logs` WHERE employer = 'NIPPI' AND tran_date = '$dateNow'";
                        $resultNippi = mysqli_query($con, $query_nippi);
                        $rowNippi = mysqli_num_rows($resultNippi);

                        $query_nippi_total = "SELECT * FROM `emp_list` WHERE employer = 'NIPPI'";
                        $resultNippiTotal = mysqli_query($con, $query_nippi_total);
                        $rowNippiTotal = mysqli_num_rows($resultNippiTotal);

                        $nippiPer = $rowNippi / $rowNippiTotal;

                        // ========================== POWERLANE PERCENTAGE ==========================

                        $query_pl = "SELECT * FROM `tbl_trans_logs` WHERE employer = 'POWERLANE' AND tran_date = '$dateNow'";
                        $resultPL = mysqli_query($con, $query_pl);
                        $rowPL = mysqli_num_rows($resultPL);

                        $query_pl_total = "SELECT * FROM `emp_list` WHERE employer = 'POWERLANE'";
                        $resultPLTotal = mysqli_query($con, $query_pl_total);
                        $rowPLTotal = mysqli_num_rows($resultPLTotal);

                        $plPer = $rowPL / $rowPLTotal;

                        if(($gloryPer*100) == 100){
                            $gloryVal = substr(($gloryPer*100), 0, 3);
                        }else if(($gloryPer*100) < 10){
                            $gloryVal = substr(($gloryPer*100), 0, 1);
                        }else{
                            $gloryVal = substr(($gloryPer*100), 0, 2);
                        }

                        if(($maximPer*100) == 100){
                            $maximVal = substr(($maximPer*100), 0, 3);
                        }else if(($maximPer*100) < 10){
                            $maximVal = substr(($maximPer*100), 0, 1);
                        }else{
                            $maximVal = substr(($maximPer*100), 0, 2);
                        }

                        if(($nippiPer*100) == 100){
                            $nippiVal = substr(($nippiPer*100), 0, 3);
                        }else if(($nippiPer*100) < 10){
                            $nippiVal = substr(($nippiPer*100), 0, 1);
                        }else{
                            $nippiVal = substr(($nippiPer*100), 0, 2);
                        }

                        if(($plPer*100) == 100){
                            $plVal = substr(($plPer*100), 0, 3);
                        }else if(($plPer*100) < 10){
                            $plVal = substr(($plPer*100), 0, 1);
                        }else{
                            $plVal = substr(($plPer*100), 0, 2);
                        }



                    ?>
    
                    <tbody>
                        <tr>
                            <th scope="row"> Graph1 </th>
                            <td style="--size:<?php echo $gloryPer;?>;">
                                <span class="data" style="color:white;"><?php echo $gloryVal; ?>%</span>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"> Graph2 </th>
                            <td style="--size:<?php echo $maximPer;?>;">
                                <span class="data"><?php echo $maximVal; ?>%</span>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"> Graph3 </th>
                            <td style="--size:<?php echo $nippiPer;?>;">
                                <span class="data" style="color:white;"><?php echo $nippiVal; ?>%</span>
                            </td>
                        </tr> 
                        
                        <tr>
                            <th scope="row"> Graph4 </th>
                            <td style="--size:<?php echo $plPer;?>;">
                                <span class="data"><?php echo $plVal; ?>%</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

    <script type="text/javascript">

        function onloadFunction(){

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = h >= 12 ? 'PM' : 'AM';
            var hh = (today.getHours() + 11) % 12 + 1;
            var min = today.getMinutes();
            var sec = today.getSeconds();

            if(min<10){
                min = '0' + min;
            }

            if(sec<10){
                sec = '0' + sec;
            }

            today = dd + '-' + mm + '-' + yyyy + '   ' + hh + ':' + min + ':' + sec + ' ' + m;
            var curTime = hh + ':' + min + ':' + sec + ' ' + m;
            var curDate = dd + '-' + mm + '-' + yyyy;

            document.getElementById("dateNow").innerHTML = today;

            setInterval("onloadFunction()", 1000);
        };

        function myFunction(event) {
            let unicode= event.which;
    
            if(unicode == 13){
                document.getElementById("inputSubmit").click();
            }
        };

    </script>

</body>
</html>