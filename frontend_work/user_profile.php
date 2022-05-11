<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <?php
            $username = $_GET["username"];
            $visit_username = $_GET["visit_username"];
            if ($visit_username === 'false' or $visit_username === $username){
                $sql = "
                    select uname, status_title, points, email, city, state, country, dob, short_desc
                    from UsersLogin natural join UsersInfo
                    join UserStatus on UsersLogin.user_id = UserStatus.user_id
                    join StatusDict on UserStatus.status_id = StatusDict.status_id
                    where UsersLogin.username = '$username';
                ";
            }
            else {
                $sql = "
                    select uname, status_title, points, email, city, state, country, dob, short_desc
                    from UsersLogin natural join UsersInfo
                    join UserStatus on UsersLogin.user_id = UserStatus.user_id
                    join StatusDict on UserStatus.status_id = StatusDict.status_id
                    where UsersLogin.username = '$visit_username';
                ";   
            }

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
                    $lp_var = "landing_page.php?username=$username";
                    $pp_var = "user_profile.php?username=$username&visit_username=false";
                    echo "<p><a href=$lp_var>Home</a></p>";
                    echo "<p><a href=$pp_var>Profile</a></p>";
                    echo "<p><a href='../index.php'>Logout</a></p>";   
                ?>
            </nav>

            <form action="../backend_work/search_results.php" method = $_POST>
                <input type="text" name="search_query" value="" placeholder="Search Questions..."><br>
                <input type='hidden' name="username" value = "<?php echo "$username" ?>"><br>
            </form>
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
        <main> 
        <?php // Recently Posted Questions from User Profie
                echo "<h3 class='title'>Recently Posted Questions</h3>";
                if ($visit_username === 'false'){
                    if ($stmt = $conn->prepare("SELECT title, question_id, username from Questions join UsersLogin on (Questions.user_id = UsersLogin.user_id) where UsersLogin.username = '$username' order by q_time desc limit 10")) {
                        $stmt->execute();
                        $stmt->bind_result($title,$question_id,$visit_username);
                        echo "<table border = '1'>
                        <tr>
                        </tr>";
                    
                        while($stmt->fetch())
                        {
                            if ($visit_username = $username) {
                                $link_question = "return_question_page.php?question_id_num=$question_id&username=$visit_username&visit_username=false";
                            }
                            else{
                                $link_question = "return_question_page.php?question_id_num=$question_id&username=$username&visit_username=$visit_username";
                            }
                            
                            $link_profile = "user_profile.php?username=$username&visit_username=false";
                            echo"<tr>";
                            echo "<td><a href=$link_question>$title</a></td>";
                            echo "<td><a href=$link_profile>$visit_username</a></td>";
                            echo"</tr>";
                        }
                        echo "</table>";
                        $stmt->close();
                    }
                }
                else {
                    if ($stmt = $conn->prepare("SELECT title, question_id, username from Questions join UsersLogin on (Questions.user_id = UsersLogin.user_id) where UsersLogin.username = '$visit_username' order by q_time desc limit 10")) {
                        $stmt->execute();
                        $stmt->bind_result($title,$question_id,$visit_username);
                        echo "<table border = '1'>
                        <tr>
                        </tr>";
                    
                        while($stmt->fetch())
                        {
                            $link_question = "return_question_page.php?question_id_num=$question_id&username=$username&visit_username=$visit_username";
                            $link_profile = "user_profile.php?username=$username&visit_username=$visit_username";
                            echo"<tr>";
                            echo "<td><a href=$link_question>$title</a></td>";
                            echo "<td><a href=$link_profile>$visit_username</a></td>";
                            echo"</tr>";
                        }
                        echo "</table>";
                        $stmt->close();
                    }
                }

            ?>
            </main>

            <main>
        <?php
                echo "<h3 class='title'>Recently Posted Answers</h3>";
                if ($visit_username === 'false'){
                    if ($stmt = $conn->prepare("SELECT title, UsersLogin.username, status_title, Answers.question_id
                    from Answers join UsersLogin on (Answers.user_id = UsersLogin.user_id) join Questions on (Answers.question_id = Questions.question_id) join UserStatus on (UsersLogin.user_id = UserStatus.user_id) join StatusDict on (UserStatus.status_id = StatusDict.status_id) where UsersLogin.username='$username'
                    order by a_time desc
                    limit 10")) {
                        $stmt->execute();
                        $stmt->bind_result($title,$visit_username,$status_title,$question_id);
                        echo "<table border = '1'>
                        <tr>
                        </tr>";
                    
                        while($stmt->fetch())
                        {
                            $link_question = "return_question_page.php?question_id_num=$question_id&username=$username&visit_username=$visit_username";
                            $link_profile = "user_profile.php?username=$username&visit_username=false";
                            echo"<tr>";
                            echo "<td><a href=$link_question>$title</a></td>";
                            echo "<td><a href=$link_profile>$visit_username</a></td>";
                            echo"</tr>";
                        }
                        echo "</table>";
                        $stmt->close();
                    }
                }
                else {
                    if ($stmt = $conn->prepare("SELECT title, UsersLogin.username, status_title, Answers.question_id
                    from Answers join UsersLogin on (Answers.user_id = UsersLogin.user_id) join Questions on (Answers.question_id = Questions.question_id) join UserStatus on (UsersLogin.user_id = UserStatus.user_id) join StatusDict on (UserStatus.status_id = StatusDict.status_id) where UsersLogin.username = '$visit_username'
                    order by a_time desc
                    limit 10")) {
                        $stmt->execute();
                        $stmt->bind_result($title,$visit_username,$status_title,$question_id);
                        echo "<table border = '1'>
                        <tr>
                        </tr>";
                    
                        while($stmt->fetch())
                        {
                            $link_question = "return_question_page.php?question_id_num=$question_id&username=$username&visit_username=$visit_username";
                            $link_profile = "user_profile.php?username=$username&visit_username=$visit_username";
                            echo"<tr>";
                            echo "<td><a href=$link_question>$title</a></td>";
                            echo "<td><a href=$link_profile>$visit_username</a></td>";
                            echo"</tr>";

                        }
                        echo "</table>";
                        $stmt->close();
                    }
                }

            ?>
            </main>
    </body>
</html>