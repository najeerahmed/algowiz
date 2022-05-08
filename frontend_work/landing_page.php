<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <title>Algo-Wiz</title>
        <link rel="stylesheet" href="../css/landing_styles.css"/>
        <link rel="stylesheet" href="../css/styles.css"/>
        <link rel="stylesheet" href="../css/nav_styles.css"/>
    
    </head>
    <body>
        <header>
            <img id="logo" src="../assets/algo-wiz-logo.png"/>
            <form action="../backend_work/search_results.php" method = $_POST>
                <input type="text" name="search_query" value="" placeholder="Search Questions..."><br>
            </form>

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
        <main id="question-area">

            <a href="./ask_question.php">
                <button>
                    Ask a question
                </button>
            </a>
            
            <!-- should reimplement with proper link rather than display with form -->
            <?php
                $sql_recent_questions = "
                select title, q_time
                from Questions
                order by q_time desc
                limit 10;";
            
                if ($stmt = $conn->prepare("SELECT title, question_id, username from Questions join UsersLogin on (Questions.user_id = UsersLogin.user_id) order by q_time desc limit 10")) {
                    $stmt->execute();
                    $stmt->bind_result($title,$question_id,$username);
                    echo "<table border = '1'>
                    <tr>
                    </tr>";
                
                    while($stmt->fetch())
                    {
                        echo"<tr>";
                        echo "<td><a href='return_question_page.php?question_id_num=$question_id'>$title</a></td>";
                        echo "<td><a href='user_profile.php?username=$username'>$username</a></td>";
                        echo"</tr>";
                    }
                    echo "</table>";
                    $stmt->close();
                }
            ?>

            <?php
                $sql_recent_questions = "
                select a_title, a_time
                from Answers
                order by a  _time desc
                limit 10";
        
                if ($stmt = $conn->prepare("SELECT title, UsersLogin.username, status_title, Answers.question_id
                from Answers join UsersLogin on (Answers.user_id = UsersLogin.user_id) join Questions on (Answers.question_id = Questions.question_id) join UserStatus on (UsersLogin.user_id = UserStatus.user_id) join StatusDict on (UserStatus.status_id = StatusDict.status_id)
                order by a_time desc
                limit 10")) {
                    $stmt->execute();
                    $stmt->bind_result($title,$username,$status_title,$question_id);
                    echo "<table border = '1'>
                    <tr>
                    </tr>";
                
                    while($stmt->fetch())
                    {
                        echo"<tr>";
                        echo "<td><a href='return_question_page.php?question_id_num=$question_id'>$title</a></td>";
                        echo "<td><a href='user_profile.php?username=$username'>$username</a></td>";
                        echo "<td>$status_title</td>";
                        echo"</tr>";
                    }
                    echo "</table>";
                    $stmt->close();
                }
            ?>
        </main>
    </body>

</html>
