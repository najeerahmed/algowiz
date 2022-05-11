<?php
    include_once 'connect_server.php';

    $string_data = $_GET['bt'];
    $info = explode(" ", $string_data);
    $bt_type = $info[0];
    $username = $info[1];
    $answer_username = $info[2];
    $visit_username = $info[3];
    $answer_id = $info[4];
    $question_id = $info[5];



    // SQl query to retrieve user id
    $sql_uid = "
        select user_id
        from UsersLogin
        where username = '$username';
    ";

    $result = mysqli_query($conn, $sql_uid);
    $uid = mysqli_fetch_assoc($result)["user_id"];

    // check if the section is already liked
    $sql_liked = "
        select user_id, answer_id
        from ThumbsUp
        where user_id = $uid and answer_id = $answer_id;
    ";

    $sql_disliked = "
        select user_id, answer_id
        from ThumbsDown
        where user_id = $uid and answer_id = $answer_id;
    ";

    // check if like or dislike
    if ($bt_type === "like"){

        $result = mysqli_query($conn, $sql_liked);
        $num_row = mysqli_num_rows($result);

        // if it is not in there then perform insertion
        if ($num_row === 0){
            $sql_insert_like = "
                insert into ThumbsUp(user_id, answer_id) values ($uid, $answer_id);
            ";
            mysqli_query($conn, $sql_insert_like);
        }
        else { // if it is already in there then remove it 
            $sql_remove_like = "
                delete from ThumbsUp where user_id = $uid and answer_id = $answer_id;
            ";
            mysqli_query($conn, $sql_remove_like);
        }

        // check if the answer was previously disliked
        $result_dislike = mysqli_query($conn, $sql_disliked);
        $num_row = mysqli_num_rows($result_dislike);

        if ($num_row > 0){
            $sql_remove_dislike = "
                delete from ThumbsDown where user_id = $uid and answer_id = $answer_id;
            ";
            mysqli_query($conn, $sql_remove_dislike);
        }

    }
    else if ($bt_type === "dislike"){

        $result = mysqli_query($conn, $sql_disliked);
        $num_row = mysqli_num_rows($result);

        // if it is not in there then perform insertion
        if ($num_row === 0){
            $sql_insert_dislike = "
                insert into ThumbsDown(user_id, answer_id) values ($uid, $answer_id);
            ";
            mysqli_query($conn, $sql_insert_dislike);
        }
        else { // if it is already in there then remove it 
            $sql_remove_dislike = "
                delete from ThumbsDown where user_id = $uid and answer_id = $answer_id;
            ";
            mysqli_query($conn, $sql_remove_dislike);
        }

        // check if the answer was previously liked
        $result_like = mysqli_query($conn, $sql_liked);
        $num_row = mysqli_num_rows($result_like);

        if ($num_row > 0){
            $sql_remove_like = "
                delete from ThumbsUp where user_id = $uid and answer_id = $answer_id;
            ";
            mysqli_query($conn, $sql_remove_like);
        }


    }

    header ("Location: ../frontend_work/return_question_page.php?question_id_num=$question_id&username=$username&visit_username=$visit_username");

?>

