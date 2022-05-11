<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <title>Ask Question</title>
        <link rel="stylesheet" type="text/css" href="../css/styles.css"/>
        <link rel="stylesheet" type="text/css" href="../css/nav_styles.css"/>
    </head>

    <body>
        <header>
            <aside id='logo-container'>
                <img id="logo" src="../assets/algo-wiz-logo.png"/>
            </aside>
            <form action="../backend_work/search_results.php" method = $_POST>
                <input type="text" name="search_query" value="" placeholder="Search Questions..."><br>
            </form>

            <nav>
                <?php
                    $username = $_GET["username"];
                    $lp_var = "landing_page.php?username=$username";
                    $pp_var = "user_profile.php?username=$username&visit_username=false";
                    echo "<p><a href=$lp_var>Home</a></p>";
                    echo "<p><a href=$pp_var>Profile</a></p>";
                    echo "<p><a href='../index.php'>Logout</a></p>";
                ?>
            </nav>
        </header>

        <main>
            <form>
                
            </form>

        </main>

    </body>
</html>