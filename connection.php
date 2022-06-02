<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Gpi242$$$";
$dbname = "canteen_transactions";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    die("Failed to Connect to Database!");
}

?>
