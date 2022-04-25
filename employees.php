<?php
    session_start();

    include("./connection.php");

    if(!isset($_SESSION['connected'])){
        header('location: login.php');
    }

    if(!isset($_SESSION['sUpdate'])){

    }else if($_SESSION['sUpdate'] == true){
        ?>
            <div class="S-Notif">User details was sucessfully updated!</div>
        <?php
        $_SESSION['sUpdate'] = false;
    }

    if(!isset($_SESSION['sDelete'])){

    }else if($_SESSION['sDelete'] == true){
        ?>
            <div class="E-Notif">User details was sucessfully Deleted!</div>
        <?php
        $_SESSION['sDelete'] = false;
    }

    if(!isset($_SESSION['modalStat'])){
        $_SESSION['modalStat'] = "0";
    }else if($_SESSION['modalStat'] == "0"){
        $_SESSION['modalStat'] = "0";
    }

    // if($_SESSION['modalStat'] == "0"){
        // $_SESSION['modalStat'] = "0";}
    // }else if($_SESSION['modalStat'] == "1"){
    //     $_SESSION['modalStat'] = "1";
    // }else if($_SESSION['modalStat'] == "2"){
    //     $_SESSION['modalStat'] = "2";
    // }else if($_SESSION['modalStat'] == "3"){
    //     $_SESSION['modalStat'] = "3";
    // }else if($_SESSION['modalStat'] == "4"){
    //     $_SESSION['modalStat'] = "4";
    // }else if($_SESSION['modalStat'] = "5"){
    //     $_SESSION['modalStat'] = "5";
    // }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo time(); ?>">
    <link rel="icon" href="./obj/canteen.png">
    <title>Employees</title>
</head>



<body id="emp-body" onload="navFuntion()">
    <!-- Include Navigation Side Bar -->
    <?php require_once 'nav.php';?>

    <!-- Employees Content -->
    <div class="emp-container">
        <div class="topPage" id="topPage">
            <h1 class="empTitle" id="empTitle">EMPLOYEE LIST</h1>
            <div class="toolBar">
                <input type="text" id="searchBox" class="searchBox" onkeyup="searchEmp()" placeholder="Search Employee...">
                <input type="button" id="createUser" class="createUser" value="CREATE" onclick="createUser()">
            </div>
        </div>



        <?php

            global $crudIdNum;
            global $crudName;
            global $crudCard;
            global $editTitle;

            // CREATE USER
            if(isset($_POST['sbmtCreate'])){

                $crudId = "";
                $crudIdNum = $_POST['txtid'];
                $crudName = strtoupper($_POST['txtName']);
                $crudCard = $_POST['txtNumber'];
                $crudEmp = strtoupper($_POST['empOption']);

                $query_Emp = "SELECT * from emp_list WHERE emp_cardNum = '$crudCard' LIMIT 1";
                $result_Emp = mysqli_query($con, $query_Emp);
                if(mysqli_num_rows($result_Emp) > 0){
                    ?>
                        <div class="E-Notif">Card Number is Already Registered!</div>
                    <?php

                    if($crudEmp == "GLORY"){
                        $_SESSION['modalStat'] = "1";
                    }else if($crudEmp == "MAXIM"){
                        $_SESSION['modalStat'] = "2";
                    }else if($crudEmp == "NIPPI"){
                        $_SESSION['modalStat'] = "3";
                    }else if($crudEmp == "POWERLANE"){
                        $_SESSION['modalStat'] = "4";
                    }else if($crudEmp == "SERVICE PROVIDER"){
                        $_SESSION['modalStat'] = "5";
                    }else{
                        $_SESSION['modalStat'] = "0";
                    }

                }else{

                    $ins_Emp = "INSERT INTO `emp_list`(`emp_id`, `emp_idNum`, `emp_name`, `emp_cardNum`, `employer`) VALUES (null ,'$crudIdNum','$crudName','$crudCard','$crudEmp')";
                    mysqli_query($con, $ins_Emp);

                    ?>
                        <div class="S-Notif">User Sucessfully Added!</div>
                    <?php

                    if($crudEmp == "GLORY"){
                        $_SESSION['modalStat'] = "1";
                    }else if($crudEmp == "MAXIM"){
                        $_SESSION['modalStat'] = "2";
                    }else if($crudEmp == "NIPPI"){
                        $_SESSION['modalStat'] = "3";
                    }else if($crudEmp == "POWERLANE"){
                        $_SESSION['modalStat'] = "4";
                    }else if($crudEmp == "SERVICE PROVIDER"){
                        $_SESSION['modalStat'] = "5";
                    }else{
                        $_SESSION['modalStat'] = "0";
                    }

                    $editTitle == "0";

                    $crudIdNum = "";
                    $crudName = "";
                    $crudCard = "";

                    header("location: employees.php");

                }
            }

            // EDIT USER
            if(isset($_POST['sbmtEdit'])){
                $crudId = $_SESSION['EditID'];
                $crudIdNum = $_POST['txtid'];
                $crudName = strtoupper($_POST['txtName']);
                $crudCard = $_POST['txtNumber'];
                $crudEmp = strtoupper($_POST['empOption']);

                $query_Emp_Edit = "SELECT * from emp_list WHERE emp_cardNum = '$crudCard' LIMIT 1";
                $result_Emp_Edit = mysqli_query($con, $query_Emp_Edit);

                if(mysqli_num_rows($result_Emp_Edit) > 0){
                    while($roweEdit = mysqli_fetch_assoc($result_Emp_Edit)){

                        if($crudIdNum == $roweEdit['emp_idNum'] && $crudName == $roweEdit['emp_name'] && $crudCard == $roweEdit['emp_cardNum'] && $crudEmp == $roweEdit['employer']){
                            ?>
                                <div class="E-Notif">Card Number is Already Registered!</div>
                            <?php

                            if($crudEmp == "GLORY"){
                                $_SESSION['modalStat'] = "1";
                            }else if($crudEmp == "MAXIM"){
                                $_SESSION['modalStat'] = "2";
                            }else if($crudEmp == "NIPPI"){
                                $_SESSION['modalStat'] = "3";
                            }else if($crudEmp == "POWERLANE"){
                                $_SESSION['modalStat'] = "4";
                            }else if($crudEmp == "SERVICE PROVIDER"){
                                $_SESSION['modalStat'] = "5";
                            }else{
                                $_SESSION['modalStat'] = "0";
                            }

                            $_SESSION['sUpdate'] = false;

                        }else{

                            $ins_Emp = "UPDATE `emp_list` SET `emp_idNum`='$crudIdNum',`emp_name`='$crudName',`emp_cardNum`='$crudCard',`employer`='$crudEmp' WHERE emp_id = '$crudId'";
                            mysqli_query($con, $ins_Emp);

                            $_SESSION['modalStat'] = "0";

                            // unset($_SESSION["modalStat"]);

                            $_SESSION['sUpdate'] = true;

                            header("location: employees.php");
                        }
                    }

                }else{

                    $ins_Emp = "UPDATE `emp_list` SET `emp_idNum`='$crudIdNum',`emp_name`='$crudName',`emp_cardNum`='$crudCard',`employer`='$crudEmp' WHERE emp_id = '$crudId'";
                    mysqli_query($con, $ins_Emp);

                    
                    // unset($_SESSION["modalStat"]);

                    $_SESSION['modalStat'] = "0";
                    $_SESSION['sUpdate'] = true;

                    header("location: employees.php");
                }
            }

            if(isset($_GET['edit'])){

                $crudId = $_GET['edit'];
                $_SESSION['EditID'] = $crudId;
                $queryEdit = "SELECT * FROM `emp_list` WHERE emp_id = '$crudId' LIMIT 1";
                $resultEdit = mysqli_query($con, $queryEdit);

                while($rowEdit = mysqli_fetch_assoc($resultEdit)){

                    $crudIdNum = $rowEdit['emp_idNum'];
                    $crudName = strtoupper($rowEdit['emp_name']);
                    $crudCard = $rowEdit['emp_cardNum'];
                    $crudEmp = strtoupper($rowEdit['employer']);

                    if($crudEmp == "GLORY"){
                        $_SESSION['modalStat'] = "1";
                    }else if($crudEmp == "MAXIM"){
                        $_SESSION['modalStat'] = "2";
                    }else if($crudEmp == "NIPPI"){
                        $_SESSION['modalStat'] = "3";
                    }else if($crudEmp == "POWERLANE"){
                        $_SESSION['modalStat'] = "4";
                    }else if($crudEmp == "SERVICE PROVIDER"){
                        $_SESSION['modalStat'] = "5";
                    }else{
                        $_SESSION['modalStat'] = "0";
                    }

                    $editTitle = "1";
                }
            }

            //DELETE RECORD
            if(isset($_POST['deleteRecord'])){
                $crudId = $_SESSION['deleteID'];
                mysqli_query($con, "DELETE FROM `emp_list` WHERE emp_id = '$crudId'");

                $_SESSION['sDelete'] = true;

                header("location: employees.php");
            }

            if(isset($_GET['delete'])){
                $crudId = $_GET['delete'];
                $_SESSION['deleteID'] = $crudId;

                $queryEdit = "SELECT * FROM `emp_list` WHERE emp_id = '$crudId' LIMIT 1";
                $resultEdit = mysqli_query($con, $queryEdit);

                while($rowEdit = mysqli_fetch_assoc($resultEdit)){
                    $crudIdNum = $rowEdit['emp_idNum'];
                    $crudName = strtoupper($rowEdit['emp_name']);
                    ?>
                        <form action="employees.php" method="POST" id="warning">
                            <p class="ques">Are you sure you want to delete this record?</p></br>
                            <p class="delDetails">Employee ID: <?php echo $crudIdNum; ?></p>
                            <p class="delDetails">Employee Name: <?php echo $crudName; ?></p>
                            <div class="btn-cont">
                                <input type="submit" class="deleteRec" name="deleteRecord" value="Yes">
                                <input type="button" class="cancelDelete" value="No" onclick="closeWarning()">
                            </div>
                        </form>
                    <?php
                }
            }

            if(isset($_POST['sbmtCancel'])){
                unset($_SESSION['modalStat']);
                $_SESSION['modalStat'] = "0";
                header('location: employees.php');
            }
        ?>

        <div class="empTable-container" id="empTable-container">

            <?php
                $queryEmp = "SELECT * FROM `emp_list` ORDER BY `employer` ASC";
                $resultEmp = mysqli_query($con, $queryEmp);
                if(mysqli_num_rows($resultEmp) > 0){
                    ?>
                        <div class="table-container" id="emp-container>">
                            <table id="empTable">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Employer</th>
                                        <th>Card Number</th>
                                        <th>Action</th>
                                    </tr>   
                                </thead>
                                <tbody>
                    <?php
                        while($emp_row = mysqli_fetch_assoc($resultEmp)){
                            ?>
                                <tr>
                                    <td><?php echo $emp_row['emp_idNum']; ?></td>
                                    <td><?php echo $emp_row['emp_name']; ?></td>
                                    <td><?php echo $emp_row['employer']; ?></td>
                                    <td><?php echo $emp_row['emp_cardNum']; ?></td>
                                    <td class="actionTab">
                                        <a href="./employees.php?edit=<?php echo $emp_row['emp_id'] ?>" class="btnEdit">Edit</a>
                                        <a href="./employees.php?delete=<?php echo $emp_row['emp_id'] ?>" class="btnDelete">Delete</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                                </tbody> 
                            </table>
                        </div>
                    <?php
                }else{
                    ?>
                        <H1 id="errorMsg">NO RECORD FOUND!</H1>
                    <?php
                }
            ?>
        </div>

        <!-- ERROR NOTIFICATION -->
        <div id="enotif"></div>


        


        <div id="dark-bg" style="visibility:<?php if($_SESSION['modalStat'] == '0' || !isset($_SESSION['modalStat'])){ echo 'hidden'; }else{ echo 'visible;'; } ?>;">   
            <div class="empModal" id="empModal">
                <form method="POST" class="frmEmployees" id="form-id">
                    <div id="frmTitle"><span id="txtTitle" class="txtTitle" name="txtTitle"><?php if($editTitle == "1"){ echo "EDIT"; }else{ echo "CREATE"; } ?></span></div>
                    <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" name="txtid" id="txtid" class="form-control" autocomplete="off" onkeyup="FkeyDown()" autofocus value="<?php if($_SESSION['modalStat'] == "0"){}else{ echo $crudIdNum; } ?>">
                    </div>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="txtName" id="txtName" class="form-control" autocomplete="off" onkeyup="FkeyDown()" value="<?php if($_SESSION['modalStat'] == "0"){}else{ echo $crudName; } ?>">
                    </div>
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" name="txtNumber" id="txtNumber" class="form-control" autocomplete="off" onkeyup="FkeyDown()" value="<?php if($_SESSION['modalStat'] == "0"){}else{ echo $crudCard; } ?>">
                    </div>
                    <div class="form-group">
                        <label>Employer</label>
                        <select id="empOption" name="empOption" change onchange="FkeyDown()">
                            <option value="" disabled hidden <?php if($_SESSION['modalStat'] == "0"){ echo 'selected'; }?>>Select your option</option>
                            <option value="glory" <?php if($_SESSION['modalStat'] == "1"){ echo 'selected'; }?>>GLORY</option>
                            <option value="maxim" <?php if($_SESSION['modalStat'] == "2"){ echo 'selected'; }?>>MAXIM</option>
                            <option value="nippi" <?php if($_SESSION['modalStat'] == "3"){ echo 'selected'; }?>>NIPPI</option>
                            <option value="powerlane" <?php if($_SESSION['modalStat'] == "4"){ echo 'selected'; }?>>POWERLANE</option>
                            <option value="service provider" <?php if($_SESSION['modalStat'] == "5"){ echo 'selected'; }?>>SERVICE PROVIDER</option>
                        </select>
                    </div>
                    <div class="modal-btn">
                        <input type="submit" name="sbmtCreate" id="sbmtCreate" value="Create" disabled>
                        <input type="submit" name="sbmtEdit" id="sbmtEdit" value="Edit" disabled>
                        <input type="submit" name="sbmtCancel" id="sbmtCancel" value="Cancel">
                        <input type="button" name="btnSave" id="btnSave" value="Save" onclick="saveBtn()">
                        <input type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="closeModal()">
                    </div>
                </form>
            </div>
        </div>             
    </div>

    <script type="text/javascript">
        
        // Change Highlighted Tab on SideBar
        function navFuntion(){
            var db = document.getElementById("db");
            var group = document.getElementById("group");
            var tran = document.getElementById("tran");

            db.classList.remove("active");
            tran.classList.remove("active");
            group.classList.add("active");
        }

        // CREATE BUTTON
        function createUser(){
            document.getElementById("txtTitle").innerHTML = "CREATE"
            document.getElementById("txtName").value = "";
            document.getElementById("txtid").value = "";
            document.getElementById("txtNumber").value = "";
            document.getElementById("empOption").selectedIndex = 0;
            document.getElementById("dark-bg").style.visibility = "visible";
            document.getElementById("txtid").focus();

            // var childNodes1 = document.getElementById("sideBar").getElementsByTagName('*');
            // for (var node1 of childNodes1) {
            //     node1.disabled = true;
            // }

            // var childNodes2 = document.getElementById("sideBar").getElementsByTagName('*');
            // for (var node2 of childNodes2) {
            //     node2.disabled = true;
            // }

            // $("#empTable :input").attr("disabled", "disabled");
        }

        function closeModal(){
            document.getElementById("sbmtCancel").click();
            var element = document.getElementById("enotif");
            element.classList.remove("E-Notif");
            // document.getElementById("txtName").value = "";
            // document.getElementById("txtid").value = "";
            // document.getElementById("txtNumber").value = "";
            // document.getElementById("empOption").selectedIndex = 0;
            // document.getElementById("dark-bg").style.visibility = "hidden";
            // window.location.href = './employees.php';
        }

        // Search Filter
        function searchEmp(){
            var input, filter, table, tr, td, tdName, tdCard, i, txtValue;
            input = document.getElementById("searchBox");
            filter = input.value.toUpperCase();
            table = document.getElementById("empTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                tdName = tr[i].getElementsByTagName("td")[1];
                tdCard = tr[i].getElementsByTagName("td")[3];

                if (td || tdName || tdCard) {
                    txtValue = td.textContent || td.innerText;
                    nameValue = tdName.textContent || tdName.innerText;
                    cardValue = tdCard.textContent || tdCard.innerText;

                    if (txtValue.toUpperCase().indexOf(filter) > -1 || nameValue.toUpperCase().indexOf(filter) > -1 || cardValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }

        function saveBtn(){
            if(document.getElementById("txtid").value == ""){
                var element = document.getElementById("enotif");
                element.classList.remove("E-Notif");
                element.classList.add("E-Notif");
                document.getElementById("enotif").innerHTML = "You have entered an invalid Employee ID!";
                stopNotif = setTimeout(remClass, 3000);
            }else if(document.getElementById("txtName").value == ""){
                var element = document.getElementById("enotif");
                element.classList.remove("E-Notif");
                element.classList.add("E-Notif");
                document.getElementById("enotif").innerHTML = "You have entered an invalid Employee Name!";
                setTimeout(remClass, 3000);
            }else if(document.getElementById("txtNumber").value == ""){
                var element = document.getElementById("enotif");
                element.classList.remove("E-Notif");
                element.classList.add("E-Notif");
                document.getElementById("enotif").innerHTML = "You have entered an invalid Card Number!";
                setTimeout(remClass, 3000);
            }else if(document.getElementById("empOption").selectedIndex == 0){
                var element = document.getElementById("enotif");
                element.classList.remove("E-Notif");
                element.classList.add("E-Notif");
                document.getElementById("enotif").innerHTML = "You have selected an invalid Employer!";
                setTimeout(remClass, 3000);
            }else{
                if(document.getElementById("txtTitle").innerHTML == "CREATE"){
                    document.getElementById("sbmtCreate").click();
                }else if(document.getElementById("txtTitle").innerHTML == "EDIT"){
                    document.getElementById("sbmtEdit").click();
                }
            }
        }

        function remClass(){
            var element = document.getElementById("enotif");
            element.classList.remove("E-Notif");
        }

        function closeWarning(){
            window.location.href = './employees.php';
        }

        const sbmtCreate = document.getElementById("sbmtCreate");
        const sbmtEdit = document.getElementById("sbmtEdit");

        const txtName = document.getElementById("txtName");
        const txtid = document.getElementById("txtid");
        const txtNumber = document.getElementById("txtNumber");
        const empOption = document.getElementById("empOption");

        function FkeyDown(){
            if(txtName.value === "" || txtid.value === "" || txtNumber.value ==="" || empOption.selectedIndex === 0){
                sbmtCreate.disabled = true;
                sbmtEdit.disabled = true;
            }else{
                if(document.getElementById("txtTitle").innerHTML == "CREATE"){
                    sbmtCreate.disabled = false;
                }else if(document.getElementById("txtTitle").innerHTML == "EDIT"){
                    sbmtEdit.disabled = false;
                }
            }
        }

        
    </script>
</body>
</html>