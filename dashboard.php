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
                
            </div>
        </div>
        <div class="daily">
            <div class="dInside">
                <div class="diTitle">DAILY SALES SUMMARY</div>
                <div class="dEmp">
                    <div class="dTitle">GLORY (PHILS.) INC.</div>
                    <div class="totalPercent">
                        <svg>
                            <circle cx="50%" cy="50%" r=100px></circle>
                            <circle cx="50%" cy="50%" r=100px style="stroke-dashoffset: calc(630 - (630 * 25) / 100); stroke: #0C4C8A;"></circle>
                        </svg>
                        <div class="percentNumber">
                            <h2>25<span>%</span></h2>
                        </div>
                    </div>
                </div>
                <div class="dEmp">
                    <div class="dTitle">MAXIM</div>
                    <div class="totalPercent">
                        <svg>
                            <circle cx="50%" cy="50%" r=100px></circle>
                            <circle cx="50%" cy="50%" r=100px style="stroke-dashoffset: calc(630 - (630 * 50) / 100); stroke: #3BAFDA"></circle>
                        </svg>
                        <div class="percentNumber">
                            <h2>50<span>%</span></h2>
                        </div>
                    </div>
                </div>
                <div class="dEmp">
                    <div class="dTitle">NIPPI</div>
                    <div class="totalPercent">
                        <svg>
                            <circle cx="50%" cy="50%" r=100px></circle>
                            <circle cx="50%" cy="50%" r=100px style="stroke-dashoffset: calc(630 - (630 * 75) / 100); stroke: #1E3176"></circle>
                        </svg>
                        <div class="percentNumber">
                            <h2>75<span>%</span></h2>
                        </div>
                    </div>
                </div>
                <div class="dEmp">
                    <div class="dTitle">POWERLANE</div>
                    <div class="totalPercent">
                        <svg>
                            <circle cx="50%" cy="50%" r=100px></circle>
                            <circle cx="50%" cy="50%" r=100px style="stroke-dashoffset: calc(630 - (630 * 100) / 100); stroke: #8CC152"></circle>
                        </svg>
                        <div class="percentNumber">
                            <h2>100<span>%</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dTotal">
                <div class="dTitle">Daily Total Sales</div>
                <div class="totalPercent">
                    <svg>
                        <circle cx="50%" cy="50%" r=120px></circle>
                        <circle cx="50%" cy="50%" r=120px style="stroke-dashoffset: calc(760 - (760 * 85) / 100);"></circle>
                    </svg>
                    <div class="percentNumber">
                        <h2>85<span>%</span></h2>
                    </div>
                </div>
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