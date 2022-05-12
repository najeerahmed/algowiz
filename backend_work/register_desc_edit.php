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

    // query to insert into database
    $new_desc = $_GET['new_desc'];
    $sql = "
        UPDATE UsersInfo
        SET short_desc = '$new_desc'
        WHERE UsersInfo.user_id = $uid;
    ";

    mysqli_query($conn, $sql);
    header ("Location: ../frontend_work/edit_profile.php?username=$username&success=true");

?>