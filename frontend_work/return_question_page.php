<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <title>Question Page!</title>
        <link rel="stylesheet" href="../css/styles.css"/>
        <link rel="stylesheet" href="../css/nav_styles.css"/>
    </head>
    <body>
        <header>
            <aside id="logo-container">
            <img id="logo" src="../assets/algo-wiz-logo.png"/>
            </aside>
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
    
        <main id="question-area" method=$_POST>
            <form>
                <fieldset>
                <legend>Recently Posted Questions</legend>
                <?php
                    $question_id = $_GET['question_id_num'];
                    $sql_recent_questions = "
                    select title, q_time
                    from Questions
                    order by q_time desc
                    limit 10;";
                
                    #$result = $conn->query($sql_recent_questions)
                    if ($stmt = $conn->prepare("SELECT title from Questions where Questions.question_id=?")) {
                        $stmt->bind_param("i", $question_id);
                        $stmt->execute();
                        $stmt->bind_result($title);
                        echo "<table border = '1'>
                        <tr>
                        </tr>";
                    
                        while($stmt->fetch())
                        {
                            echo"<tr>";
                            echo "<td>$title</td>";
                            echo"</tr>";
                        }
                        echo "</table>";
                        $stmt->close();
                    }

                    if ($stmt = $conn->prepare("SELECT a_text, username,a_time from Questions join Answers on (Questions.question_id = Answers.question_id) join UsersLogin on (Answers.user_id = UsersLogin.user_id) where Questions.question_id=?")) {
                        $stmt->bind_param("i", $question_id);
                        $stmt->execute();
                        $stmt->bind_result($a_text, $username, $a_time);
                        echo "<table border = '1'>
                        <tr>
                        </tr>";
                    
                        while($stmt->fetch())
                        {
                            echo"<tr>";
                            echo "<td>$username</td>";
                            echo "<td>$a_text</td>";
                            echo "<td>$a_time</td>";
                            echo"</tr>";
                        }
                        echo "</table>";
                        $stmt->close();
                    }

                ?>
                </fieldset>
            </form>

        </main>
    </body>

</html>

