<?php
    session_start();

    include("./connection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <title>EXPORT TO EXCEL</title>
</head>
<body>
    <h2 class="exportTitle">EXPORT DATA</h2>
    <div class="export-container">
        <form method="POST">
            <span>
                From: <input type="date" name="dateFrom" data-date="" data-date-format="DD-MM-YYYY" value="<?php echo date('Y-m-d'); ?>"/> 
            </span>
            <span>
                To: <input type="date" name="dateTo" data-date="" data-date-format="DD-MM-YYYY" value="<?php echo date('Y-m-d'); ?>"/>
            </span>
            <input type="submit" value="EXPORT" id="btnExport">
        </form>

        <div class="exportTable">
            


        </div>
    </div>
</body>
</html>