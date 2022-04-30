<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <title>Register Account</title>
        <link rel="stylesheet" href="../css/styles.css"/>
        <link rel="stylesheet" href="../css/register_acc_styles.css"/>
    </head>
    <body>
        <img id="logo" src="../assets/algo-wiz-logo.png"/>

        <main id="register-account-area" method=$_POST>
            <form>
                <input type="username" name="username" placeholder="Register Username" required/>
                <input id="password" type="password" name="password" placeholder="Register Password" required/>
                <button id="bt-submit" type="submit">Register Account</button>
            </form>

            <aside id="requirement-satisfaction">
                <ul>
                    <li id="req-special-char">
                        Have a special character (!, @, #, etc.)
                    </li>
                    <li id="req-number">
                        Include a number 
                    </li>
                    <li id="req-length">
                        Length must be longer then 7 characters
                    </li>
                </ul>
            </aside>
        </main>

        <script type="text/javascript" src="./js/password_validator.js"></script>

    </body>

</html>