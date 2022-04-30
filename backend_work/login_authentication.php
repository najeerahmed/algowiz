<?php
    include_once "connect_server.php";

    $sub_username = $_POST["username"];
    $sub_password = $_POST["password"];

    // query to extract password of the submitted username
    $sql_password = "
        select pw
        from UsersLogin
        where username = '$sub_username';
    ";


    $result = mysqli_query($conn, $sql_password);
    $result_check = mysqli_num_rows($result);

    // if the username doesn't exist that means no password is returned
    $valid = false;

    if ($result_check > 0){
        // if there is a password then compare it with the submitted password
        $actual_password = mysqli_fetch_assoc($result);
        if ($sub_password === $actual_password["pw"]){
            $valid = true;
        }
    }

    // if the password or username is incorrect then return to the login page
    if (!$valid){
        header("Location: ../index.php?username=invalid");
    }
    else {
        header("Location: ../index.php?username=valid");
    }

?>