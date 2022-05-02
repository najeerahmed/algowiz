<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <?php
            $username = $_GET["username"];

            $sql = "
                    select uname, status_title, points, email, city, state, country, dob, short_desc
                    from UsersLogin natural join UsersInfo
                    join UserStatus on UsersLogin.user_id = UserStatus.user_id
                    join StatusDict on UserStatus.status_id = StatusDict.status_id
                    where UsersLogin.username = '$username';
                ";

                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result); // should only be one row

            $name = $row["uname"];
            $rank = $row["status_title"];
            $points = $row["points"];
            $email = $row["email"];
            $city = $row["city"];
            $state = $row["state"];
            $country = $row["country"];
            $dob = $row["dob"];
            $short_desc = $row["short_desc"];

            echo "<title>$name's Profile Page</title>";
        ?>

        <link type="text/css" rel="stylesheet" href="../css/styles.css"/>
        <link type="text/css" rel="stylesheet" href="../css/nav_styles.css"/>
        <link type="text/css" rel="stylesheet" href="../css/user_profile_styles.css"/>
        <link rel="shortcut icon" href="assets/algo-wiz-logo.png"/>
    </head>
    <body>
    <header>
        <img id="logo" src="../assets/algo-wiz-logo.png"/>
            <nav>
                <?php
                    $username = $_GET["username"];
                    $lp_var = "landing_page.php?username=$username";
                    $pp_var = "user_profile.php?username=$username";
                    echo "<p><a href=$lp_var>Home</a></p>";
                    echo "<p><a href=$pp_var>Profile</a></p>";
                    echo "<p><a href='../index.php'>Logout</a></p>";
                ?>
            </nav>
        </header>

        <main>
            <?php
                echo "
                <h1>$name</h1>

                <section id='status_section'>
                    <h3>$rank,</h3>
                    <h3>$points points</h3>
                </section>

                <p>
                    <q>$short_desc</q>
                </p>

                <h4>Personal Information</h4>
                <section id='personal_information'>
                    <p class='title' id='birthday-title'>Birth Date: </p>
                    <p id='birthday-info'>$dob</p>
                    <p class='title' id='email-title'>Email: </p>
                    <p id='email-info'>$email</p>
                    <p class='title' id='address-title'>Address:</p>
                    <p id='address-info'>$city, $state, $country</p>
                </section>
                ";

            ?>
        </main>
    </body>
</html>