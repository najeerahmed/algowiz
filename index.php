<?php
    include_once "backend_work/connect_server.php";
?>

<!DOCTYPE html>
<head>
    <title>Algo Wiz</title>
    <link rel="stylesheet" href="css/styles.css"></link>
</head>
<body>
    <img id="logo" src="assets/algo-wiz-logo.png"/>
    <form method="POST" action="backend_work/login_authentication.php">
        <input type="username" name="username" placeholder="Enter Username" required/>
        <input type="password" name="password" placeholder="Enter Password"required/>
        <button name="login" type="submit">LOGIN</button>
    </form>
    <a id="register-account">register an account</a>

    <?php 
        // if the username / password is invalid after comparing to the database
        // let the user knows that the information is incorrect
        if (!empty($_GET)){
            if ($_GET["username"] === "invalid"){
                echo "<p id='invalid-login'>Invalid username / password</p>";
            }
        }
    ?>
</body>