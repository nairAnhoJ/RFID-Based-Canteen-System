<?php
    session_start();

    include("./connection.php");

    if(!isset($_SESSION['connected'])){
        header('location: login.php');
    }

    if(!isset($_SESSION['selEmp'])){
        $_SESSION['selEmp'] = 0;
    }
    if(!isset($_SESSION['lgbkEditTitle'])){
        $_SESSION['lgbkEditTitle'] = 0;
    }

    $prevDate = date("Y-m-d");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo time(); ?>">
    <link rel="icon" href="./obj/canteen.png">
    <title>Logbook Sales</title>

    <script src="./sweetalert.min.js"></script>
    <script src="./jquery.min.js"></script>
</head>

<body id="logbookBody" onload="navFuntion()">

    <?php

        if(isset($_POST['lgbkCancel'])){
            unset($_SESSION['selEmp']);
            unset($_GET['lgbkEdit']);
            $_SESSION['selEmp'] = "0";
            $_SESSION['lgbkEditTitle'] = 0;
            header('location: logbookSales.php');
        }

        if(isset($_POST['lgbkAdd'])){
            $lgbkDate = $_REQUEST['lgbkInputDate'];
            $lgbkName = strtoupper($_REQUEST['lgbkInputName']);
            $lgbkEmp = strtoupper($_REQUEST['lgbkOption']);

            $queryLgbkSales = "SELECT lgbk_date, lgbk_name FROM `logbooksales` WHERE lgbk_date = '$lgbkDate' AND lgbk_name = '$lgbkName' UNION SELECT tran_date, emp_name FROM `tbl_trans_logs` WHERE tran_date = '$lgbkDate' AND emp_name = '$lgbkName'";

            $resultLgbkSales = mysqli_query($con, $queryLgbkSales);
            if(mysqli_num_rows($resultLgbkSales) > 0){
                
                $_SESSION['recentDate'] = $lgbkDate;
                if($lgbkEmp == "GLORY"){
                    $_SESSION['selEmp'] = 1;
                }else if($lgbkEmp == "MAXIM"){
                    $_SESSION['selEmp'] = 2;
                }else if($lgbkEmp == "NIPPI"){
                    $_SESSION['selEmp'] = 3;
                }else if($lgbkEmp == "POWERLANE"){
                    $_SESSION['selEmp'] = 4;
                }else if($lgbkEmp == "SERVICE PROVIDER"){
                    $_SESSION['selEmp'] = 5;
                }else{
                    $_SESSION['selEmp'] = 0;
                }
                ?> <script>swal ( "Oops" ,  "Employee is already in logs!" ,  "error" ).then((value) => { $('#lgbkInputName').focus(); });</script> <?php
            }else{
                $insLgbkEmp = "INSERT INTO `logbooksales`(`logbook_ID`, `lgbk_date`, `lgbk_name`, `lgbk_employer`) VALUES (null, '$lgbkDate', '$lgbkName', '$lgbkEmp')";
                mysqli_query($con, $insLgbkEmp);

                $_SESSION['recentDate'] = $lgbkDate;

                if($lgbkEmp == "GLORY"){
                    $_SESSION['selEmp'] = 1;
                }else if($lgbkEmp == "MAXIM"){
                    $_SESSION['selEmp'] = 2;
                }else if($lgbkEmp == "NIPPI"){
                    $_SESSION['selEmp'] = 3;
                }else if($lgbkEmp == "POWERLANE"){
                    $_SESSION['selEmp'] = 4;
                }else if($lgbkEmp == "SERVICE PROVIDER"){
                    $_SESSION['selEmp'] = 5;
                }else{
                    $_SESSION['selEmp'] = 0;
                }
                ?> <script language="javascript"> swal ( "Success" ,  "Employee successfully added!" ,  "success" ).then((value) => { $('#lgbkInputName').focus(); }); </script> <?php
            }
        }

        GLOBAL $lgbkEditDate;

        if(isset($_GET['lgbkEdit'])){
            $lgbkEditID = $_GET['lgbkEdit'];
            $_SESSION['lgbkEditID'] = $lgbkEditID;

            $queryLgbkEdit = "SELECT * FROM `logbooksales` WHERE logbook_ID = '$lgbkEditID' LIMIT 1";
            $resultLgbkEdit = mysqli_query($con, $queryLgbkEdit);

            while($rowLgbkEdit = mysqli_fetch_assoc($resultLgbkEdit)){
                $lgbkEditDate = $rowLgbkEdit['lgbk_date'];
                $lgbkEditName = strtoupper($rowLgbkEdit['lgbk_name']);
                $lgbkEditEmp = strtoupper($rowLgbkEdit['lgbk_employer']);

                if($lgbkEditEmp == "GLORY"){
                    $_SESSION['selEmp'] = 1;
                }else if($lgbkEditEmp == "MAXIM"){
                    $_SESSION['selEmp'] = 2;
                }else if($lgbkEditEmp == "NIPPI"){
                    $_SESSION['selEmp'] = 3;
                }else if($lgbkEditEmp == "POWERLANE"){
                    $_SESSION['selEmp'] = 4;
                }else if($lgbkEditEmp == "SERVICE PROVIDER"){
                    $_SESSION['selEmp'] = 5;
                }else{
                    $_SESSION['selEmp'] = 0;
                }

                $_SESSION['lgbkEditTitle'] = 1;
            }
            echo $lgbkEditDate;
        }

        if(isset($_POST['lgbkEditCon'])){
            $lgbkEditDate = $_POST['lgbkInputDate'];
            $lgbkEditName = strtoupper($_REQUEST['lgbkInputName']);
            $lgbkEditEmp = strtoupper($_REQUEST['lgbkOption']);

            $queryLgbkEdit = "SELECT * FROM `logbooksales` WHERE logbook_ID = '$lgbkEditID' LIMIT 1";
            $resultLgbkEdit = mysqli_query($con, $queryLgbkEdit);
            while($rowLgbkEdit = mysqli_fetch_assoc($resultLgbkEdit)){
                $lgbkEditID = $rowLgbkEdit['logbook_ID'];
                if(($lgbkEditDate == $rowLgbkEdit['lgbk_date']) && ($lgbkEditName == $rowLgbkEdit['lgbk_name']) && ($lgbkEditEmp == $rowLgbkEdit['lgbk_employer'])){
                    ?> <script language="javascript">swal ( "Oops" ,  "Employee is already in logs!" ,  "error" );</script> <?php
                }else{

                    mysqli_query($con, "UPDATE `logbooksales` SET `logbook_ID`= '$lgbkEditID',`lgbk_date`='$lgbkEditDate',`lgbk_name`='$lgbkEditName',`lgbk_employer`='$lgbkEditEmp' WHERE logbook_ID = '$lgbkEditID'");

                    unset($_GET['lgbkEdit']);
                    $_SESSION['selEmp'] = "0";
                    $_SESSION['lgbkEditTitle'] = 0;

                    ?>
                        <script language="javascript">
                        swal ( "Success" ,  "Employee successfully updated!" ,  "success" ).then((value) => {
                            window.location = "./logbookSales.php";
                        }); 
                        </script>
                    <?php
                }
            }
        }

        if(isset($_GET['delIdConf'])){
            $lgbkDel = $_GET['delIdConf'];
            $_SESSION['lgbkDelID'] = $lgbkDel;

            mysqli_query($con, "DELETE FROM `logbooksales` WHERE logbook_ID = '$lgbkDel'");
            header("location: logbookSales.php");
        }
    ?>

    <!-- Include Navigation Side Bar -->
    <?php require_once 'nav.php';?>

    <h1>LOGBOOK SALES</h1>

    <div class="lbkCon">
        <div class="lbkToolBar">
            <input type="text" class="lbkSearch" placeholder="Search..." >
            <button class="lbkAdd" onclick="lbkAdd()">Add</button>
        </div>

        <div class="contentCon">
            <div class="lbkTableCon">
                <table class="lbkTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Employer</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $queryLgbk = "SELECT * FROM `logbooksales` ORDER BY `lgbk_date` DESC, `lgbk_employer` ASC";
                            $resultLgbk = mysqli_query($con, $queryLgbk);
                            if(mysqli_num_rows($resultLgbk) > 0){
                                while($lgbkRow = mysqli_fetch_assoc($resultLgbk)){
                                    ?>
                                        <tr>
                                            <td><?php echo $lgbkRow['lgbk_date']; ?></td>
                                            <td><?php echo $lgbkRow['lgbk_name']; ?></td>
                                            <td><?php echo $lgbkRow['lgbk_employer']; ?></td>
                                            <td class="lgbkAction">
                                                <a href="./logbookSales.php?lgbkEdit=<?php echo $lgbkRow['logbook_ID'] ?>" class="lgbkEdit">Edit</a>
                                                <a href="#" data-name="<?php echo $lgbkRow['lgbk_name']; ?>" data-id="<?php echo $lgbkRow['logbook_ID'] ?>" class="lgbkDelete">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                    <h1 class="noRecord">NO RECORD FOUND!</h1>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="lgbkBG" id="lgbkBG" style="visibility:<?php if(!isset($_SESSION['selEmp']) || $_SESSION['selEmp'] == '0'){ echo 'hidden;'; }else{ echo 'visible;'; } ?>;">
        <div class="lgbkModal">
            <form method="POST" class="lgbkForm">
                <h1 class="lgbkFormTitle" id="lgbkFormTitle"><?php if($_SESSION['lgbkEditTitle'] == "1"){ echo "EDIT"; }else{ echo "ADD"; } ?></h1>
                <table class="lgbkFormTable">
                    <tr>
                        <td>Date</td>
                        <td><input type="date" name="lgbkInputDate" data-date="" data-date-format="DD-MM-YYYY" id="lgbkInputDate" value="<?php if($_SESSION['lgbkEditTitle'] == 1){ echo $lgbkEditDate; }else if(($_SESSION['lgbkEditTitle'] == 0) && ($_SESSION['selEmp'] == 0)){ echo $prevDate; }else if(($_SESSION['lgbkEditTitle'] == 0) && ($_SESSION['selEmp'] > 0)){ echo $_SESSION['recentDate']; } ?>"></td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="lgbkInputName" class="lgbkInputName"  id="lgbkInputName" autocomplete="off" autofocus onkeyup="lgbkUpName()" value="<?php if($_SESSION['lgbkEditTitle'] == 1){ echo $lgbkEditName; } ?>">
                            <ul class="suggList" id="suggList">
                                <?php
                                    $queryEmp = "SELECT * FROM `emp_list` ORDER BY `employer` ASC";
                                    $resultEmp = mysqli_query($con, $queryEmp);
                                    if(mysqli_num_rows($resultEmp) > 0){
                                        while($emp_row = mysqli_fetch_assoc($resultEmp)){
                                            ?>
                                            <li class="suggEach"><a href="#" class="suggA" data-name="<?php echo $emp_row['emp_name']; ?>" data-emp="<?php echo $emp_row['employer']; ?>"><?php echo $emp_row['emp_name']; ?></a></li>
                                            <?php
                                        }
                                    }
                                ?>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Employer</td>
                        <td>
                            <select id="lgbkOption" name="lgbkOption" change onchange="lgbkUp()">
                            <option value="" disabled hidden <?php if(!isset($_SESSION['selEmp']) || $_SESSION['selEmp'] == '0'){ echo 'selected'; }?>>Select your option</option>
                            <option value="glory" <?php if($_SESSION['selEmp'] == '1'){ echo 'selected'; }?>>GLORY</option>
                            <option value="maxim" <?php if($_SESSION['selEmp'] == '2'){ echo 'selected'; }?>>MAXIM</option>
                            <option value="nippi" <?php if($_SESSION['selEmp'] == '3'){ echo 'selected'; }?>>NIPPI</option>
                            <option value="powerlane" <?php if($_SESSION['selEmp'] == '4'){ echo 'selected'; }?>>POWERLANE</option>
                            <option value="service provider" <?php if($_SESSION['selEmp'] == '5'){ echo 'selected'; }?>>SERVICE PROVIDER</option>
                        </td>
                    </tr>
                </table>
                <div class="lgbkModalBtn">
                    <input type="submit" tabindex="-1" name="lgbkAdd" id="lgbkAdd" value="Add" disabled>
                    <input type="submit" tabindex="-1" name="lgbkEditCon" id="lgbkEdit" value="Edit" <?php if($_SESSION['lgbkEditTitle'] == "0"){ echo "disabled"; } ?>>
                    <input type="submit" tabindex="-1" name="lgbkCancel" id="lgbkCancel" value="Cancel">
                    <input type="button" name="lgbkSaveBtn" class="lgbkSaveBtn" id="lgbkSaveBtn" value="Save" onclick="lgbkSav3Btn()">
                    <input type="button" name="lgbkCloseModal" class="lgbkCloseModal" id="lgbkCloseModal" value="Cancel" onclick="lgbkCloseM0dal()">
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function navFuntion(){
            var wRep = document.getElementById("wkRep");
            wRep.classList.add("active");

            var wRep = document.getElementById("o1");
            wRep.classList.add("activeReport");
        }

        var dateVal = document.getElementById("lgbkInputDate");
        var nameVal = document.getElementById("lgbkInputName");
        var empSel = document.getElementById("lgbkOption");
        var SbmtAdd = document.getElementById("lgbkAdd");
        var SbmtEdit = document.getElementById("lgbkEdit");
        var suggList = document.getElementById('suggList');
        var x = 0;

        function lbkAdd(){
            document.getElementById("lgbkFormTitle").innerHTML = "ADD"
            dateVal.value = "";
            nameVal.value = "";
            empSel.selectedIndex = 0;
            document.getElementById("lgbkBG").style.visibility = "visible";
            document.getElementById("lgbkInputName").focus();
            
            // GET YESTERDAY DATE
            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            var yesDate = yesterday.toDateString();
            
            var d = new Date(yesDate),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();
            if (month.length < 2) {
                month = '0' + month;
            }
            if (day.length < 2) {
                day = '0' + day;
            }

            var nYesDate = [year, month, day].join('-');
            document.getElementById('lgbkInputDate').value = nYesDate;
        }

        function lgbkUpName(){
            var input, filter, ul, li, a, i, txtValue;
            x=0;
            input = document.getElementById("lgbkInputName");
            filter = input.value.toUpperCase();
            ul = suggList;
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    x++;
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }

            if(x == 0 || input.value == ""){
                suggList.style.visibility = "hidden";
            }else if(x == 1){
                suggList.style.visibility = "visible";
                $('#suggList').show();
                suggList.style.height = "30px";
            }else if(x == 2){
                suggList.style.visibility = "visible";
                $('#suggList').show();
                suggList.style.height = "61px";
            }else{
                suggList.style.visibility = "visible";
                $('#suggList').show();
                suggList.style.height = "92px";
            }

            if(nameVal.value === "" || empSel.selectedIndex === 0){
                SbmtAdd.disabled = true;
                SbmtEdit.disabled = true;
            }else{
                if(document.getElementById("lgbkFormTitle").innerHTML == "ADD"){
                    SbmtAdd.disabled = false;
                }else if(document.getElementById("lgbkFormTitle").innerHTML == "EDIT"){
                    SbmtEdit.disabled = false;
                }
            }
        }

        $(document).click(function(e) {
            if ($(e.target).is("ul") && $(e.target).has("li")){
                $('#suggList').show();
            }else{
                $('#suggList').hide();
            }
            
            if ($(e.target).is(':focus')){
                $('#suggList').show();
            }
        });

        $(".suggA").click(function(e) {
            e.preventDefault();
            var Ename = $(this).data("name");
            var Eemp = $(this).data("emp");
            document.getElementById('lgbkInputName').value = Ename;
            if(Eemp == "GLORY"){
                empSel.selectedIndex = 1;
            }else if(Eemp == "MAXIM"){
                empSel.selectedIndex = 2;
            }else if(Eemp == "NIPPI"){
                empSel.selectedIndex = 3;
            }else if(Eemp == "POWERLANE"){
                empSel.selectedIndex = 4;
            }else if(Eemp == "SERVICE PROVIDER"){
                empSel.selectedIndex = 5;
            }
            suggList.style.visibility = "hidden";

            if(document.getElementById("lgbkFormTitle").innerHTML == "ADD"){
                SbmtAdd.disabled = false;
            }else if(document.getElementById("lgbkFormTitle").innerHTML == "EDIT"){
                SbmtEdit.disabled = false;
            }
            
            document.getElementById("lgbkAdd").click();
            document.getElementById("lgbkInputDate").focus();

        });

        function lgbkUp(){
            if(nameVal.value === "" || empSel.selectedIndex === 0){
                SbmtAdd.disabled = true;
                SbmtEdit.disabled = true;
            }else{
                if(document.getElementById("lgbkFormTitle").innerHTML == "ADD"){
                    SbmtAdd.disabled = false;
                }else if(document.getElementById("lgbkFormTitle").innerHTML == "EDIT"){
                    SbmtEdit.disabled = false;
                }
            }
        }

        function lgbkSav3Btn(){
            if(nameVal.value == ""){
                swal ( "Oops" ,  "You have entered an invalid Employee Name!" ,  "error" );
            }else if(empSel.selectedIndex === 0){
                swal ( "Oops" ,  "You have selected an invalid Employer!" ,  "error" );
            }else{
                if(document.getElementById("lgbkFormTitle").innerHTML == "ADD"){
                    document.getElementById("lgbkAdd").click();
                }else if(document.getElementById("lgbkFormTitle").innerHTML == "EDIT"){
                    document.getElementById("lgbkEdit").click();
                }
            }
        }

        function lgbkCloseM0dal(){
            document.getElementById("lgbkCancel").click();
        }

        $(".lgbkDelete").click(function(e) {
            console.log("TEST");
            var delDataName = $(this).data("name");
            var delDataID = $(this).data("id");
            console.log(delDataName);
            console.log(delDataID);

            swal({
                title: "Are you sure you want to delete this record?",
                text: "NAME: " + delDataName,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if(willDelete) {
                    swal("User details was sucessfully Deleted!", {
                        icon: "success",
                    }).then(function() {
                        window.location = "./logbookSales.php?delIdConf=" + delDataID;
                    });
                }
            })
        });
    </script>
</body>
</html>