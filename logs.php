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
        <link rel="icon" href="./obj/canteen.png">
        <script src="./jquery.min.js"></script>
        <script src="./table2csv.min.js"></script>
        <title>TRANSACTION LOGS</title>
    </head>
    <body id="export-body" onload="navFuntion()">

        <!-- Include Navigation Side Bar -->
        <?php require_once 'nav.php';?>

        <h2 class="exportTitle">TRANSACTION LOGS</h2>
        <div class="export-container">
            <form id="search-container" method="POST">
                <span>
                    From: <input type="date" name="dateFrom" id="dateFrom" data-date="" data-date-format="DD-MM-YYYY"  onchange="btnClickF()" value="<?php if(isset($_REQUEST['dateFrom'])){ echo $_REQUEST['dateFrom'];}else{ echo date("Y-m-d");} ?>"/> 
                </span>
                <span>
                    To: <input type="date" name="dateTo" id="dateTo" data-date="" data-date-format="DD-MM-YYYY"  onchange="btnClickT()" value="<?php if(isset($_REQUEST['dateTo'])){ echo $_REQUEST['dateTo']; }else{ echo date("Y-m-d");} ?>"/>
                </span>
                <div id="btnSearchContainer" class="btnSearchBox">
                    <input type="submit" value="Search" id="btnSearch" name="searchDate">
                    <div class="border"></div>
                    <div class="border"></div>
                    <div class="border"></div>
                    <div class="border"></div>
                </div>
            </form>

            <?php
                if(isset($_POST['searchDate'])){
                    if(isset($_REQUEST['dateFrom'])){
                        $dateFrom = $_REQUEST['dateFrom'];
                    }else{
                        $dateFrom = date("Y-m-d");
                    }
                    if(isset($_REQUEST['dateTo'])){
                        $dateTo = $_REQUEST['dateTo'];
                    }else{
                        $dateTo = date("Y-m-d");
                    }

                    // $newfDate = date("d-m-Y", strtotime($dateFrom));
                    // $newtDate = date("d-m-Y", strtotime($dateTo));

                    $queryTable = "SELECT * FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$dateFrom' AND '$dateTo' ORDER BY employer ASC";
                    $resultTable = mysqli_query($con, $queryTable);
                    if(mysqli_num_rows($resultTable) > 0){
                        ?>
                            <div class="exportTable">
                                <table id="expTable">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Employer</th>
                                        </tr>   
                                    </thead>
                                    <tbody>
                        <?php
                            while($exp_row = mysqli_fetch_assoc($resultTable)){
                                ?>
                                    <tr>
                                        <td><?php echo $exp_row['tran_date']; ?></td>
                                        <td><?php echo $exp_row['emp_name']; ?></td>
                                        <td><?php echo $exp_row['employer']; ?></td>
                                    </tr>
                                <?php
                            }
                        ?>
                                    </tbody> 
                                </table>
                            </div>

                            <div id="exportBtn">
                                <div id="btnExportContainer" class="btnExportBox">
                                    <input type="submit" value="EXPORT" id="btnExport" name="exportBtn" onclick="downloadExcel()">
                                    <div class="border"></div>
                                    <div class="border"></div>
                                    <div class="border"></div>
                                    <div class="border"></div>
                                </div>
                            </div>
                        <?php
                    }else{
                        ?>
                            <H1 id="errorMsg">NO RECORD FOUND!</H1>
                        <?php
                    }
                }
            ?>
        </div>

        <script>
            function btnClickF() {

                var fdate = document.getElementById("dateFrom").value;
                var tdate = document.getElementById("dateTo").value;

                var ftime = new Date(fdate).getTime();
                var ttime = new Date(tdate).getTime();

                if(ftime > ttime){
                    document.getElementById("dateFrom").value = tdate;
                }
            }

            function btnClickT() {

                var fdate = document.getElementById("dateFrom").value;
                var tdate = document.getElementById("dateTo").value;

                var ftime = new Date(fdate).getTime();
                var ttime = new Date(tdate).getTime();

                if(ttime < ftime){
                    document.getElementById("dateTo").value = fdate;
                }
            }

            function navFuntion(){
            var db = document.getElementById("db");
            var group = document.getElementById("group");
            var tran = document.getElementById("tran");

            db.classList.remove("active");
            tran.classList.add("active");
            group.classList.remove("active");
        }

        var option = {
            "filename":"canteen-logs.csv"
        }

        function downloadExcel(){
            myWindow = window.open("./DownloadExcel.html");
            $("#expTable").first().table2csv(option);
            setTimeout(close, 300);
        }

        function close(){
            myWindow.close();
        }

        </script>
    </body>
</html>