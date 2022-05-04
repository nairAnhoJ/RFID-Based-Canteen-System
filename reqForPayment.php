<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo time(); ?>">
    <link rel="icon" href="./obj/canteen.png">
    <title>Request For Payment</title>
</head>

<body id="reqForPaymentBody" onload="navFuntion()">

    <!-- Include Navigation Side Bar -->
    <?php require_once 'nav.php';?>

    
    <h1>LOGBOOK SALES</h1>

    <div class="totalSalesContainer">
        <form action="POST">
            <div class="totalSalesControl">
                <span class="fromCon">
                    From: <input type="date" name="totalFrom" id="dateFrom" onchange="btnClickF()" value="<?php echo date("Y-m-d"); ?>">
                </span>
                <span class="toCon">
                    To: <input type="date" name="totalTo" id="dateTo" onchange="btnClickT()" value="<?php echo date("Y-m-d"); ?>">
                </span>
            </div>
            <input type="button" value="PRINT" class="btnPrint">
        </form>
    </div>
    
    
    
    <script>
        function navFuntion(){
            var wRep = document.getElementById("wkRep");
            wRep.classList.add("active");
            var wRep = document.getElementById("o4");
            wRep.classList.add("activeReport");
        }

    </script>
</body>
</html>