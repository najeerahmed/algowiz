<?php
    include_once "connect_server.php";

    // confirm with database that username is available to be used
    $submitted_username = $_POST["username"];
    $submitted_password = $_POST["password"];
    $sql = "
        select user_id
        from UsersLogin
        where username = '$submitted_username';
    "; // identify whether the username exists

    $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);

    if ($result_check >= 1) {
        header("Location: ../frontend_work/register_account.php?username=taken");
    }
    else {
        $sql = "
            insert into UsersLogin(username, pw) values ('$submitted_username', '$submitted_password');
        ";
        mysqli_query($conn, $sql);
        header("Location: ../frontend_work/register_account.php?username=success");
    }
?>