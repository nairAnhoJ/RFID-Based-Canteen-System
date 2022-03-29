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
        <div class="topPage">
            <h1 class="empTitle">Employee List</h1>
        </div>

        <div class="empTable">
            qq
        </div>

        <div class="empModal">
            <div id="frmTitle"><span class="txtTitle">CREATE</span></div>
            <form method="POST" class="frmEmployees">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="txtName" id="txtName" class="form-control">
                </div>
                <div class="form-group">
                    <label>Employee ID</label>
                    <input type="text" name="txtName" id="txtName" class="form-control">
                </div>
                <div class="form-group">
                    <label>Card Number</label>
                    <input type="text" name="txtName" id="txtName" class="form-control">
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
                    <input type="submit" name="btnCancel" id="btnCancel" value="Cancel">
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

    </script>
</body>
</html>