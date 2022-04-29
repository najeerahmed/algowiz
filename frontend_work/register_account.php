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
                <input type="password" name="password" placeholder="Register Password" required/>
                <button type="submit">Register Account</button>
            </form>

            <aside id="requirement-satisfaction">
                <ul>
                    <li>
                        Have a special character (!, @, #, etc.)
                    </li>
                    <li>
                        Include a number 
                    </li>
                    <li>
                        Length must be longer then 7 characters
                    </li>
                </ul>
            </aside>
        </main>

        <script href="./js/script.js"></script>

    </body>

</html>