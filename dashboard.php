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
        ?> 



        <div class="daily">
            <div class="dInside">
                <div class="diTitle">DAILY SALES SUMMARY</div>
                <div class="dEmp">
                    <div class="dTitle">GLORY (PHILS.) INC.</div>
                    <div class="totalPercent">
                        <svg>
                            <circle cx="50%" cy="50%" r=100px></circle>
                            <circle cx="50%" cy="50%" r=100px style="stroke-dashoffset: calc(630 - (630 * <?php echo $gloryPer;?>)); stroke: #0C4C8A;"></circle>
                        </svg>
                        <div class="percentNumber">
                            <h2><span class="counter" data-target="<?php echo substr(($gloryPer*100), 0, 4); ?>">0</span><span>%</span></h2>
                        </div>
                    </div>
                </div>
                <div class="dEmp">
                    <div class="dTitle">MAXIM</div>
                    <div class="totalPercent">
                        <svg>
                            <circle cx="50%" cy="50%" r=100px></circle>
                            <circle cx="50%" cy="50%" r=100px style="stroke-dashoffset: calc(630 - (630 * <?php echo $maximPer;?>)); stroke: #3BAFDA"></circle>
                        </svg>
                        <div class="percentNumber">
                            <h2><span class="counter" data-target="<?php echo substr(($maximPer*100), 0, 4); ?>">0</span><span>%</span></h2>
                        </div>
                    </div>
                </div>
                <div class="dEmp">
                    <div class="dTitle">NIPPI</div>
                    <div class="totalPercent">
                        <svg>
                            <circle cx="50%" cy="50%" r=100px></circle>
                            <circle cx="50%" cy="50%" r=100px style="stroke-dashoffset: calc(630 - (630 * <?php echo $nippiPer;?>)); stroke: #1E3176"></circle>
                        </svg>
                        <div class="percentNumber">
                            <h2><span class="counter" data-target="<?php echo substr(($nippiPer*100), 0, 4); ?>">0</span><span>%</span></h2>
                        </div>
                    </div>
                </div>
                <div class="dEmp">
                    <div class="dTitle">POWERLANE</div>
                    <div class="totalPercent">
                        <svg>
                            <circle cx="50%" cy="50%" r=100px></circle>
                            <circle cx="50%" cy="50%" r=100px style="stroke-dashoffset: calc(630 - (630 * <?php echo $plPer;?>)); stroke: #8CC152"></circle>
                        </svg>
                        <div class="percentNumber">
                            <h2><span class="counter" data-target="<?php echo substr(($plPer*100), 0, 4); ?>">0</span><span>%</span></h2>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                $totalSales = ($rowGlory + $rowSP + $rowMaxim + $rowNippi + $rowPL) / ($rowGloryTotal + $rowSPTotal + $rowMaximTotal + $rowNippiTotal + $rowPLTotal)
            ?>

            <div class="dTotal">
                <div class="dTitle">Daily Total Sales</div>
                <div class="totalPercent">
                    <svg>
                        <circle cx="50%" cy="50%" r=120px></circle>
                        <circle cx="50%" cy="50%" r=120px style="stroke-dashoffset: calc(760 - (760 * <?php echo $totalSales;?>));"></circle>
                    </svg>
                    <div class="percentNumber"> 
                        <h2><span class="counter" data-target="<?php echo substr(($totalSales*100), 0, 4); ?>">0</span><span>%</span></h2>
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

        const counters = document.querySelectorAll('.counter');
        const speed = 100;

        counters.forEach(counter => {
                var nCount = 1;
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;

                    const inc = target / speed;
                    var str;
                    var cStr;

                    if(count < target){
                        str = nCount + inc;
                        nCount = str;
                        if(nCount < 10){
                            cStr = String(str).slice(0,1);
                        }else if(nCount == 100){
                            cStr = String(str).slice(0,3);
                        }else{
                            cStr = String(str).slice(0,2);
                        }
                        counter.innerText = cStr;
                        setTimeout(updateCount, 5);
                    }else{
                        count.innerText = target;
                    }
                }
                updateCount();
            });

    </script>
</body>
</html>