<?php
    session_start();

    include("./connection.php");

    if(!isset($_SESSION['connected'])){
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo time(); ?>">
    <title>Dashboard</title>
</head>
<body id="db-body" onload="navFuntion()">
    <!-- Include Navigation Side Bar -->
    <?php require_once 'nav.php';?>

    <!-- Dashboard Content -->
    <div class="db-container">
        <div class="pageTitle">DASHBOARD</div>
        <div class="monthly">
            <div class="mInside">
                monthly
            </div>
        </div>
        <div class="daily">
            <div class="dInside">
                daily
            </div>
        </div>
    </div>


    <script type="text/javascript">

        function navFuntion(){
            var db = document.getElementById("db");
            var group = document.getElementById("group");
            var tran = document.getElementById("tran");

            db.classList.add("active");
            tran.classList.remove("active");
            group.classList.remove("active");
        }

    </script>
</body>
</html>