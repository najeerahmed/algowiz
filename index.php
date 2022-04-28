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
    <form method="POST" action="sign_in.php">
        <input type="username" name="username" placeholder="Enter Username" required/>
        <input type="password" name="password" placeholder="Enter Password"required/>
        <button>LOGIN</button>
    </form>
    <a id="register-account">register an account</a>
</body>