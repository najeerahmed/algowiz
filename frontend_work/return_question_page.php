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
                    $visit_username = $_GET["visit_username"]; // get to redirect page after reaction
                    $lp_var = "landing_page.php?username=$username";
                    $pp_var = "user_profile.php?username=$username&visit_username=false";
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

            <section id="answered-area">
                <?php
                    if ($stmt = $conn->prepare("SELECT answer_id, a_text, username,a_time from Questions join Answers on (Questions.question_id = Answers.question_id) join UsersLogin on (Answers.user_id = UsersLogin.user_id) where Questions.question_id=?")) {
                        $stmt->bind_param("i", $question_id);
                        $stmt->execute();
                        $stmt->bind_result($answer_id, $a_text, $answer_username, $a_time);

                        while($stmt->fetch())
                        {
                            // retrieve username of the answerer to add to their points after like or dislike
                            echo "
                            <section class='answer'>
                                <div class='text-area'>
                                    <p>$answer_username</p> 
                                    <p>$a_text</p>
                                    <p>$a_time</p>
                                </div>

                                <form class='bt-area' method='GET' action='../backend_work/update_like_dislike.php'>
                                    <button id='bt-like' class='reaction-button' name='bt' value ='like $username $answer_username $visit_username $answer_id $question_id'><img class='reaction-image' src='../assets/like_button.png'/></button>
                                    <button id='bt-dislike' class='reaction-button' name='bt' value = 'dislike $username $answer_username $visit_username $answer_id $question_id'><img class='reaction-image' src='../assets/dislike_button.png'/></button>
                                </form>
                            </section>
                            ";
                        }
                        $stmt->close();
                    }
                ?>
            </section>

            <!-- for the user to create an answer for the question -->
            <!-- need to add in action method to direct to the backend to register for the answer -->
            <?php
                echo "
                    <form id= 'response-area' method='GET' action='../backend_work/register_answer.php'> 
                        <textarea id='response-box' placeholder='Enter your response' name='response' required></textarea>
                        <input type='hidden' name='username' value='$username'/>
                        <input type='hidden' name='question_id' value='$question_id'/>
                        <input type='hidden' name='visit_username' value='$visit_username'/>
                        <input id='submit-response' type='submit'/>
                    </form>
                "
            ?>
        </main>

        <script src="./js/register_reaction_button.js"></script>
    </body>

</html>

