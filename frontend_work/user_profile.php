<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <?php
            $username = $_GET["username"];

            $sql = "
                select uname, points
                from UsersLogin natural join UsersInfo
                where username = '$username';
            ";

            $result = mysqli_query($conn, $sql);
            // because login authenticated then user information 
            // is definitely there
            // no need to perform check anymore
            $row = mysqli_fetch_assoc($result);
            $name = $row["uname"];

            echo "<title>$name's Profile Page</title>";
        ?>

        <link type="text/css" rel="stylesheet" href="../css/styles.css"/>
        <link type="text/css" rel="stylesheet" href="../css/user_profile_styles.css"/>
        <link rel="shortcut icon" href="assets/algo-wiz-logo.png"/>
    </head>
    <body>
        <main>
            <?php
                echo "<h2>$name</h2>";

            ?>
        </main>
    </body>
</html>