<?php
    include_once "backend_work/connect_server.php";
?>

<!DOCTYPE html>
<head>
    <title>Algo Wiz</title>
    <link rel="stylesheet" href="css/styles.css"></link>
    <link rel="stylesheet" href="css/index_styles.css"></link>
    <link rel="shortcut icon" href="assets/algo-wiz-logo.png"/>
</head>
<body>
    <img id="logo" src="assets/algo-wiz-logo.png"/>
    <form method="POST" action="backend_work/login_authentication.php">
        <input type="username" name="username" placeholder="Enter Username" required/>
        <input type="password" name="password" placeholder="Enter Password"required/>
        <button name="login" type="submit">LOGIN</button>
    </form>
    <a href="./frontend_work/register_account.php">register an account</a>

    <?php 
        // if the username / password is invalid after comparing to the database
        // let the user knows that the information is incorrect
        if (!empty($_GET)){
            if ($_GET["password"] === "invalid"){
                echo "<p id='invalid-login'>Invalid username / password</p>";
            }
            else if($_GET["password"] === "valid"){
                echo "<p>$valid_username</p>";
                $valid_username = $_GET["username"];
                header("Location: ./frontend_work/landing_page.php?username=$valid_username");
            }
        }
            
    ?>
</body>