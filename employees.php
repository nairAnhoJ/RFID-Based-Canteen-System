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
    <title>Employees</title>
</head>
<body id="emp-body" onload="navFuntion()">
    <!-- Include Navigation Side Bar -->
    <?php require_once 'nav.php';?>

    <!-- Employees Content -->
    <div class="emp-container">
        <div class="topPage" id="topPage">
            <h1 class="empTitle" id="empTitle">Employee List</h1>
            <div class="toolBar">
                <input type="text" id="searchBox" class="searchBox" onkeyup="searchEmp()" placeholder="Search Employee...">
                <input type="button" id="createUser" class="createUser" value="CREATE" onclick="createUser()">
            </div>
        </div>

        <div class="empTable-container">

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
                                        <a href="./empEdit.php?id=<?php echo $emp_row['emp_id'] ?>" class="btnEdit">Edit</a>
                                        <a href="./empDelete.php?id=<?php echo $emp_row['emp_id'] ?>" class="btnDelete">Delete</a>
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

        <?php
            if(isset($_POST['btnSave'])){
                
                //Get ACTION TITLE
                ?>
                <script>
                    var action
                </script>
                <?php


            }
        ?>


        <div class="empModal" id="empModal">
            <div id="frmTitle"><span id="txtTitle" class="txtTitle" name="txtTitle">CREATE</span></div>
            <form method="POST" class="frmEmployees">
                <div class="form-group">
                    <label>Employee ID</label>
                    <input type="text" name="txtid" id="txtid" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="txtName" id="txtName" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Card Number</label>
                    <input type="text" name="txtNumber" id="txtNumber" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Employer</label>
                    <select id="empOption" name="empOption" change>
                        <option value="" disabled selected>Select your option</option>
                        <option value="glory">GLORY</option>
                        <option value="maxim">MAXIM</option>
                        <option value="nippi">NIPPI</option>
                        <option value="powerlane">POWERLANE</option>
                    </select>
                </div>
                <div class="modal-btn">
                    <input type="submit" name="btnSave" id="btnSave" value="Save">
                    <input type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="closeModal()">
                </div>
            </form>
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

        function createUser(){
            document.getElementById("txtName").value = "";
            document.getElementById("txtid").value = "";
            document.getElementById("txtNumber").value = "";
            document.getElementById("empOption").selectedIndex = 0;
            document.getElementById("empModal").style.visibility = "visible";
        }

        function closeModal(){
            document.getElementById("txtName").value = "";
            document.getElementById("txtid").value = "";
            document.getElementById("txtNumber").value = "";
            document.getElementById("empOption").selectedIndex = 0;
            document.getElementById("empModal").style.visibility = "hidden";
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

    </script>
</body>
</html>