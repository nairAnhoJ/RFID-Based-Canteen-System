<?php
    session_start();

    include("./connection.php");

    if(!isset($_SESSION['connected'])){
        header('location: login.php');
    }

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

    $totalSales = ($rowGlory + $rowSP + $rowMaxim + $rowNippi + $rowPL) / ($rowGloryTotal + $rowSPTotal + $rowMaximTotal + $rowNippiTotal + $rowPLTotal);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./Chart.min.js"></script>
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo time(); ?>">
    <link rel="icon" href="./obj/canteen.png">
    <title>Dashboard</title>

    <script>
        function changeRadius(){

            const sWidth = window.screen.width;
            console.log(sWidth);

            if ((sWidth >= 1681) && (sWidth <= 1920)) {
                const cSumRadius1 = document.getElementById("sumCircle1");
                const cSumRadius2 = document.getElementById("sumCircle2");
                const cSumRadius3 = document.getElementById("sumCircle3");
                const cSumRadius4 = document.getElementById("sumCircle4");
                const cSumRadius5 = document.getElementById("sumCircle5");
                const cSumRadius6 = document.getElementById("sumCircle6");
                const cSumRadius7 = document.getElementById("sumCircle7");
                const cSumRadius8 = document.getElementById("sumCircle8");

                const cTotalRadius1 = document.getElementById("totalCircle1");
                const cTotalRadius2 = document.getElementById("totalCircle2");

                cSumRadius1.setAttribute("r", "100px");
                cSumRadius2.setAttribute("r", "100px");
                cSumRadius2.setAttribute("style", "stroke-dashoffset: calc(630 - (630 * <?php echo json_encode($gloryPer); ?>)); stroke: #0C4C8A;");
                cSumRadius3.setAttribute("r", "100px");
                cSumRadius4.setAttribute("r", "100px");
                cSumRadius4.setAttribute("style", "stroke-dashoffset: calc(630 - (630 * <?php echo json_encode($maximPer); ?>)); stroke: #3BAFDA;");
                cSumRadius5.setAttribute("r", "100px");
                cSumRadius6.setAttribute("r", "100px");
                cSumRadius6.setAttribute("style", "stroke-dashoffset: calc(630 - (630 * <?php echo json_encode($nippiPer); ?>)); stroke: #1E3176;");
                cSumRadius7.setAttribute("r", "100px");
                cSumRadius8.setAttribute("r", "100px");
                cSumRadius8.setAttribute("style", "stroke-dashoffset: calc(630 - (630 * <?php echo json_encode($plPer); ?>)); stroke: #8CC152;");

                cTotalRadius1.setAttribute("r", "120px");
                cTotalRadius2.setAttribute("r", "120px");
                cTotalRadius2.setAttribute("style", "stroke-dashoffset: calc(760 - (760 * <?php echo $totalSales;?>));");
            }else if ((sWidth >= 1601) && (sWidth <= 1680)) {
                const cSumRadius1 = document.getElementById("sumCircle1");
                const cSumRadius2 = document.getElementById("sumCircle2");
                const cSumRadius3 = document.getElementById("sumCircle3");
                const cSumRadius4 = document.getElementById("sumCircle4");
                const cSumRadius5 = document.getElementById("sumCircle5");
                const cSumRadius6 = document.getElementById("sumCircle6");
                const cSumRadius7 = document.getElementById("sumCircle7");
                const cSumRadius8 = document.getElementById("sumCircle8");

                const cTotalRadius1 = document.getElementById("totalCircle1");
                const cTotalRadius2 = document.getElementById("totalCircle2");

                cSumRadius1.setAttribute("r", "100px");
                cSumRadius2.setAttribute("r", "100px");
                cSumRadius2.setAttribute("style", "stroke-dashoffset: calc(630 - (630 * <?php echo json_encode($gloryPer); ?>)); stroke: #0C4C8A;");
                cSumRadius3.setAttribute("r", "100px");
                cSumRadius4.setAttribute("r", "100px");
                cSumRadius4.setAttribute("style", "stroke-dashoffset: calc(630 - (630 * <?php echo json_encode($maximPer); ?>)); stroke: #3BAFDA;");
                cSumRadius5.setAttribute("r", "100px");
                cSumRadius6.setAttribute("r", "100px");
                cSumRadius6.setAttribute("style", "stroke-dashoffset: calc(630 - (630 * <?php echo json_encode($nippiPer); ?>)); stroke: #1E3176;");
                cSumRadius7.setAttribute("r", "100px");
                cSumRadius8.setAttribute("r", "100px");
                cSumRadius8.setAttribute("style", "stroke-dashoffset: calc(630 - (630 * <?php echo json_encode($plPer); ?>)); stroke: #8CC152;");

                cTotalRadius1.setAttribute("r", "120px");
                cTotalRadius2.setAttribute("r", "120px");
                cTotalRadius2.setAttribute("style", "stroke-dashoffset: calc(760 - (760 * <?php echo $totalSales;?>));");
            }else if ((sWidth >= 1441) && (sWidth <= 1600)) {
                const cSumRadius1 = document.getElementById("sumCircle1");
                const cSumRadius2 = document.getElementById("sumCircle2");
                const cSumRadius3 = document.getElementById("sumCircle3");
                const cSumRadius4 = document.getElementById("sumCircle4");
                const cSumRadius5 = document.getElementById("sumCircle5");
                const cSumRadius6 = document.getElementById("sumCircle6");
                const cSumRadius7 = document.getElementById("sumCircle7");
                const cSumRadius8 = document.getElementById("sumCircle8");

                const cTotalRadius1 = document.getElementById("totalCircle1");
                const cTotalRadius2 = document.getElementById("totalCircle2");

                cSumRadius1.setAttribute("r", "90px");
                cSumRadius2.setAttribute("r", "90px");
                cSumRadius2.setAttribute("style", "stroke-dashoffset: calc(570 - (570 * <?php echo json_encode($gloryPer); ?>)); stroke: #0C4C8A;");
                cSumRadius3.setAttribute("r", "90px");
                cSumRadius4.setAttribute("r", "90px");
                cSumRadius4.setAttribute("style", "stroke-dashoffset: calc(570 - (570 * <?php echo json_encode($maximPer); ?>)); stroke: #3BAFDA;");
                cSumRadius5.setAttribute("r", "90px");
                cSumRadius6.setAttribute("r", "90px");
                cSumRadius6.setAttribute("style", "stroke-dashoffset: calc(570 - (570 * <?php echo json_encode($nippiPer); ?>)); stroke: #1E3176;");
                cSumRadius7.setAttribute("r", "90px");
                cSumRadius8.setAttribute("r", "90px");
                cSumRadius8.setAttribute("style", "stroke-dashoffset: calc(570 - (570 * <?php echo json_encode($plPer); ?>)); stroke: #8CC152;");

                cTotalRadius1.setAttribute("r", "105px");
                cTotalRadius2.setAttribute("r", "105px");
                cTotalRadius2.setAttribute("style", "stroke-dashoffset: calc(660 - (660 * <?php echo $totalSales;?>));");
            }else if ((sWidth >= 1441) && (sWidth <= 1536)) {
                
            }else if ((sWidth >= 1367) && (sWidth <= 1440)) {
                const cSumRadius1 = document.getElementById("sumCircle1");
                const cSumRadius2 = document.getElementById("sumCircle2");
                const cSumRadius3 = document.getElementById("sumCircle3");
                const cSumRadius4 = document.getElementById("sumCircle4");
                const cSumRadius5 = document.getElementById("sumCircle5");
                const cSumRadius6 = document.getElementById("sumCircle6");
                const cSumRadius7 = document.getElementById("sumCircle7");
                const cSumRadius8 = document.getElementById("sumCircle8");

                const cTotalRadius1 = document.getElementById("totalCircle1");
                const cTotalRadius2 = document.getElementById("totalCircle2");

                cSumRadius1.setAttribute("r", "70px");
                cSumRadius2.setAttribute("r", "70px");
                cSumRadius2.setAttribute("style", "stroke-dashoffset: calc(440 - (440 * <?php echo json_encode($gloryPer); ?>)); stroke: #0C4C8A;");
                cSumRadius3.setAttribute("r", "70px");
                cSumRadius4.setAttribute("r", "70px");
                cSumRadius4.setAttribute("style", "stroke-dashoffset: calc(440 - (440 * <?php echo json_encode($maximPer); ?>)); stroke: #3BAFDA;");
                cSumRadius5.setAttribute("r", "70px");
                cSumRadius6.setAttribute("r", "70px");
                cSumRadius6.setAttribute("style", "stroke-dashoffset: calc(440 - (440 * <?php echo json_encode($nippiPer); ?>)); stroke: #1E3176;");
                cSumRadius7.setAttribute("r", "70px");
                cSumRadius8.setAttribute("r", "70px");
                cSumRadius8.setAttribute("style", "stroke-dashoffset: calc(440 - (440 * <?php echo json_encode($plPer); ?>)); stroke: #8CC152;");

                cSumRadius1.setAttribute("cy", "44%");
                cSumRadius2.setAttribute("cy", "44%");
                cSumRadius3.setAttribute("cy", "44%");
                cSumRadius4.setAttribute("cy", "44%");
                cSumRadius5.setAttribute("cy", "44%");
                cSumRadius6.setAttribute("cy", "44%");
                cSumRadius7.setAttribute("cy", "44%");
                cSumRadius8.setAttribute("cy", "44%");

                cTotalRadius1.setAttribute("r", "80px");
                cTotalRadius2.setAttribute("r", "80px");
                cTotalRadius2.setAttribute("style", "stroke-dashoffset: calc(530 - (520 * <?php echo $totalSales;?>));");
            }else if ((sWidth >= 1281) && (sWidth <= 1366)) {
                const cSumRadius1 = document.getElementById("sumCircle1");
                const cSumRadius2 = document.getElementById("sumCircle2");
                const cSumRadius3 = document.getElementById("sumCircle3");
                const cSumRadius4 = document.getElementById("sumCircle4");
                const cSumRadius5 = document.getElementById("sumCircle5");
                const cSumRadius6 = document.getElementById("sumCircle6");
                const cSumRadius7 = document.getElementById("sumCircle7");
                const cSumRadius8 = document.getElementById("sumCircle8");

                const cTotalRadius1 = document.getElementById("totalCircle1");
                const cTotalRadius2 = document.getElementById("totalCircle2");

                cSumRadius1.setAttribute("r", "70px");
                cSumRadius2.setAttribute("r", "70px");
                cSumRadius2.setAttribute("style", "stroke-dashoffset: calc(440 - (440 * <?php echo json_encode($gloryPer); ?>)); stroke: #0C4C8A;");
                cSumRadius3.setAttribute("r", "70px");
                cSumRadius4.setAttribute("r", "70px");
                cSumRadius4.setAttribute("style", "stroke-dashoffset: calc(440 - (440 * <?php echo json_encode($maximPer); ?>)); stroke: #3BAFDA;");
                cSumRadius5.setAttribute("r", "70px");
                cSumRadius6.setAttribute("r", "70px");
                cSumRadius6.setAttribute("style", "stroke-dashoffset: calc(440 - (440 * <?php echo json_encode($nippiPer); ?>)); stroke: #1E3176;");
                cSumRadius7.setAttribute("r", "70px");
                cSumRadius8.setAttribute("r", "70px");
                cSumRadius8.setAttribute("style", "stroke-dashoffset: calc(440 - (440 * <?php echo json_encode($plPer); ?>)); stroke: #8CC152;");

                cSumRadius1.setAttribute("cy", "44%");
                cSumRadius2.setAttribute("cy", "44%");
                cSumRadius3.setAttribute("cy", "44%");
                cSumRadius4.setAttribute("cy", "44%");
                cSumRadius5.setAttribute("cy", "44%");
                cSumRadius6.setAttribute("cy", "44%");
                cSumRadius7.setAttribute("cy", "44%");
                cSumRadius8.setAttribute("cy", "44%");

                cTotalRadius1.setAttribute("r", "80px");
                cTotalRadius2.setAttribute("r", "80px");
                cTotalRadius2.setAttribute("style", "stroke-dashoffset: calc(530 - (520 * <?php echo $totalSales;?>));");

            }else if ((sWidth >= 1025) && (sWidth <= 1280)) {
                const cSumRadius1 = document.getElementById("sumCircle1");
                const cSumRadius2 = document.getElementById("sumCircle2");
                const cSumRadius3 = document.getElementById("sumCircle3");
                const cSumRadius4 = document.getElementById("sumCircle4");
                const cSumRadius5 = document.getElementById("sumCircle5");
                const cSumRadius6 = document.getElementById("sumCircle6");
                const cSumRadius7 = document.getElementById("sumCircle7");
                const cSumRadius8 = document.getElementById("sumCircle8");

                const cTotalRadius1 = document.getElementById("totalCircle1");
                const cTotalRadius2 = document.getElementById("totalCircle2");

                cSumRadius1.setAttribute("r", "65px");
                cSumRadius2.setAttribute("r", "65px");
                cSumRadius2.setAttribute("style", "stroke-dashoffset: calc(410 - (410 * <?php echo json_encode($gloryPer); ?>)); stroke: #0C4C8A;");
                cSumRadius3.setAttribute("r", "65px");
                cSumRadius4.setAttribute("r", "65px");
                cSumRadius4.setAttribute("style", "stroke-dashoffset: calc(410 - (410 * <?php echo json_encode($maximPer); ?>)); stroke: #3BAFDA;");
                cSumRadius5.setAttribute("r", "65px");
                cSumRadius6.setAttribute("r", "65px");
                cSumRadius6.setAttribute("style", "stroke-dashoffset: calc(410 - (410 * <?php echo json_encode($nippiPer); ?>)); stroke: #1E3176;");
                cSumRadius7.setAttribute("r", "65px");
                cSumRadius8.setAttribute("r", "65px");
                cSumRadius8.setAttribute("style", "stroke-dashoffset: calc(410 - (410 * <?php echo json_encode($plPer); ?>)); stroke: #8CC152;");

                cSumRadius1.setAttribute("cy", "44%");
                cSumRadius2.setAttribute("cy", "44%");
                cSumRadius3.setAttribute("cy", "44%");
                cSumRadius4.setAttribute("cy", "44%");
                cSumRadius5.setAttribute("cy", "44%");
                cSumRadius6.setAttribute("cy", "44%");
                cSumRadius7.setAttribute("cy", "44%");
                cSumRadius8.setAttribute("cy", "44%");

                cTotalRadius1.setAttribute("r", "70px");
                cTotalRadius2.setAttribute("r", "70px");
                cTotalRadius2.setAttribute("style", "stroke-dashoffset: calc(440 - (440 * <?php echo $totalSales;?>));");
            }else if (sWidth <= 1024) {
            
            }
        }
    </script>

</head>
<body id="db-body" onload="navFuntion()">
    <!-- Include Navigation Side Bar -->
    <?php require_once 'nav.php';?>

    <!-- Dashboard Content -->
    <div class="db-container">
        <div class="pageTitle">DASHBOARD</div>
        <div class="weekly">
            <div class="mInside">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

         



        <div class="daily">
            <div class="dInside">
                <div class="diTitle">DAILY SALES SUMMARY</div>
                <div class="dEmp">
                    <div class="dTitle">GLORY (PHILS.) INC.</div>
                    <div class="totalPercent">
                        <svg>
                            <circle cx="50%" cy="48%" r=100px id="sumCircle1"></circle>
                            <circle cx="50%" cy="48%" r=100px id="sumCircle2"></circle>
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
                            <circle cx="50%" cy="48%" r=100px id="sumCircle3"></circle>
                            <circle cx="50%" cy="48%" r=100px id="sumCircle4"></circle>
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
                            <circle cx="50%" cy="48%" r=100px id="sumCircle5"></circle>
                            <circle cx="50%" cy="48%" r=100px id="sumCircle6"></circle>
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
                            <circle cx="50%" cy="48%" r=100px id="sumCircle7"></circle>
                            <circle cx="50%" cy="48%" r=100px id="sumCircle8"></circle>
                        </svg>
                        <div class="percentNumber">
                            <h2><span class="counter" data-target="<?php echo substr(($plPer*100), 0, 4); ?>">0</span><span>%</span></h2>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                
            ?>

            <div class="dTotal">
                <div class="dTitle">Daily Total Sales</div>
                <div class="totalPercent">
                    <svg>
                        <circle cx="50%" cy="50%" r=120px id="totalCircle1"></circle>
                        <circle cx="50%" cy="50%" r=120px id="totalCircle2"></circle>
                    </svg>
                    <div class="percentNumber"> 
                        <h2><span class="counter" data-target="<?php echo substr(($totalSales*100), 0, 4); ?>">0</span><span>%</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        // Get Date of Monday this Week
        $monDate = date("Y-m-d", strtotime("monday this week"));

        // Get Date of Mondays for the last 8 Weeks
        $lastMon = date_create($monDate)->modify("-7 days")->format("Y-m-d");
        $_SESSION['lastMon'] = $lastMon;
        $last2Mon = date_create($monDate)->modify("-14 days")->format("Y-m-d");
        $last3Mon = date_create($monDate)->modify("-21 days")->format("Y-m-d");
        $last4Mon = date_create($monDate)->modify("-28 days")->format("Y-m-d");
        $last5Mon = date_create($monDate)->modify("-35 days")->format("Y-m-d");
        $last6Mon = date_create($monDate)->modify("-42 days")->format("Y-m-d");
        $last7Mon = date_create($monDate)->modify("-49 days")->format("Y-m-d");
        $last8Mon = date_create($monDate)->modify("-56 days")->format("Y-m-d");

        // Get Date of Sundays for the last 8 Weeks
        $lastSun = date_create($monDate)->modify("-1 days")->format("Y-m-d");
        $_SESSION['lastSun'] = $lastSun;
        $last2Sun = date_create($monDate)->modify("-8 days")->format("Y-m-d");
        $last3Sun = date_create($monDate)->modify("-15 days")->format("Y-m-d");
        $last4Sun = date_create($monDate)->modify("-22 days")->format("Y-m-d");
        $last5Sun = date_create($monDate)->modify("-29 days")->format("Y-m-d");
        $last6Sun = date_create($monDate)->modify("-36 days")->format("Y-m-d");
        $last7Sun = date_create($monDate)->modify("-43 days")->format("Y-m-d");
        $last8Sun = date_create($monDate)->modify("-50 days")->format("Y-m-d");

        $queryWeek1 = "SELECT * FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$lastMon' AND '$lastSun'";
        $resultWeek1 = mysqli_query($con, $queryWeek1);
        $totalWeek1 = mysqli_num_rows($resultWeek1);

        $queryWeek2 = "SELECT * FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$last2Mon' AND '$last2Sun'";
        $resultWeek2 = mysqli_query($con, $queryWeek2);
        $totalWeek2 = mysqli_num_rows($resultWeek2);

        $queryWeek3 = "SELECT * FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$last3Mon' AND '$last3Sun'";
        $resultWeek3 = mysqli_query($con, $queryWeek3);
        $totalWeek3 = mysqli_num_rows($resultWeek3);

        $queryWeek4 = "SELECT * FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$last4Mon' AND '$last4Sun'";
        $resultWeek4 = mysqli_query($con, $queryWeek4);
        $totalWeek4 = mysqli_num_rows($resultWeek4);

        $queryWeek5 = "SELECT * FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$last5Mon' AND '$last5Sun'";
        $resultWeek5 = mysqli_query($con, $queryWeek5);
        $totalWeek5 = mysqli_num_rows($resultWeek5);

        $queryWeek6 = "SELECT * FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$last6Mon' AND '$last6Sun'";
        $resultWeek6 = mysqli_query($con, $queryWeek6);
        $totalWeek6 = mysqli_num_rows($resultWeek6);

        $queryWeek7 = "SELECT * FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$last7Mon' AND '$last7Sun'";
        $resultWeek7 = mysqli_query($con, $queryWeek7);
        $totalWeek7 = mysqli_num_rows($resultWeek7);

        $queryWeek8 = "SELECT * FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$last8Mon' AND '$last8Sun'";
        $resultWeek8 = mysqli_query($con, $queryWeek8);
        $totalWeek8 = mysqli_num_rows($resultWeek8);

        $weeklyData = array($totalWeek8, $totalWeek7, $totalWeek6, $totalWeek5, $totalWeek4, $totalWeek3, $totalWeek2, $totalWeek1);
        $weekDates = array($last8Mon, $last7Mon, $last6Mon, $last5Mon, $last4Mon, $last3Mon, $last2Mon, $lastMon);

        $lData = (min($weeklyData));
        $hData = (max($weeklyData));

        if($lData < 500){
            $sMin = 0;
        }else{
            $sMin = $lData - 100;
        }

        $sMax = $hData + 20;


    ?>


    <script type="text/javascript">

        function navFuntion(){
            var db = document.getElementById("db");
            var group = document.getElementById("group");
            var tran = document.getElementById("tran");

            db.classList.add("active");
            tran.classList.remove("active");
            group.classList.remove("active");

            changeRadius();
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

        let wChart = document.getElementById('weeklyChart').getContext('2d');
        let weekChart = new Chart(wChart, {
            type:'line',
            data:{
                labels: <?php echo json_encode($weekDates); ?>,
                datasets:[{
                    label:'Sales',
                    data: <?php echo json_encode($weeklyData); ?>,
                    borderColor: '#3bafda',
                    borderWidth: 4,
                    fill: false,
                    tension: 0.4
                }]
            },

            options: {
                responsive: true,
                plugins: { 
                    title: {
                        display: true,
                        text: 'Weekly Sales',
                    },
                    legend:{
                        display: false,
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Week'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Employees'
                        },
                        min: <?php echo json_encode($sMin); ?>,
                        max: <?php echo json_encode($sMax); ?>
                    }
                }
            },
        });

    </script>
</body>
</html>