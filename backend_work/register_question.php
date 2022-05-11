<?php
    include_once "connect_server.php";

    $username = $_GET['username'];
    
    // retrieve user id
    $sql = "
        select user_id
        from UsersLogin
        where username = '$username';
    ";

    $result = mysqli_query($conn, $sql);
    $uid = mysqli_fetch_assoc($result)['user_id'];
    $topic_id = $_GET['algo-topic-list'];
    $title = $_GET['title'];
    $text = $_GET['question'];
    $ask_time = date("Y-m-d h:i:s");

    // query to insert into database
    $sql = "
        insert into Questions(topic_id, user_id, title, q_text, q_time, resolved)
        values ($topic_id, $uid, '$title', '$text', '$ask_time', 0);
    ";

    mysqli_query($conn, $sql);

    header ("Location: ../frontend_work/ask_question.php?username=$username&success=true");

?>