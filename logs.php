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
    <body id="exportBody">
        <h2 class="exportTitle">TRANSACTION LOGS</h2>
        <div class="export-container">
            <form method="POST">
                <span>
                    From: <input type="date" name="dateFrom" id="dateFrom" data-date="" data-date-format="DD-MM-YYYY"  onchange="btnClickF()" value="<?php if(isset($_REQUEST['dateFrom'])){ echo $_REQUEST['dateFrom'];}else{ echo date("Y-m-d");} ?>"/> 
                </span>
                <span>
                    To: <input type="date" name="dateTo" id="dateTo" data-date="" data-date-format="DD-MM-YYYY"  onchange="btnClickT()" value="<?php if(isset($_REQUEST['dateTo'])){ echo $_REQUEST['dateTo']; }else{ echo date("Y-m-d");} ?>"/>
                </span>
                <div id="btnEx" class="buttonBox">
                    <input type="submit" value="Search" id="btnExport" name="searchDate">
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

                    $newfDate = date("d-m-Y", strtotime($dateFrom));
                    $newtDate = date("d-m-Y", strtotime($dateTo));

                    $queryTable = "SELECT * FROM `tbl_trans_logs` WHERE tran_date BETWEEN '$newfDate' AND '$newtDate'";
                    $resultTable = mysqli_query($con, $queryTable);
                    if(mysqli_num_rows($resultTable) > 0){
                        ?>
                            <div class="exportTable">
                                <table>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Employer</th>
                                    </tr>    
                        <?php
                            while($exp_row = mysqli_fetch_assoc($resultTable)){
                                ?>
                                    <tr>
                                        <th><?php echo $exp_row['tran_date']; ?></th>
                                        <th><?php echo $exp_row['emp_name']; ?></th>
                                        <th><?php echo $exp_row['employer']; ?></th>
                                    </tr>
                                <?php
                            }
                        ?>
                                </table>
                            </div>

                            <form method="POST" id="exportBtn">
                                <div id="btnEx" class="buttonBox">
                                    <input type="submit" value="EXPORT" id="btnExport" name="expBtn">
                                    <div class="border"></div>
                                    <div class="border"></div>
                                    <div class="border"></div>
                                    <div class="border"></div>
                                </div>
                            </form>
                        <?php
                    }else{
                        ?>
                            <H1 id="errorMsg">NO RECORD FOUND!</H1>
                        <?php
                    }

                    // if(isset($_POST['expBtn'])){
                        
                    // }
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
        </script>
    </body>
</html>