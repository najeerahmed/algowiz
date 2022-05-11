<?php
    include_once "connect_server.php";

    $response = $_GET['response'];
    $username = $_GET['username'];
    $question_id = $_GET['question_id'];
    $response_time = date("Y-m-d h:i:s");
    $visit_username = $_GET['visit_username'];

    // get user id
    $sql = "
        select user_id
        from UsersLogin
        where username = '$username';
    ";

    $result = mysqli_query($conn, $sql);
    $uid = mysqli_fetch_assoc($result)['user_id'];

    $sql_insert = "
        insert into Answers(user_id, question_id, thumbs_up, thumbs_down, best_answer, a_text, a_time)
        values ($uid, $question_id, 0, 0, 0, '$response', '$response_time');
    ";

    mysqli_query($conn, $sql_insert);

    header("Location: ../frontend_work/return_question_page.php?question_id_num=$question_id&username=$username&visit_username=$visit_username")
?>