<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <title>Register Account</title>
        <link rel="stylesheet" href="../css/styles.css"/>
        <link rel="stylesheet" href="../css/register_acc_styles.css"/>
        <link rel="shortcut icon" href="../assets/algo-wiz-logo.png"/>
    </head>
    <body>
        <img id="logo" src="../assets/algo-wiz-logo.png"/>

        <main id="register-account-area">
            <form method="POST" action="../backend_work/registration_authentication.php">
                <fieldset>
                    <legend>Register Account</legend>
                    <input type="text" name="username" placeholder="Register Username" required/>
                    <input id="password" type="password" name="password" placeholder="Register Password" required/>
                    <button id="bt-submit" type="submit">Register Account</button>
                </fieldset>
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

        <?php
            if (!empty($_GET)){
                $sub_username = $_GET["username"];
                if ($_GET["status"] === "taken"){
                    echo "<p>$sub_username is already taken. Enter another one...</p>";
                }
                else if ($_GET["status"] === "success") {
                    echo "<p>Success!</p>";
                    // locate to the main page
                    header("Location: ./landing_page.php?username=$sub_username");
                }
            }
        ?>

        <script type="text/javascript" src="./js/password_validator.js"></script>

    </body>

</html>