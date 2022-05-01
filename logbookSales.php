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
    <title>Logbook Sales</title>

    <script src="./sweetalert.min.js"></script>
    <script src="./jquery.min.js"></script>
    <!-- <script src="./jquery.tagsinput.min.js"></script> -->
</head>

<body id="logbookBody" onload="navFuntion()">



    <?php
        if(!isset($_SESSION['SuccessError'])){
        }else if($_SESSION['SuccessError'] = "success"){
            ?> <script language="javascript">swal ( "Success" ,  "Employee successfully added!" ,  "success" );</script> <?php
            $_SESSION['SuccessError'] = null;
        }else if($_SESSION['SuccessError'] = "error"){
            ?> <script>swal ( "Oops" ,  "Employee is already in logs!" ,  "error" );</script> <?php
            $_SESSION['SuccessError'] = null;
        }

        if(isset($_POST['lgbkCancel'])){
            unset($_SESSION['selEmp']);
            $_SESSION['selEmp'] = "0";
            header('location: logbookSales.php');
        }

        if(isset($_POST['lgbkAdd'])){
            $lgbkDate = $_REQUEST['lgbkInputDate'];
            $lgbkName = strtoupper($_REQUEST['lgbkInputName']);
            $lgbkEmp = strtoupper($_REQUEST['lgbkOption']);

            $queryLgbkSales = "SELECT * from logbooksales INNER JOIN `tbl_trans_logs` WHERE lgbk_date = '$lgbkDate' AND lgbk_name = '$lgbkName' LIMIT 1";
            $resultLgbkSales = mysqli_query($con, $queryLgbkSales);
            if(mysqli_num_rows($resultLgbkSales) > 0){
                $_SESSION['SuccessError'] = "error";
            }else{
                $insLgbkEmp = "INSERT INTO `logbooksales`(`logbook_ID`, `lgbk_date`, `lgbk_name`, `lgbk_employer`) VALUES (null, '$lgbkDate', '$lgbkName', '$lgbkEmp')";
                mysqli_query($con, $insLgbkEmp);
                $_SESSION['SuccessError'] = "sucess";
            }

            header('location: logbookSales.php');
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

                        <tr>
                            <td>2022/04/28</td>
                            <td>Test Name</td>
                            <td>Test Employer</td>
                            <td class="lgbkAction">
                                <a href="#" class="lgbkEdit">Edit</a>
                                <a href="#" class="lgbkDelete">Delete</a>
                            </td>
                        </tr>

                        <tr>
                            <td>2022/04/28</td>
                            <td>Test Name2</td>
                            <td>Test Employer2</td>
                            <td class="lgbkAction">
                                <a href="#" class="lgbkEdit">Edit</a>
                                <a href="#" class="lgbkDelete">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="lgbkBG" id="lgbkBG" style="visibility:<?php if(!isset($_SESSION['selEmp']) || $_SESSION['selEmp'] == '0'){ echo 'hidden;'; }else{ echo 'visible;'; } ?>;">
        <div class="lgbkModal">
            <form method="POST" class="lgbkForm">
                <h1 class="lgbkFormTitle" id="lgbkFormTitle">ADD</h1>
                <table class="lgbkFormTable">
                    <tr>
                        <td>Date</td>
                        <td><input type="date" name="lgbkInputDate" data-date="" data-date-format="DD-MM-YYYY" id="lgbkInputDate"></td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="lgbkInputName"  id="lgbkInputName" autocomplete="off" autofocus onkeyup="lgbkUpName()">
                            <ul class="suggList" id="suggList">
                                <?php
                                    $queryEmp = "SELECT * FROM `emp_list` ORDER BY `employer` ASC";
                                    $resultEmp = mysqli_query($con, $queryEmp);
                                    if(mysqli_num_rows($resultEmp) > 0){
                                        while($emp_row = mysqli_fetch_assoc($resultEmp)){
                                            ?>
                                            <li><a href="#" class="suggA" data-name="<?php echo $emp_row['emp_name']; ?>" data-emp="<?php echo $emp_row['employer']; ?>"><?php echo $emp_row['emp_name']; ?></a></li>
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
                            <option value="" disabled hidden selected>Select your option</option>
                            <option value="glory">GLORY</option>
                            <option value="maxim">MAXIM</option>
                            <option value="nippi">NIPPI</option>
                            <option value="powerlane">POWERLANE</option>
                            <option value="service provider">SERVICE PROVIDER</option>
                        </td>
                    </tr>
                </table>
                <div class="lgbkModalBtn">
                    <input type="submit" name="lgbkAdd" id="lgbkAdd" value="Add" disabled>
                    <input type="submit" name="lgbkEdit" id="lgbkEdit" value="Edit" disabled>
                    <input type="submit" name="lgbkCancel" id="lgbkCancel" value="Cancel">
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
            }else if (day.length < 2) {
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
        
    </script>
</body>
</html>