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
        header("Location: ../frontend_work/register_account.php?status=taken&username=$submitted_username");
    }
    else {
        $sql = "
            insert into UsersLogin(username, pw) values ('$submitted_username', '$submitted_password');
        ";
        mysqli_query($conn, $sql);

        // get user_id
        $sql = "
            select user_id 
            from UsersLogin
            where username = '$submitted_username';
        ";
        $result = mysqli_query($conn, $sql);
        $uid = mysqli_fetch_assoc($result)["user_id"];

        // insert into UsersInfo for the user
        $sql = "
            insert into UsersInfo(user_id, uname, email, city, state, country, dob, short_desc, points) 
            values ($uid, 'New User', 'N/A', 'N/A', 'N/A', 'N/A', '1900-1-1', 'N/A', 0);  
        ";

        mysqli_query($conn, $sql);

        $sql = "
            insert into UserStatus values ($uid, 1);
        ";

        mysqli_query($conn, $sql);

        header("Location: ../frontend_work/register_account.php?status=success&username=$submitted_username");
    }
?>