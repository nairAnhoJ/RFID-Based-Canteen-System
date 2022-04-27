<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo time(); ?>">
    <link rel="icon" href="./obj/canteen.png">
    <title>Logbook Sales</title>
</head>

<body id="logbookBody" onload="navFuntion()">

    <!-- Include Navigation Side Bar -->
    <?php require_once 'nav.php';?>

    
    <h1>LOGBOOK SALES</h1>
    
    
    
    <script>
        function navFuntion(){
            var wRep = document.getElementById("wRep");
            wRep.classList.add("active");
        }

    </script>
</body>
</html>