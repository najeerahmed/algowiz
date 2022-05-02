<?php
    include_once "../backend_work/connect_server.php";
?>

<!doctype html>
<html>
    <head>
        <title>Search Results</title>
        <link rel="stylesheet" href="../css/styles.css"/>
        <link rel="stylesheet" href="../css/register_acc_styles.css"/>
    </head>
    <body>
        <img id="logo" src="../assets/algo-wiz-logo.png"/>
    
        <main id="question-area" method=$_POST>
            <title>Search Results</title>

            <form>
                <fieldset>
                <legend>Recently Posted Questions</legend>
                <?php
                    $search_query = $_GET['search_query'];
                    $sql_query = "with Search as(

                        select *, MATCH(q_text) AGAINST ('+$search_query?*' in boolean MODE) as text_score, match(title) against ('+algo*' in boolean mode) as title_score
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
                        echo "<table border = '1'>
                        <tr>
                        </tr>";
                    
                        while($stmt->fetch())
                        {
                            echo"<tr>";
                            echo "<td><a href='../frontend_work/return_question_page.php?question_id_num=$question_id'>$title</a></td>";
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

