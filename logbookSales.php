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

    <div class="lgbkBG">
        <div class="lgbkModal">
            <form action="POST" class="lgbkForm">
                <h1 class="lgbkFormTitle">ADD</h1>
                <table class="lgbkFormTable">
                    <tr>
                        <td>Date</td>
                        <td><input type="date" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="" id=""></td>
                    </tr>
                    <tr>
                        <td>Employer</td>
                        <td>
                            <select id="empOption" name="empOption" change onchange="FkeyDown()">
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
                    <input type="button" name="lgbkSaveBtn" class="lgbkSaveBtn" id="lgbkSaveBtn" value="Save" onclick="lgbkSaveBtn()">
                    <input type="button" name="lgbkCloseModal" class="lgbkCloseModal" id="lgbkCloseModal" value="Cancel" onclick="lgbkCloseModal()">
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

        function lbkAdd(){

        }
        
    </script>
</body>
</html>