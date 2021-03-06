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

    // SQL query to retrieve answerer's user id
    $sql_answer_uid = "
        select user_id
        from UsersLogin
        where username = '$answer_username';
    ";

    $result = mysqli_query($conn, $sql_uid);
    $uid = mysqli_fetch_assoc($result)["user_id"];

    $result = mysqli_query($conn, $sql_answer_uid);
    $auid = mysqli_fetch_assoc($result)["user_id"];

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
    

    // update the answerer points by totaling the number of thumbs up and subtracting the number of thumbs down
    $sql_get_num_dislike = "
        select count(Answers.answer_id) as points_deduction
        from Answers join ThumbsDown on Answers.answer_id = ThumbsDown.answer_id
        where Answers.user_id = $auid
        group by Answers.user_id;
    ";

    $result = mysqli_query($conn, $sql_get_num_dislike);
    $row = mysqli_fetch_assoc($result);
    $points_deduction = 0;
    if ($row > 0){
        $points_deduction = $row["points_deduction"];
    }

    $sql_get_num_like = "
        select count(Answers.answer_id) as points_add
        from Answers join ThumbsUp on Answers.answer_id = ThumbsUp.answer_id
        where Answers.user_id = $auid
        group by Answers.user_id;
    ";

    $result = mysqli_query($conn, $sql_get_num_like);
    $row = mysqli_fetch_assoc($result);
    $points_add = 0;
    if ($row > 0){
        $points_add = $row["points_add"];
    }
    
    $sql_udpate_points = "
        UPDATE UsersInfo 
        set points = $points_add - $points_deduction
        where user_id = $auid
    ";

    mysqli_query($conn, $sql_udpate_points);


    // update status of the person if he/she passes the point threshold
    $sql_get_correct_status = "
        select status_id
        from StatusDict
        where point_threshold <= ($points_add - $points_deduction)
        order by point_threshold desc
        limit 1;
    ";

    // check if there is any result (in case the points are negative then don't need to do any update just leave the person at beginner's level)
    $result = mysqli_query($conn, $sql_get_correct_status);
    if (mysqli_num_rows($result) > 0){
        $status = mysqli_fetch_assoc($result)['status_id'];
        $sql_udpate_user_status = "
            UPDATE UserStatus
            set status_id = $status
            where user_id = $auid;
        ";

        mysqli_query($conn, $sql_udpate_user_status);
    }

    $sql_get_thumbs_up = "
        select count(ThumbsUp.user_id) as total_thumbs_up
        from ThumbsUp join Answers on ThumbsUp.answer_id = Answers.answer_id
        where Answers.answer_id = $answer_id;
    ";

    // update for answer total like column
    $result = mysqli_query($conn, $sql_get_thumbs_up);
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $total_thumbs_up = $row["total_thumbs_up"];
        $sql_update_like_post = "
            update Answers
            set thumbs_up = $total_thumbs_up
            where answer_id = $answer_id;
        ";

        mysqli_query($conn, $sql_update_like_post);
    }

    $sql_get_thumbs_down = "
        select count(ThumbsDown.user_id) as total_thumbs_down
        from ThumbsDown join Answers on ThumbsDown.answer_id = Answers.answer_id
        where Answers.answer_id = $answer_id;
    ";

    // update for answer total dislike column
    $result = mysqli_query($conn, $sql_get_thumbs_down);
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $total_thumbs_down = $row["total_thumbs_down"];
        $sql_update_dislike_post = "
            update Answers
            set thumbs_down = $total_thumbs_down
            where answer_id = $answer_id;
        ";

        mysqli_query($conn, $sql_update_dislike_post);
    }

    header ("Location: ../frontend_work/return_question_page.php?question_id_num=$question_id&username=$username&visit_username=$visit_username");

?>