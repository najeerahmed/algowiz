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
        <link type="text/css" rel="stylesheet" href="../css/user_profile_styles.css"/>
        <link rel="shortcut icon" href="assets/algo-wiz-logo.png"/>
    </head>
    <body>
        <main>
            <?php
                echo "
                <h1>$name</h1>

                <section id='status_section'>
                    <h3>$rank, </h3>
                    <h3>$points</h3>
                </section>

                <p>
                    $short_desc
                </p>


                ";

            ?>
        </main>
    </body>
</html>