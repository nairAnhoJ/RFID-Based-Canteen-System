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
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo time(); ?>">
    <link rel="icon" href="./obj/canteen.png">
    <title>Logbook Sales</title>

    <script src="./sweetalert.min.js"></script>
</head>

<body id="logbookBody" onload="navFuntion()">

    <?php
        if(isset($_POST['lgbkCancel'])){
            unset($_SESSION['selEmp']);
            $_SESSION['selEmp'] = "0";
            header('location: logbookSales.php');
        }

        if(isset($_POST['lgbkAdd'])){
            $lgbkDate = $_POST['lgbkInputDate'];
            $lgbkName = strtoupper($_POST['lgbkInputName']);
            $lgbkEmp = strtoupper($_POST['lgbkOption']);

            

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
                        <td><input type="text" name="lgbkInputName"  id="lgbkInputName" autocomplete="off" onkeyup="lgbkUp()"></td>
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

        function lbkAdd(){
            document.getElementById("lgbkFormTitle").innerHTML = "ADD"
            dateVal.value = "";
            nameVal.value = "";
            empSel.selectedIndex = 0;
            document.getElementById("lgbkBG").style.visibility = "visible";
            document.getElementById("lgbkInputName").focus();
            
            var date = new Date();
            var currentDate = date.toISOString().substring(0,10);
            document.getElementById('lgbkInputDate').value = currentDate;
        }

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
            console.log("test");
        }
        
    </script>
</body>
</html>