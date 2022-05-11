<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <title>Question Page!</title>
        <link rel="stylesheet" href="../css/styles.css"/>
        <link rel="stylesheet" href="../css/nav_styles.css"/>
        <link rel="stylesheet" href="../css/return_question_styles.css"/>
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
    
        <main>
            <section id="question-area">
                <?php
                    $question_id = $_GET['question_id_num'];

                    // retrieve the username of the person who asked the question
                    $sql = "
                        select username
                        from Questions join UsersLogin on UsersLogin.user_id = Questions.user_id
                        where Questions.question_id = $question_id;
                    ";

                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $username_ask = $row["username"];
                
                    if ($stmt = $conn->prepare("SELECT title, q_text, q_time from Questions where Questions.question_id=?")) {
                        $stmt->bind_param("i", $question_id);
                        $stmt->execute();
                        $stmt->bind_result($title, $q_text, $q_time);
                    
                        while($stmt->fetch())
                        {
                            echo "<h3>$title</h3>";
                            echo "<p>$q_text</p>";
                            echo "<p>$username_ask</p>";
                            echo "<p>$q_time</p>";
                        }
                        $stmt->close();
                    }
                ?>
            </section>

            <section id="answer-area">
                <?php
                    if ($stmt = $conn->prepare("SELECT a_text, username,a_time from Questions join Answers on (Questions.question_id = Answers.question_id) join UsersLogin on (Answers.user_id = UsersLogin.user_id) where Questions.question_id=?")) {
                        $stmt->bind_param("i", $question_id);
                        $stmt->execute();
                        $stmt->bind_result($a_text, $username, $a_time);

                        while($stmt->fetch())
                        {
                            echo "
                            <section class='answer'>
                                <div class='text-area'>
                                    <p>$username</p>
                                    <p>$a_text</p>
                                    <p>$a_time</p>
                                </div>

                                <div class='bt-area'>
                                    <button id='bt-like' class='reaction-button'><img class='reaction-image' src='../assets/like_button.png'/></button>
                                    <button id='bt-dislike' class='reaction-button'><img class='reaction-image' src='../assets/dislike_button.png'/></button>
                                </div>
                            </section>
                            ";
                        }
                        $stmt->close();
                    }
                ?>
            </section>
        </main>

        <script src="./js/register_reaction_button.js"></script>
    </body>

</html>

