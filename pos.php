<?php
    session_start();

    include("./connection.php");

    $dateNow = date("d-m-Y");
    $query_dup = "SELECT * FROM dup_status";
    $dup_res = mysqli_query($con,$query_dup);

    $row = mysqli_fetch_assoc($dup_res);
    if($row['date_now'] != $dateNow){
        $dupStat = "UPDATE dup_status SET dup_stat='NO', dup_name = '', date_now = $dateNow";
        mysqli_query($con, $dupStat);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/dist/charts.css">
    <link rel="stylesheet" href="./styles/styles.css">
    <title>Canteen POS</title>
</head>
<body onload="onloadFunction()">
    <h1 id="head">CANTEEN POS</h1>

    <form method="POST">
        <span>
            <input type="textbox" id="tapInput" name="tapInput" autocomplete="off" onkeyup="EnableDisable(this)" onkeypress="myFunction(event)" autofocus>
            <p class="dte" id="dateNow" name="dateNow"></p>
        </span>
        <input type="submit" name="inputSubmit" id="inputSubmit" onclick="btnClicked()">
    </form>

    <div class="grid-container">
        <div class="grid-item item1">

            <?php
                if(isset($_POST['inputSubmit'])){
                    $cardNum = $_SESSION['tapInput'];
                    $dateNow = date("d-m-Y");
                    $query_tran = "SELECT * from tbl_trans_logs WHERE emp_cardNum = '$cardNum' AND tran_date = '$dateNow'";
                }
            ?>
                <h1 id="tapName">NAME</h1>
            <?php

            ?>


            <?php

            ?>

                <h2 id="anim">ERROR MESSAGE PAG PANGALAWANG TAP NA!</h1>

            <?php

            ?>  

        </div>  

        <div class="grid-item item2">
            <h1 id="rTrans">RECENT TRANSACTION</h1>
            <table>
            <?php
                $dateNow = date("d-m-Y");
                $queryRT = "SELECT * FROM tbl_trans_logs WHERE tran_date = '$dateNow' ORDER BY transaction_id DESC LIMIT 6";
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
    
                    <tbody>
                        <tr>
                            <th scope="row"> Graph1 </th>
                            <td style="--size:0.5;"><span class="data" style="color:white;">50%</span></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"> Graph2 </th>
                            <td style="--size:0.35;">
                                <span class="data">35%</span>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row"> Graph3 </th>
                            <td style="--size:0.4;">
                                <span class="data" style="color:white;">40%</span>
                            </td>
                        </tr> 
                        
                        <tr>
                            <th scope="row"> Graph4 </th>
                            <td style="--size:1;">
                                <span class="data">100%</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

    <script type="text/javascript">

        function onloadFunction(){
            document.getElementById("inputSubmit").disabled = true;

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
            document.getElementById("r1").innerHTML = unicode;
    
            if(unicode == 13){
                document.getElementById("inputSubmit").click();
            }
        };

        function EnableDisable(txtPassportNumber) {
            var btnSubmit = document.getElementById("inputSubmit");
    
            if (tapInput.value.trim() != "") {
                btnSubmit.disabled = false;
            } else {
                btnSubmit.disabled = true;
            }
        };

        function btnClicked(){
            document.getElementById("tapName").innerHTML = "You pressed ENTER Button!";
        };

    </script>

</body>
</html>