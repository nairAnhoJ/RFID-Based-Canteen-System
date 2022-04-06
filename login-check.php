<?php

    session_start();

    include("./connection.php");

    $userName = $_POST['user_name'];
    $userPass = $_POST['user_pass'];

    $queryTable = "SELECT * FROM `login` WHERE userName = '$userName' AND userPass = '$userPass'";
    $resultTable = mysqli_query($con, $queryTable);
    if(mysqli_num_rows($resultTable) > 0){
        $_SESSION['connected'] = 'TRUE';
        $_SESSION['modalStat'] = "0";
        header('location: dashboard.php');
    }else{
        $_SESSION['error'] = 'TRUE';
        header('location: login.php');
    }



?>