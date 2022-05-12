<?php
    include_once "../backend_work/connect_server.php";
    session_start();
?>

<!doctype html>
<html>
    <head>
        <title>Search Results</title>
        <link rel="stylesheet" href="../css/styles.css"/>
        <link rel="stylesheet" href="../css/register_acc_styles.css"/>
        <link rel="stylesheet" href="../css/nav_styles.css"/>
    </head>
    <body>
        <header>
        <img id="logo" src="../assets/algo-wiz-logo.png"/>
            <nav>
                <?php
                    $username = $_GET["username"];
                    $lp_var = "../frontend_work/landing_page.php?username=$username";
                    $pp_var = "../frontend_work/user_profile.php?username=$username&visit_username=false";
                    echo "<p><a href=$lp_var>Home</a></p>";
                    echo "<p><a href=$pp_var>Profile</a></p>";
                    echo "<p><a href='../index.php'>Logout</a></p>";
                ?>
            </nav>
        </header>
    
        <main id="question-area" method=$_POST>
            <title>Search Results</title>

            <form>
                <fieldset>
                <legend>Search Results</legend>
                <?php
                    $search_query = $_GET['search_query'];
                    $sql_query = "with Search as(

                        select *, MATCH(q_text) AGAINST ('+$search_query?*' in boolean MODE) as text_score, match(title) against ('+$search_query*' in boolean mode) as title_score
                        from Questions join Topic using (topic_id)
                        where MATCH(title, q_text) against ('+$search_query*' in boolean mode)
                        order by text_score*0.2+title_score desc
                        )
                        
                        select title, q_time, question_id
                        from Search;";

                    #$result = $conn->query($sql_recent_questions)
                    if ($stmt = $conn->prepare($sql_query)) {
                        #$stmt->bind_param("s", $search_query);
                        $stmt->execute();
                        $stmt->bind_result($title, $qtime,$question_id);
                        $stmt->store_result();
                        echo "<table border = '1'>
                        <tr>
                        </tr>";
                        if (($stmt->num_rows) < 1) {
                            echo "No results found, please try searching for something else.";
                        }
                    
                        else {
                            while($stmt->fetch())
                            {
                                $link_question = "../frontend_work/return_question_page.php?question_id_num=$question_id&username=$username&visit_username=false";
                                echo"<tr>";
                                echo "<td><a href=$link_question>$title</a></td>";
                                echo"</tr>";
                            }
                            echo "</table>";
                            $stmt->close();
                        }

                    }

                ?>
                </fieldset>
            </form>

        </main>
    </body>

</html>

