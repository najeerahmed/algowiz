<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <title>Ask Question</title>
        <link rel="stylesheet" type="text/css" href="../css/styles.css"/>
        <link rel="stylesheet" type="text/css" href="../css/nav_styles.css"/>
        <link rel="stylesheet" type="text/css" href="../css/ask_question_styles.css"/>
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
            <h3>Question Form</h3>
            <?php
                // sql to retrieve a list of topics from the database
                $sql = "
                    select topic_id , topic_name
                    from Topic;
                ";
                $result = mysqli_query($conn, $sql);
                $topic_id_array = [];
                $topic_array = [];

                while ($row = mysqli_fetch_assoc($result)){
                    array_push($topic_id_array, $row['topic_id']);
                    array_push($topic_array, $row['topic_name']);
                }
            
                echo "
                    <form method='GET' id='question-form' action='../backend_work/register_question.php'>
                        <input type='hidden' name='username' value='$username'/>
                        <select name='algo-topic-list' #id='algo-topic-list''>
                            <option value = '' disabled selected hidden >Select Algo Topics</option>
                    ";

                for ($i = 0; $i < count($topic_array); $i++){
                    echo "<option name='topic-id' value='$topic_id_array[$i]'>$topic_array[$i]</option>";
                }

                echo "
                        </select>
                        <input type='text' name='title' placeholder='Enter A Title...'/>
                        <textarea id='question-box' name='question' placeholder='Enter your question here...' required></textarea>
                        <input type='submit'/>
                    </form>
                "
            ?>
        </main>

    </body>
</html>