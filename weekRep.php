<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo time(); ?>">
    <link rel="icon" href="./obj/canteen.png">
    <title>Weekly Report</title>
</head>

<body id="wRepBody" onload="navFuntion()">

    <!-- Include Navigation Side Bar -->
    <?php require_once 'nav.php';?>

    
    <h1>WEEKLY REPORT</h1>

    <div id="wRepContainer">
        <div class="btnContainer">
            <input type="button" id="logbookSales" class="logbookSales" value="LOGBOOK SALES" onclick="logbookSales()"><br>
            <input type="button" id="totalSalesReport" class="totalSalesReport" value="TOTAL SALES REPORT" onclick="totalSalesReport()"><br>
            <input type="button" id="summaryReport" class="summaryReport" value="SUMMARY REPORT" onclick="summaryReport()"><br>
            <input type="button" id="requestForPayment" class="requestForPayment" value="REQUEST FOR PAYMENT" onclick="requestForPayment()"><br>
        </div>
    </div>
    
    <script>
        function navFuntion(){
            var wRep = document.getElementById("wRep");
            wRep.classList.add("active");
        }

        function logbookSales(){
            document.location="./logbookSales.php";
        }
        function totalSalesReport(){
            
        }
        function summaryReport(){
            
        }
        function requestForPayment(){
            
        }

    </script>
</body>
</html>