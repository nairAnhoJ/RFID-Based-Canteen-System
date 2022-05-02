<div id="sideBar">

    <!-- LOGO CONTAINER  -->
    <div class="topTitle">
        <img src="./obj/canteen.png" class="imgUser" alt="user" width="40" height="40">
        <div class="topText">CANTEEN</div>
    </div>

    <!-- CONTENT CONTAINER -->
    <div class="contentContainer">
        <ul class="nav-list">
            <li tabindex="-1">
                <a href="./dashboard.php" id="db" tabindex="-1">
                    <img src="./obj/dashboard.png">
                    <span class="nav-name">Dashboard</span>
                </a>
            </li>
            <li tabindex="-1">
                <a href="./employees.php" id="group" tabindex="-1">
                    <img src="./obj/group.png">
                    <span class="nav-name">Employees</span>
                </a>
            </li>
            <li tabindex="-1">
                <a href="./logs.php" id="tran" tabindex="-1">
                    <img src="./obj/log.png">
                    <span class="nav-name">Transaction Logs</span>
                </a>
            </li>
            <li tabindex="-1">
                <div class="dDown" id="wkRep">
                    <img class="repImg" src="./obj/report.png">
                    <span class="dropBtn">Weekly Report</span>
                    <!-- <button class="dropbtn">Weekly Report</button> -->
                    <img class="arrow" src="./obj/caret-down.png">
                    <div class="dDownContent">
                        <a id="o1" href="./logbookSales.php" tabindex="-1">Logbook Sales</a>
                        <a id="o2" href="./totalSalesReport.php" tabindex="-1">Total Sales Report</a>
                        <a id="o3" href="./sumReport.php" tabindex="-1">Summary Report</a>
                        <a id="o4" href="./reqForPayment.php" tabindex="-1">Request For Payment</a>
                    </div>
                </div>


                <!-- <a href="./weekRep.php" id="wRep">
                    <img src="./obj/report.png">
                    <span class="nav-name">Weekly Report <img id="arrow" src="./obj/caret-down.png"></span>
                    
                </a> -->
            </li>
        </ul>
    </div>

    <!-- LOGOUT CONTAINER -->
    <div class="logOut">
        <ul class="btn-logOut">
            <li>
                <a href="./logout.php" tabindex="-1">
                    <img src="./obj/sign-out.png" class="imgUser" alt="user" width="40" height="40">
                    <span class="lbl-logOut">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<script type="text/script">

</script>