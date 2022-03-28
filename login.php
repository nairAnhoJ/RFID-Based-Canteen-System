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
    <link rel="stylesheet" href="./styles/styles.css">
    <title>Login</title>
</head>
<body id="login-body">
    <div class="line"></div>
    <div class="login-container">
        <h1 class="login-text">LOGIN</h1>
        <div class="userName">
            <img src="./obj/user.png" class="imgUser" alt="user" width="26" height="26">
            <input type="text" placeholder="Username" id="user_name" name="user_name"> 
        </div>
        <div class="userPass">
            <img src="./obj/password.png" class="imgPass" alt="password" width="26" height="26">
            <input type="password" placeholder="Password" id="user_pass" name="user_pass">
        </div>
        <input type="submit" value="Sign In" id="loginBtn_submit" name="loginBtn_submit">
    </div>
        <div class="shadow"></div>
</body>
</html>